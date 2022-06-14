<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel pela manipulação de dados de controle, é aqui que fazemos todos os ajustes antes de mandar para o banco
 *  Obs(Este arquivo fará a ponte entre a View e a Model)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/



function inserirControle($dadosControle)
{

    if (!empty($dadosControle)) {

        if (!empty($dadosControle[0]['horaEntrada']) && !empty($dadosControle[0]['dataEntrada']) && !empty($dadosControle[0]['idVeiculo']) && !empty($dadosControle[0]['idVaga'])) {

            $arrayDados = array(
                "horaEntrada"      => $dadosControle[0]['horaEntrada'],
                "dataEntrada"      => $dadosControle[0]['dataEntrada'],
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

function buscarControle($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . './model/controle.php');

        $dados = selectByIdControle($id);

        if (!empty($dados))
            return $dados;
        else
            return false;
    } else {
        return array(
            'idErro'  => 4,
            'message' => 'Não é possível buscar um registro sem informar um id válido'
        );
    }
}

function listarControle($placa)
{
    require_once(SRC . './model/controle.php');

    $dados = selectControleByPlaca($placa);

    if (!empty($dados))
        return $dados;
    else
        return false;
}


function atualizarControle($dadosControle)
{
    //Recebe o id enviado pelo arrayDados
    $idControle = $dadosControle['id'];

    if (!empty($dadosControle)) {

        if (!empty($dadosControle[0]['idVeiculo']) && !empty($dadosControle[0]['idVaga'])) {

            if (!empty($idControle) && $idControle != 0 && is_numeric($idControle)) {

                $controle = selectControleByIdVaga($dadosControle[0]['idVaga']);

                echo($controle);

                $arrayDados = array(
                    "id"               => $idControle,
                    "horaEntrada"      => $dadosControle[0]['horaEntrada'],
                    "horaSaida"        => $dadosControle[0]['horaSaida'],
                    "dataEntrada"      => $dadosControle[0]['dataEntrada'],
                    "dataSaida"        => $dadosControle[0]['dataSaida'],
                    "idVeiculo"        => $dadosControle[0]['idVeiculo'],
                    "idVaga"           => $dadosControle[0]['idVaga'],
                    "preco"            => $controle['preco']
                );

                require_once(SRC . './model/controle.php');

                if (updateControle($arrayDados)) {
                    return true;

                } else
                    return array(
                        'idErro'  => 1,
                        'message' => 'Não foi possível atualizar os dados no Banco de Dados'
                    );
            } else
                return array(
                    'idErro'  => 4,
                    'message' => 'Não é possível editar um registro sem informar um id válido'
                );
        } else
            return array(
                'idErro'  => 2,
                'message' => 'Existem campos obrigatórios que não foram inseridos'
            );
    }
}

