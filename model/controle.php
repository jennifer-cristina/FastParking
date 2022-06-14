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
    $statusVaga = 'true';

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
            " . $dadosControle['idVeiculo'] . ", 
            " . $dadosControle['idVaga'] . ");";

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            uptadeVagaControle($dadosControle['idVaga'], $statusVaga);

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
    $statusVaga = 'false';

    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $sql = "update tblControle set 
                horaSaida      = TIME_FORMAT(NOW(), '%H:%i:%s'),  
                dataSaida      = DATE_FORMAT(NOW(), '%Y-%m-%d'), 
                idVeiculo      = '" . $dadosControle['idVeiculo'] . "',
                idVaga         = '" . $dadosControle['idVaga'] . "',
                preco          = '" . $dadosControle['preco'] . "'
            where id           = " . $dadosControle['id'];

    if (mysqli_query($conexao, $sql)) {

        if (mysqli_affected_rows($conexao)) {

            uptadeVagaControle($dadosControle['idVaga'], $statusVaga);

            $statusResposta = true;
        }
    }

    fecharConexaoMysql($conexao);
    return $statusResposta;
}

function selectControleByPlaca($placa)
{

    $conexao = conectarMysql();

    $sql = "SELECT tblVeiculo.placa, tblControle.*, TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) AS qtdeHoras,
    CASE 
        WHEN TIMESTAMPDIFF(DAY, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) > 1 THEN TIMESTAMPDIFF(DAY, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) * tblTipoVaga.precoDiaria
        WHEN TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) <= 1 THEN tblTipoVaga.precoHora
        WHEN TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) > 1 THEN (TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) - 1) * tblTipoVaga.precoAdicional + tblTipoVaga.precoHora
    END preco
    FROM tblVeiculo
    INNER JOIN tblControle
        ON tblVeiculo.id = tblControle.idVeiculo
    INNER JOIN tblVaga
        ON tblControle.idVaga = tblVaga.id
    INNER JOIN tblTipoVaga
        ON tblVaga.idTipoVaga = tblTipoVaga.id
    WHERE tblVeiculo.placa = '". $placa ."' AND tblControle.horaSaida IS NULL AND tblControle.dataSaida IS NULL;";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(
                "id"               =>  $rsDados['id'],
                "horaEntrada"      =>  $rsDados['horaEntrada'],
                "horaSaida"        =>  $rsDados['horaSaida'],
                "dataEntrada"      =>  $rsDados['dataEntrada'],
                "dataSaida"        =>  $rsDados['dataSaida'],
                "idVeiculo"        =>  $rsDados['idVeiculo'],
                "idVaga"           =>  $rsDados['idVaga'],
                "qtdeHoras"        =>  $rsDados['qtdeHoras'],
                "preco"            =>  $rsDados['preco']
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


function selectControleByIdVaga($idVaga)
{

    $conexao = conectarMysql();

    $sql = "SELECT tblVeiculo.placa, tblControle.*, TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) AS qtdeHoras,
    CASE 
        WHEN TIMESTAMPDIFF(DAY, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) > 1 THEN TIMESTAMPDIFF(DAY, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) * tblTipoVaga.precoDiaria
        WHEN TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) <= 1 THEN tblTipoVaga.precoHora
        WHEN TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) > 1 THEN (TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada),CURDATE()) - 1) * tblTipoVaga.precoAdicional + tblTipoVaga.precoHora
    END preco
    FROM tblVeiculo
    INNER JOIN tblControle
        ON tblVeiculo.id = tblControle.idVeiculo
    INNER JOIN tblVaga
        ON tblControle.idVaga = tblVaga.id
    INNER JOIN tblTipoVaga
        ON tblVaga.idTipoVaga = tblTipoVaga.id
    WHERE tblControle.idVaga = '". $idVaga ."' AND tblControle.horaSaida IS NULL AND tblControle.dataSaida IS NULL;";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(
                "id"               =>  $rsDados['id'],
                "horaEntrada"      =>  $rsDados['horaEntrada'],
                "horaSaida"        =>  $rsDados['horaSaida'],
                "dataEntrada"      =>  $rsDados['dataEntrada'],
                "dataSaida"        =>  $rsDados['dataSaida'],
                "idVeiculo"        =>  $rsDados['idVeiculo'],
                "idVaga"           =>  $rsDados['idVaga'],
                "qtdeHoras"        =>  $rsDados['qtdeHoras'],
                "preco"            =>  $rsDados['preco']
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
