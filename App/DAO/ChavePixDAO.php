<?php

namespace App\DAO;

use App\Model\ChavePixModel;

class ChavePixDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    public function Insert(ChavePixModel $model) : ChavePixModel
    {

        $sql = "INSERT INTO Chave_Pix(chave, tipo, fk_conta) VALUES(?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->chave);

        $stmt->bindValue(2, $model->tipo);

        $stmt->bindValue(3, $model->fk_conta);

        $stmt->execute();

        $model->id_chave_pix = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(ChavePixModel $model) : bool
    {

        $sql = "UPDATE Chave_Pix SET chave = ?, tipo = ?, fk_tipo = ? " +
               "WHERE id_chave_pix = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->chave);

        $stmt->bindValue(2, $model->tipo);

        $stmt->bindValue(3, $model->fk_conta);

        $stmt->bindValue(4, $model->id_chave_pix);

        return $stmt->execute();

    }

    public function Delete(int $id) : bool
    {

        $sql = "DELETE FROM Chave_Pix WHERE id_chave_pix = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Chave_Pix ORDER BY id_chave_pix ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\ChavePixModel");

    }

    public function SelectByChavePix(string $query) : array
    {

        $parametro = [":filtro" => "%" . $query . "%"];

        $sql = "SELECT * FROM Chave_Pix WHERE chave LIKE :filtro ORDER BY chave ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchall(DAO::FETCH_CLASS, "App\Model\ChavePixModel");

    }

}

?>