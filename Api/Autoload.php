<?php

spl_autoload_register(function($nome_classe)
{

    $arquivo = BASEDIR . $nome_classe . ".php";

    if(file_exists($arquivo))
    {

        include $arquivo;

    }

    else
    {

        exit("Ocorreu um erro! Arquivo onde o erro foi disparado: $arquivo");

    }

})

?>