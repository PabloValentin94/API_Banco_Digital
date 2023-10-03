<?php

namespace Api\Model;

use Api\DAO\ChavePixDAO;

class ChavePixModel extends Model
{

    public $id, $chave, $tipo, $fk_conta;

    public function Save()
    {

        $dao = new ChavePixDAO();

        if($this->id == null)
        {

            $dao->Insert($this);

        }

        else
        {

            $dao->Update($this);

        }

    }

    public function Erase(int $id)
    {

        (new ChavePixDAO())->Delete($id);

    }

    public function GetRows(string $filtro = null)
    {

        $dao = new ChavePixDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->Search($filtro);

    }

}

?>