<?php

namespace App\Controller;

use Exception;

use App\Model\ChavePixModel;

class ChavePixController extends Controller
{

    public static function Register() : void
    {

        try
        {

            $model = new ChavePixModel();

            $objeto_json = json_decode(file_get_contents("php://input"));

            //$model->id_chave_pix = $objeto_json->id_chave_pix;

            $model->chave = $objeto_json->chave;

            $model->tipo = $objeto_json->tipo;

            $model->fk_conta = $objeto_json->fk_conta;

            parent::GetResponseAsJSON($model->Save());

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

    public static function Remove() : void
    {

        try
        {

            $id = json_decode(file_get_contents("php://input"));

            (new ChavePixModel())->Erase((int) $id);

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

            $model = new ChavePixModel();

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

            $model = new ChavePixModel();

            $conteudo = json_decode(file_get_contents("php://input"));

            $model->Query($conteudo);

            parent::GetResponseAsJSON($model->rows);

        }

        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }

    }

    /*public static function Update_Carrier() : void
    {

        

    }*/

}

?>