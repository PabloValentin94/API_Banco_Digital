<?php

namespace Api\Controller;

use Exception;

use Api\Model\ContaModel;

class ContaController extends Controller
{

    public static function SaveAsyncConta() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            $model = new ContaModel();

            if(!empty($objeto_json->id_conta))
            {

                $model->id_conta = $objeto_json->id_conta;

            }

            $model->saldo = $objeto_json->saldo;

            $model->limite = $objeto_json->limite;

            $model->tipo = $objeto_json->tipo;

            $model->ativa = $objeto_json->ativa;

            $model->fk_correntista = $objeto_json->fk_correntista;

            parent::SendReturnAsJson($model->Save());

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function DisableAsyncConta() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            (new ContaModel())->Disable((int) $objeto_json->id_conta, (bool) $objeto_json->ativa);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function GetListAsyncConta() : void
    {

        try
        {

            $model = new ContaModel();

            $model->GetRows();

            parent::SendReturnAsJson($model->rows);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function SearchAsyncConta() : void
    {

        try
        {

            $filtro = json_decode(file_get_contents("php://input"));

            $model = new ContaModel();

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