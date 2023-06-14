<?php

namespace Api\Model;

use Exception;

use Api\DAO\ChavePixDAO;

class ChavePixModel extends Model
{

    public $id_chave_pix, $chave, $tipo, $fk_conta;

    public function Save()
    {

        $dao = new ChavePixDAO();

        if(empty($this->id_chave_pix))
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