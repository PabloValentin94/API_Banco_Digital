<?php

namespace Api\Controller;

use Exception;

abstract class Controller
{

    protected static function SendReturnAsJson($data) : void
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($data));

    }

    protected static function SendExceptionAsJson(Exception $ex) : void
    {

        $exception = [
            "message" => $ex->getMessage(),
            "code" => $ex->getCode(),
            "file" => $ex->getFile(),
            "line" => $ex->getLine(),
            "traceAsString" => $ex->getTraceAsString(),
            "previous" => $ex->getPrevious()
        ];

        http_response_code(400);

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($exception));

    }

    public static function SetReturnAsJson($data, $request_status = true)
    {

        $retorno = array("dados_retornados" => $data, "exito" => $request_status);

        header("Access-Control-Allow-Origin: *");
        header("Content-type: application/json; charset=utf-8");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Pragma: public");

        exit(json_encode($retorno));

    }

    protected static function IsGet() : void
    {

        if($_SERVER["REQUEST_METHOD"] !== "GET")
        {

            throw new Exception("O método de requisição deve ser GET!");

        }

    }

    protected static function IsPost() : void
    {

        if($_SERVER["REQUEST_METHOD"] !== "POST")
        {

            throw new Exception("O método de requisição deve ser POST!");

        }

    }

    protected static function GetIntFromURL($var_get, $var_name = null) : int
    {

        self::IsGet();

        if(!empty($var_get))
        {

            return (int) $var_get;

        }

        else
        {

            throw new Exception("Variável $var_name não identificada!");

        }

    }

    protected static function GetStringFromURL($var_get, $var_name = null) : string
    {

        self::IsGet();

        if(!empty($var_get))
        {

            return (string) $var_get;

        }

        else
        {

            throw new Exception("Variável $var_name não identificada!");

        }

    }

}

?>