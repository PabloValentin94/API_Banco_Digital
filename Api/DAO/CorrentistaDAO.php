<?php

namespace Api\DAO;

use Api\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    public function Insert(CorrentistaModel $model) : ?CorrentistaModel
    {

        $sql = "INSERT INTO Correntista(nome, cpf, email, data_nascimento, " .
               "senha, ativo) VALUES(?, ?, ?, ?, MD5(?), ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->email);

        $stmt->bindValue(4, $model->data_nascimento);

        $stmt->bindValue(5, $model->senha);

        $stmt->bindValue(6, $model->ativo);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(CorrentistaModel $model) : bool
    {

        $sql = "UPDATE Correntista SET nome = ?, cpf = ?, email = ?, data_nascimento = ?, " .
               "senha = MD5(?), ativo = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->email);

        $stmt->bindValue(4, $model->data_nascimento);

        $stmt->bindValue(5, $model->senha);

        $stmt->bindValue(6, $model->ativo);

        $stmt->bindValue(7, $model->id);

        return $stmt->execute();

    }

    public function Disable(int $id, bool $ativamento) : bool
    {

        $sql = "UPDATE Correntista SET ativo = ? WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $ativamento);

        $stmt->bindValue(2, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 ORDER BY id ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\CorrentistaModel");

    }

    public function Search(string $query) : array
    {

        $parametro = [":filtro" => "%" . $query. "%"];

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 AND nome LIKE :filtro ORDER BY id ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\CorrentistaModel");

    }

    public function Login(string $usuario, string $senha) : array
    {

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 AND nome = ? " .
               "AND senha = MD5(?) ORDER BY id ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $usuario);

        $stmt->bindValue(2, $senha);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);

    }

}

?>