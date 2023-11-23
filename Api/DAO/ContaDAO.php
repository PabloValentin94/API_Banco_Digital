<?php

namespace Api\DAO;

use Api\Model\ContaModel;

class ContaDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    public function Insert(ContaModel $model) : ?ContaModel
    {

        $sql = "INSERT INTO Conta(saldo, limite, tipo, ativa, fk_correntista) VALUES(?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->saldo);

        $stmt->bindValue(2, $model->limite);

        $stmt->bindValue(3, $model->tipo);

        $stmt->bindValue(4, $model->ativa);

        $stmt->bindValue(5, $model->fk_correntista);

        $stmt->execute();

        $model->id = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(ContaModel $model) : bool
    {

        $sql = "UPDATE Conta SET saldo = ?, limite = ?, tipo = ?, ativa = ?, fk_correntista = ? WHERE id = ?"; 

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->saldo);

        $stmt->bindValue(2, $model->limite);

        $stmt->bindValue(3, $model->tipo);

        $stmt->bindValue(4, $model->ativa);

        $stmt->bindValue(5, $model->fk_correntista);

        $stmt->bindValue(6, $model->id);

        return $stmt->execute();

    }

    public function Reactivate(int $id) : bool
    {

        $sql = "UPDATE Conta SET ativo = 1 WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function Deactivate(int $id) : bool
    {

        $sql = "UPDATE Conta SET ativo = 0 WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Conta WHERE ativa = 1 ORDER BY id ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\ContaModel");

    }

    public function Search(int $query) : array
    {

        $parametro = [":filtro" => "%" . $query . "%"];

        $sql = "SELECT * FROM Conta WHERE ativa = 1 AND fk_correntista LIKE :filtro ORDER BY id ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\ContaModel");

    }

}

?>