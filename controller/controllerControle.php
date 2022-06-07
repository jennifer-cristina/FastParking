<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel pela manipulação de dados de controle, é aqui que fazemos todos os ajustes antes de mandar para o banco
 *  Obs(Este arquivo fará a ponte entre a View e a Model)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once(SRC . './modulo/config.php');

function inserirControle($dadosControle)
{

    if (!empty($dadosControle)) {

        if (!empty($dadosControle[0]['horaEntrada']) && !empty($dadosControle[0]['dataEntrada']) && !empty($dadosControle[0]['idVeiculo']) && !empty($dadosControle[0]['idVaga'])) {

            $arrayDados = array(
                "horaEntrada"      => $dadosControle[0]['horaEntrada'],
                "horaSaida"        => $dadosControle[0]['horaSaida'],
                "dataEntrada"      => $dadosControle[0]['dataEntrada'],
                "dataSaida"        => $dadosControle[0]['dataSaida'],
                "idVeiculo"        => $dadosControle[0]['idVeiculo'],
                "idVaga"           => $dadosControle[0]['idVaga']

            );

            require_once(SRC . './model/controle.php');

            if (insertControle($arrayDados))
                return true;
            else
                return array(
                    'idErro'  => 1,
                    'message' => 'Não foi possível inserir os dados no Banco de Dados'
                );
        } else
            return array(
                'idErro'  => 2,
                'message' => 'Existem campos obrigatórios que não foram inseridos'
            );
    }
}