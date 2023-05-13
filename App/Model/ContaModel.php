<?php

namespace App\Model;

use Exception;

use App\DAO\ContaDAO;

class ContaModel extends Model
{

    public $id_conta, $numero, $tipo, $senha_conta, $ativa, $fk_correntista;

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

    /*public function Erase(int $id)
    {

        (new ContaDAO())->Delete($id);

    }*/

    public function Disable(int $id, bool $ativamento)
    {

        (new ContaDAO())->Disable($id, $ativamento);

    }

    public function Query(string $filtro = null)
    {

        $dao = new ContaDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->SelectByIDConta($filtro);

    }

    /*public function Generate_Extract()
    {

        

    }*/

}

?>