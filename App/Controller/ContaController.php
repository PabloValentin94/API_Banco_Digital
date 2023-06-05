<?php

namespace App\Controller;

use Exception;

use App\Model\ContaModel;

class ContaController extends Controller
{

    public static function Register() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            $model = new ContaModel();

            //$model->id_conta = $objeto_json->id;

            $model->numero = $objeto_json->numero;

            $model->tipo = $objeto_json->tipo;

            $model->senha_conta = $objeto_json->senha_conta;

            $model->ativa = $objeto_json->ativa;

            $model->fk_correntista = $objeto_json->fk_correntista;

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

            $id_conta = json_decode(file_get_contents("php://input"));

            (new ContaModel())->Erase((int) $id);

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

            (new ContaModel())->Disable((int) $objeto_json->id_conta, (bool) $objeto_json->ativa);

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

            $model = new ContaModel();

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

            $model = new ContaModel();

            $conteudo = json_decode(file_get_contents("php://input"));

            $model->Query($conteudo);

            parent::GetResponseAsJSON($model->rows);

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

    /*public static function Generate_Extract() : void
    {

        try
        {



        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }*/

}

?>