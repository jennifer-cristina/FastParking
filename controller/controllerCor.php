<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel pela manipulação de dados de clientes, é aqui que fazemos todos os ajustes antes de mandar para o banco
 *  Obs(Este arquivo fará a ponte entre a View e a Model)
 * Autor: Jennifer
 * Data: 08/06/2022
 * Versão: 1.0
 *************************************************************************************/



function listarCor()
{
    require_once(SRC . './model/cor.php');

    $dados = selectAllCor();

    if (!empty($dados))
        return $dados;
    else
        return false;
}