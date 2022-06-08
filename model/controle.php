<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel por manipular os dados dentro do banco de dados (insert, update, select e delete)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once('conexaoMysql.php');
require_once('vaga.php');

function insertControle($dadosControle)
{

    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "insert into tblControle
                (horaEntrada, 
                dataEntrada, 
                idVeiculo, 
                idVaga)
            values
            ('" . $dadosControle['horaEntrada'] . "',
			'" . $dadosControle['dataEntrada'] . "', 
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

function selectByIdControle($id)
{
    $conexao = conectarMysql();

    $sql = "select * from tblControle where id = " . $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        if ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados = array(
                "id"            =>  $rsDados['id'],
                "horaEntrada"   =>  $rsDados['horaEntrada'],
                "horaSaida"     =>  $rsDados['horaSaida'],
                "dataEntrada"   =>  $rsDados['dataEntrada'],
                "dataSaida"     =>  $rsDados['dataSaida'],
                "idVeiculo"     =>  $rsDados['idVeiculo'],
                "idVaga"        =>  $rsDados['idVaga']
            );
        }
    }

    fecharConexaoMysql($conexao);

    if (isset($arrayDados))
        return $arrayDados;
    else
        return false;
}

function updateControle($dadosControle)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "update tblControle set 
                horaEntrada    = '" . $dadosControle['horaEntrada'] . "', 
                horaSaida      = '" . $dadosControle['horaSaida'] . "', 
                dataEntrada    = '" . $dadosControle['dataEntrada'] . "', 
                dataSaida      = '" . $dadosControle['dataSaida'] . "', 
                idVeiculo      = '" . $dadosControle['idVeiculo'] . "',
                idVaga         = '" . $dadosControle['idVaga'] . "'
            where id           = " . $dadosControle['id'];

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }

    fecharConexaoMysql($conexao);
    return $statusResposta;
}