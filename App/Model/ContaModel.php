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

        if($this->id_conta)
        {

            return $dao->Insert($this);

        }

        else
        {

            return $dao->Update($this);

        }

    }

    public function Erase(int $id)
    {

        (new ContaDAO())->Delete($id);

    }

    /*public function Gerar_Extrato()
    {

        

    }*/

}

?>