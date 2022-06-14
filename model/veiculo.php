<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel por manipular os dados dentro do banco de dados (insert, update, select e delete)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once('conexaoMysql.php');

function insertVeiculo($dadosVeiculo)
{

    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "insert into tblVeiculo
                (placa, 
                idCor, 
                idCliente)
            values
            ('" . $dadosVeiculo['placa'] . "',
			'" . $dadosVeiculo['idCor'] . "', 
            '" . $dadosVeiculo['idCliente'] . "');";

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }
    fecharConexaoMysql($conexao);
    return $statusResposta;
}

function selectAllVeiculo()
{

    $conexao = conectarMysql();

    $sql = "select * from tblVeiculo order by id asc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(
                "id"           =>  $rsDados['id'],
                "placa"        =>  $rsDados['placa'],
                "idCor"        =>  $rsDados['idCor'],
                "idCliente"    =>  $rsDados['idCliente']
            );
            $cont++;
        }

        fecharConexaoMysql($conexao);

        if (isset($arrayDados))
            return $arrayDados;
        else
            return false;
    }
}

function selectByIdVeiculo($id)
{
    $conexao = conectarMysql();

    $sql = "select * from tblVeiculo where id = " . $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        if ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados = array(
                "id"         =>  $rsDados['id'],
                "placa"      =>  $rsDados['placa'],
                "idCor"      =>  $rsDados['idCor'],
                "idCliente"  =>  $rsDados['idCliente']
            );
        }
    }

    fecharConexaoMysql($conexao);

    if (isset($arrayDados))
        return $arrayDados;
    else
        return false;
}

function selectByBoardVeiculo($placa){

    $conexao = conectarMysql();

    $sql = "SELECT tblCliente.nome FROM (tblVeiculo INNER JOIN tblCliente 
            ON tblVeiculo.idCliente = tblCliente.id) 
            WHERE tblVeiculo.placa ='" . $placa . "'";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        if ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados = array(
                "nome"  =>  $rsDados['nome']
            );
        }
    }

    fecharConexaoMysql($conexao);

    if (isset($arrayDados))
        return $arrayDados;
    else
        return false;

}

function deleteVeiculo($id)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "delete from tblVeiculo where id=" . $id;

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMysql($conexao);

    return $statusResposta;
}

function updateVeiculo($dadosVeiculo)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "update tblVeiculo set 
                placa          = '" . $dadosVeiculo['placa'] . "', 
                idCor          = '" . $dadosVeiculo['idCor'] . "', 
                idCliente      = '" . $dadosVeiculo['idCliente'] . "'
            where id           = " . $dadosVeiculo['id'];

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }

    fecharConexaoMysql($conexao);
    return $statusResposta;
}