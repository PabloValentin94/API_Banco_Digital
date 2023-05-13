<?php

namespace App\DAO;

use App\Model\ContaModel;

class ContaDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    public function Insert(ContaModel $model) : ContaModel
    {

        $sql = "INSERT INTO Conta(numero, tipo, senha_conta, ativa, " +
               "fk_correntista) VALUES(?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->numero);

        $stmt->bindValue(2, $model->tipo);

        $stmt->bindValue(3, $model->senha_conta);

        $stmt->bindValue(4, $model->ativa);

        $stmt->bindValue(5, $model->fk_correntista);

        $stmt->execute();

        $model->id_conta = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(ContaModel $model) : bool
    {

        $sql = "UPDATE Conta SET numero = ?, tipo = ?, senha_conta = ?, " +
               "fk_correntista = ? WHERE id_conta = ?"; 

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->numero);

        $stmt->bindValue(2, $model->tipo);

        $stmt->bindValue(3, $model->senha_conta);

        $stmt->bindValue(4, $model->fk_correntista);

        $stmt->bindValue(5, $model->id_conta);

        return $stmt->execute();

    }

    /*public function Delete(int $id) : bool
    {

        $sql = "DELETE FROM Conta WHERE id_conta = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }*/

    public function Disable(int $id, bool $ativamento) : bool
    {

        $sql = "UPDATE Conta SET ativa = ? WHERE id_conta = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $ativamento);

        $stmt->bindValue(2, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Conta ORDER BY id_conta ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\ContaModel");

    }

    public function SelectByIDConta(int $query) : array
    {

        $parametro = [":filtro" => "%" . $query . "%"];

        $sql = "SELECT * FROM Conta WHERE numero LIKE :filtro ORDER BY numero ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\ContaModel");

    }

}

?>