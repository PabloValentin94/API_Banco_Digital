<?php

use App\Controller\CorrentistaController;
use App\Controller\ContaController;
use App\Controller\ChavePixController;
use App\Controller\TransacaoController;

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{

    // Correntista:

    case "/correntista":
        CorrentistaController::List();
    break;

    case "/correntista/salvar":
        CorrentistaController::Register();
    break;

    /*case "/correntista/apagar":
        CorrentistaController::Remove();
    break;*/

    case "/correntista/desativar":
        CorrentistaController::Disable();
    break;

    case "/correntista/pesquisar":
        CorrentistaController::Search();
    break;

    // Conta:

    case "/conta":
        ContaController::List();
    break;

    case "/conta/salvar":
        ContaController::Register();
    break;

    /*case "/conta/apagar":
        ContaController::Remove();
    break;*/

    case "/conta/desativar":
        ContaController::Disable();
    break;

    case "/conta/pesquisar":
        ContaController::Search();
    break;

    /*case "/conta/gerar_extrato":
        ContaController::Generate_Extract();
    break;*/

    // Chave Pix:

    case "/chave_pix":
        ChavePixController::List();
    break;

    case "/chave_pix/salvar":
        ChavePixController::Register();
    break;

    case "/chave_pix/apagar":
        ChavePixController::Remove();
    break;

    case "/chave_pix/pesquisar":
        ChavePixController::Search();
    break;

    /*case "/chave_pix/atualizar_portador":
        ChavePixController::Update_Carrier();
    break;*/

    /*// Transação:

    case "/conta/pix/transferir":
        ContaController::Transferir();
    break;

    case "/conta/pix/cobrar":
        ContaController::Cobrar();
    break;

    default:
        http_response_code(404);*/
    
}

?>