<?php

namespace App\Model;

use Exception;

use App\DAO\ChavePixDAO;

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

    public function Query(string $filtro = null)
    {

        $dao = new ChavePixDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->SelectByChavePix($filtro);

    }

    /*public function Update_Carrier()
    {

        
        
    }*/

}

?>