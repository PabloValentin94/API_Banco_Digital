<?php

namespace Api\Model;

use Api\DAO\ContaDAO;

class ContaModel extends Model
{

    public $id, $saldo, $limite, $tipo, $ativa, $fk_correntista, $data_abertura;

    public function Save()
    {

        $dao = new ContaDAO();

        if($this->id == null)
        {

            return $dao->Insert($this);

        }

        else
        {

            return $dao->Update($this);

        }

    }

    public function Disable(int $id, bool $ativamento)
    {

        (new ContaDAO())->Disable($id, $ativamento);

    }

    public function GetRows(int $filtro = null)
    {

        $dao = new ContaDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->Search($filtro);

    }

}

?>