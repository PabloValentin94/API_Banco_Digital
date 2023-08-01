<?php

use Api\Controller\
{

    CorrentistaController,
    ContaController,
    ChavePixController,
    TransacaoController

};

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{

    case "/":
        echo "Início";
    break;

    // Correntista:

    case "/correntista/save":
        CorrentistaController::SaveAsyncCorrentista();
    break;

    case "/correntista/disable":
        CorrentistaController::DisableAsyncCorrentista();
    break;

    case "/correntista/list":
        CorrentistaController::GetListAsyncCorrentista();
    break;

    case "/correntista/search":
        CorrentistaController::SearchAsyncCorrentista();
    break;

    case "/correntista/login":
        CorrentistaController::LoginAsyncCorrentista();
    break;

    // Conta:

    case "/conta/save":
        ContaController::SaveAsyncConta();
    break;

    case "/conta/disable":
        ContaController::DisableAsyncConta();
    break;

    case "/conta/list":
        ContaController::GetListAsyncConta();
    break;

    case "/conta/search":
        ContaController::SearchAsyncConta();
    break;

    // Chave Pix:

    case "/chave_pix/save":
        ChavePixController::SaveAsyncChavePix();
    break;

    case "/chave_pix/remove":
        ChavePixController::RemoveAsyncChavePix();
    break;

    case "/chave_pix/list":
        ChavePixController::GetListAsyncChavePix();
    break;

    case "/chave_pix/search":
        ChavePixController::SearchAsyncChavePix();
    break;

    default:
        http_response_code(404);
    break;
    
}

?>