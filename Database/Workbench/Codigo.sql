CREATE DATABASE IF NOT EXISTS db_banco_digital;

USE db_banco_digital;

CREATE TABLE IF NOT EXISTS Correntista (

	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(255) NOT NULL,
	cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(75) UNIQUE DEFAULT "Não informado",
	data_nascimento DATE DEFAULT NULL,
	senha VARCHAR(32) NOT NULL,
	ativo BOOLEAN DEFAULT 1,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP()

);

CREATE TABLE IF NOT EXISTS Conta (

	id INT AUTO_INCREMENT PRIMARY KEY,
	saldo DOUBLE,
	limite DOUBLE,
	tipo ENUM("Corrente", "Poupança"),
    ativa BOOLEAN DEFAULT 1,
    data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),

	fk_correntista INT,
	FOREIGN KEY(fk_correntista) REFERENCES Correntista(id)

);

CREATE TABLE IF NOT EXISTS Chave_Pix (

	id INT AUTO_INCREMENT PRIMARY KEY,
	chave VARCHAR(50),
	tipo ENUM("CPF", "CNPJ", "Telefone", "E-mail", "Aleatória"),

	fk_conta INT,
	FOREIGN KEY(fk_conta) REFERENCES Conta(id)

);

CREATE TABLE IF NOT EXISTS Transacao (

	id INT AUTO_INCREMENT PRIMARY KEY,
	data_transacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
	valor DOUBLE

);

CREATE TABLE IF NOT EXISTS Transacao_Contas_Assoc (

	fk_conta_remetente INT,
	FOREIGN KEY(fk_conta_remetente) REFERENCES Conta(id),

	fk_conta_destinatario INT,
	FOREIGN KEY(fk_conta_destinatario) REFERENCES Conta(id),

	fk_transacao INT,
	FOREIGN KEY(fk_transacao) REFERENCES Transacao(id)

);