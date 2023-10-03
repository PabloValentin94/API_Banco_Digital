<?php

namespace Api\Controller;

use Exception;

use Api\Model\ChavePixModel;

class ChavePixController extends Controller
{

    public static function SaveAsyncChavePix() : void
    {

        try
        {

            $model = new ChavePixModel();

            $objeto_json = json_decode(file_get_contents("php://input"));

            if($objeto_json->id != null)
            {

                $model->id = $objeto_json->id;

            }

            $model->chave = $objeto_json->chave;

            $model->tipo = $objeto_json->tipo;

            $model->fk_conta = $objeto_json->fk_conta;

            parent::SendReturnAsJson($model->Save());

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function RemoveAsyncChavePix() : void
    {

        try
        {

            $id = json_decode(file_get_contents("php://input"));

            (new ChavePixModel())->Erase((int) $id);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function GetListAsyncChavePix() : void
    {

        try
        {

            $model = new ChavePixModel();

            $model->GetRows();

            parent::SendReturnAsJson($model->rows);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function SearchAsyncChavePix() : void
    {

        try
        {

            $filtro = json_decode(file_get_contents("php://input"));

            $model = new ChavePixModel();

            $model->GetRows($filtro);

            parent::SendReturnAsJson($model->rows);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

}

?>