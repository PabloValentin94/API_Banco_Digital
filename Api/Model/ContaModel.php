<?php

namespace Api\Model;

use Exception;

use Api\DAO\ContaDAO;

class ContaModel extends Model
{

    public $id_conta, $saldo, $limite, $tipo, $ativa, $fk_correntista, $data_abertura;

    public function Save()
    {

        $dao = new ContaDAO();

        if(empty($this->id_conta))
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