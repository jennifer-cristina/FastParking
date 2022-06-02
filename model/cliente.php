<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel por manipular os dados dentro do banco de dados (insert, update, select e delete)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once('conexaoMysql.php');

function insertCliente($dadosCliente)
{

    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "insert into tblCliente
                (nome, 
                cpf, 
                rg, 
                cnh, 
                idSexo)
            values
            ('" . $dadosCliente['nome'] . "',
			'" . $dadosCliente['cpf'] . "', 
			'" . $dadosCliente['rg'] . "', 
			'" . $dadosCliente['cnh'] . "', 
            '" . $dadosCliente['idSexo'] . "');";

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }
    fecharConexaoMysql($conexao);
    return $statusResposta;
}

function selectAllCliente()
{

    $conexao = conectarMysql();

    $sql = "select * from tblCliente order by id asc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(
                "id"        =>  $rsDados['id'],
                "nome"      =>  $rsDados['nome'],
                "rg"        =>  $rsDados['rg'],
                "cpf"       =>  $rsDados['cpf'],
                "cnh"       =>  $rsDados['cnh'],
                "idSexo"    =>  $rsDados['idSexo']
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

function selectByIdCliente($id)
{
    $conexao = conectarMysql();

    $sql = "select * from tblCliente where id = " . $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        if ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados = array(
                "id"        =>  $rsDados['id'],
                "nome"      =>  $rsDados['nome'],
                "rg"        =>  $rsDados['rg'],
                "cpf"       =>  $rsDados['cpf'],
                "cnh"       =>  $rsDados['cnh'],
                "idSexo"    =>  $rsDados['idSexo']
            );
        }
    }

    fecharConexaoMysql($conexao);

    if (isset($arrayDados))
        return $arrayDados;
    else
        return false;
}

function deleteCliente($id)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "delete from tblCliente where id=" . $id;

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMysql($conexao);

    return $statusResposta;
}

function updateCliente($dadosCliente)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "update tblCliente set 
                nome        = '" . $dadosCliente['nome'] . "', 
                rg          = '" . $dadosCliente['rg'] . "', 
                cpf         = '" . $dadosCliente['cpf'] . "', 
                cnh         = '" . $dadosCliente['cnh'] . "', 
                idSexo      = '" . $dadosCliente['idSexo'] . "'
            where id        = " . $dadosCliente['id'];

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            $statusResposta = true;
        }
    }

    fecharConexaoMysql($conexao);
    return $statusResposta;
}

?>