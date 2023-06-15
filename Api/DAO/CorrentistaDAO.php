<?php

namespace Api\DAO;

use Api\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    public function Insert(CorrentistaModel $model) : CorrentistaModel
    {

        $sql = "INSERT INTO Correntista(nome, cpf, data_nascimento, " .
               "senha_correntista, ativo) VALUES(?, ?, ?, MD5(?), ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->data_nascimento);

        $stmt->bindValue(4, $model->senha_correntista);

        $stmt->bindValue(5, $model->ativo);

        $stmt->execute();

        $model->id_correntista = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(CorrentistaModel $model) : bool
    {

        $sql = "UPDATE Correntista SET nome = ?, cpf = ?, data_nascimento = ?, " .
               "senha_correntista = MD5(?), ativo = ? WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->data_nascimento);

        $stmt->bindValue(4, $model->senha_correntista);

        $stmt->bindValue(5, $model->ativo);

        $stmt->bindValue(6, $model->id_correntista);

        return $stmt->execute();

    }

    public function Disable(int $id, bool $ativamento) : bool
    {

        $sql = "UPDATE Correntista SET ativo = ? WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $ativamento);

        $stmt->bindValue(2, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\CorrentistaModel");

    }

    public function Search(string $query) : array
    {

        $parametro = [":filtro" => "%" . $query. "%"];

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 AND nome LIKE :filtro ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\CorrentistaModel");

    }

    public function Login(string $usuario, string $senha) : array
    {

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 AND nome = ? " .
               "AND senha_correntista = MD5(?) ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $usuario);

        $stmt->bindValue(2, $senha);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);

    }

}

?>