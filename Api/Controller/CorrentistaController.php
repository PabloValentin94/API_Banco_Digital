<?php

namespace Api\Controller;

use Exception;

use Api\Model\CorrentistaModel;

class CorrentistaController extends Controller
{

    public static function SaveAsyncCorrentista() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            $model = new CorrentistaModel();

            if(!empty($objeto_json->id_correntista))
            {

                $model->id_correntista = $objeto_json->id_correntista;

            }

            $model->nome = $objeto_json->nome;

            $model->cpf = $objeto_json->cpf;

            $model->data_nascimento = $objeto_json->data_nascimento;

            $model->senha_correntista = $objeto_json->senha_correntista;

            $model->ativo = $objeto_json->ativo;

            parent::SendReturnAsJson($model->Save());

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function DisableAsyncCorrentista() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            (new CorrentistaModel())->Disable((int) $objeto_json->id_correntista, (bool) $objeto_json->ativo);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function GetListAsyncCorrentista() : void
    {

        try
        {

            $model = new CorrentistaModel();

            $model->GetRows();

            parent::SendReturnAsJson($model->rows);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function SearchAsyncCorrentista() : void
    {

        try
        {

            $filtro = json_decode(file_get_contents("php://input"));

            $model = new CorrentistaModel();

            $model->GetRows($filtro);

            parent::SendReturnAsJson($model->rows);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

    public static function LoginAsyncCorrentista() : void
    {

        try
        {

            $objeto_json = json_decode(file_get_contents("php://input"));

            $model = new CorrentistaModel();

            $usuario = $objeto_json[0];

            $senha = $objeto_json[1];

            $model->LoginValidation($usuario, $senha);

            parent::SendReturnAsJson($model->rows);

        }

        catch(Exception $ex)
        {

            parent::SendExceptionAsJson($ex);

        }

    }

}

?>