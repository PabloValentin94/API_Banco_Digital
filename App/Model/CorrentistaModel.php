<?php

namespace App\Model;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{

    public $id_correntista, $nome, $cpf, $data_nascimento, $senha_correntista, $ativo;

    public function Save()
    {

        $dao = new CorrentistaDAO();

        if(empty($this->id_correntista))
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

        (new CorrentistaDAO())->Delete($id);

    }*/

    public function Disable(int $id, bool $ativamento)
    {

        (new CorrentistaDAO())->Disable($id, $ativamento);

    }

    public function Query(string $filtro = null)
    {

        $dao = new CorrentistaDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->SelectByNomeCorrentista($filtro);

    }

}

?>