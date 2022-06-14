<?php

/*****************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados blocos
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 ****************************************************************/


//Importe do arquivo que vai buscar os dados no BD
require_once(SRC . '/model/sexo.php');

function listarSexo()
{
    //Chama a função que vai buscar os dados no BD
    $dados = selectAllSexo();

    if (!empty($dados))
        return $dados;
    else
        return false;
}
