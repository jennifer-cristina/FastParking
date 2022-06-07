<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel por manipular os dados dentro do banco de dados (insert, update, select e delete)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once('conexaoMysql.php');

function insertControle($dadosControle)
{

    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "insert into tblControle
                (horaEntrada, 
                horaSaida, 
                dataEntrada, 
                dataSaida, 
                idVeiculo, 
                idVaga)
            values
            ('" . $dadosControle['horaEntrada'] . "',
			'" . $dadosControle['horaSaida'] . "', 
			'" . $dadosControle['dataEntrada'] . "', 
			'" . $dadosControle['dataSaida'] . "', 
            '" . $dadosControle['idVeiculo'] . "', 
            '" . $dadosControle['idVaga'] . "');";

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }
    fecharConexaoMysql($conexao);
    return $statusResposta;
}