<?php

namespace App\Controller;

use Exception;

use App\Model\CorrentistaModel;

class CorrentistaController extends Controller
{

    public static function Register() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            $model = new CorrentistaModel();

            //$model->id_correntista = $objeto_json->id;

            $model->cpf = $objeto_json->cpf;

            $model->data_nascimento = $objeto_json->data_nascimento;

            $model->senha_correntista = $objeto_json->senha_correntista;

            $model->ativo = $objeto_json->ativo;

            parent::GetResponseAsJSON($model->Save());

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

    /*public static function Remove() : void
    {

        try
        {

            $id = json_decode(file_get_contents("php://input"));

            (new CorrentistaModel())->Erase((int) $id);

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }*/

    public static function Disable() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            (new CorrentistaModel())->Disable((int) $objeto_json->id_correntista, (bool) $objeto_json->ativo);

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

    public static function List() : void
    {

        try
        {

            $model = new CorrentistaModel();

            $model->Query();

            parent::GetResponseAsJSON($model->rows);

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

    public static function Search() : void
    {

        try
        {

            $model = new CorrentistaModel();

            $conteudo = json_decode(file_get_contents("php://input"));

            $model->Query($conteudo);

            parent::GetResponseAsJSON($model->rows);

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

}

?>