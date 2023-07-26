CREATE DATABASE IF NOT EXISTS db_banco_digital;

USE db_banco_digital;

CREATE TABLE IF NOT EXISTS Correntista (

	id_correntista INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(50),
	cpf VARCHAR(14) UNIQUE,
    email VARCHAR(40) UNIQUE,
	data_nascimento DATE,
	senha_correntista VARCHAR(32),
	ativo BOOLEAN DEFAULT TRUE,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP()

);

CREATE TABLE IF NOT EXISTS Conta (

	id_conta INT AUTO_INCREMENT PRIMARY KEY,
	saldo DOUBLE,
	limite DOUBLE,
	tipo ENUM("Corrente", "Poupança"),
    ativa BOOLEAN DEFAULT TRUE,
    data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),

	fk_correntista INT,
	FOREIGN KEY(fk_correntista) REFERENCES Correntista(id_correntista)

);

CREATE TABLE IF NOT EXISTS Chave_Pix (

	id_chave_pix INT AUTO_INCREMENT PRIMARY KEY,
	chave VARCHAR(50),
	tipo ENUM("CPF", "CNPJ", "Telefone", "E-mail", "Aleatória"),

	fk_conta INT,
	FOREIGN KEY(fk_conta) REFERENCES Conta(id_conta)

);

CREATE TABLE IF NOT EXISTS Transacao (

	id_transacao INT AUTO_INCREMENT PRIMARY KEY,
	data_transacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
	valor DOUBLE

);

CREATE TABLE IF NOT EXISTS Transacao_Contas_Assoc (

	fk_conta_remetente INT,
	FOREIGN KEY(fk_conta_remetente) REFERENCES Conta(id_conta),

	fk_conta_destinatario INT,
	FOREIGN KEY(fk_conta_destinatario) REFERENCES Conta(id_conta),

	fk_transacao INT,
	FOREIGN KEY(fk_transacao) REFERENCES Transacao(id_transacao)

);