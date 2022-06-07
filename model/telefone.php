<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel por manipular os dados dentro do banco de dados (insert, update, select e delete)
 * Autor: Jennifer
 * Data: 03/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once('conexaoMysql.php');

function insertTelefone($dadosTelefone)
{

    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "insert into tblTelefone 
                (ddd, 
                numero, 
                idCliente)
            values
            ('" . $dadosTelefone['ddd'] . "',
			'" . $dadosTelefone['numero'] . "', 
            '" . $dadosTelefone['idCliente'] . "');";

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }

    fecharConexaoMysql($conexao);
    return $statusResposta;
}

function selectAllTelefone()
{

    $conexao = conectarMysql();

    $sql = "select * from tbltelefone order by id asc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(
                "id"         =>  $rsDados['id'],
                "ddd"        =>  $rsDados['ddd'],
                "numero"     =>  $rsDados['numero'],
                "idCliente"  =>  $rsDados['idCliente']
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

function selectByIdTelefone($id)
{
    $conexao = conectarMysql();

    $sql = "select * from tblTelefone where id = " . $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        if ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados = array(
                "id"         =>  $rsDados['id'],
                "ddd"        =>  $rsDados['ddd'],
                "numero"     =>  $rsDados['numero'],
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

function deleteTelefone($id)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "delete from tblTelefone where id=" . $id;

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMysql($conexao);

    return $statusResposta;
}

function updateTelefone($dadosTelefone)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "update tblTelefone set 
                ddd         = '" . $dadosTelefone['ddd'] . "', 
                numero      = '" . $dadosTelefone['numero'] . "', 
                idCliente   = '" . $dadosTelefone['idCliente'] . "'
            where id        = " . $dadosTelefone['id'];

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }

    fecharConexaoMysql($conexao);
    return $statusResposta;
}
