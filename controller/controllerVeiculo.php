<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel pela manipulação de dados de veiculo, é aqui que fazemos todos os ajustes antes de mandar para o banco
 *  Obs(Este arquivo fará a ponte entre a View e a Model)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/



function inserirVeiculo($dadosVeiculo)
{

    if (!empty($dadosVeiculo)) {

        if (!empty($dadosVeiculo[0]['placa']) && !empty($dadosVeiculo[0]['idCor']) && !empty($dadosVeiculo[0]['idCliente'])) {

            $arrayDados = array(
                "placa"        => $dadosVeiculo[0]['placa'],
                "idCor"        => $dadosVeiculo[0]['idCor'],
                "idCliente"    => $dadosVeiculo[0]['idCliente']

            );

            require_once(SRC . './model/veiculo.php');

            if (insertVeiculo($arrayDados))
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

function listarVeiculo()
{
    require_once(SRC . './model/veiculo.php');

    $dados = selectAllVeiculo();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

function buscarVeiculo($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . './model/veiculo.php');

        $dados = selectByIdVeiculo($id);

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

function buscarPlacaVeiculo($placa)
{

    if (!empty($placa)) {

        require_once(SRC . './model/veiculo.php');

        $dados = selectByBoardVeiculo($placa);

        if (!empty($dados))
            return $dados;
        else
            return false;
    } else {
        return array(
            'idErro'  => 4,
            'message' => 'Não é possível buscar um registro sem informar um placa válida'
        );
    }
}

function excluirVeiculo($id)
{
    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . './model/veiculo.php');

        if (deleteVeiculo($id)) {

            return true;
        } else
            return array(
                'idErro'  => 3,
                'message' => 'O banco não pode excluir o registro'
            );
    } else
        return array(
            'idErro'  => 4,
            'message' => 'Não é possível excluir um registro sem informar um id válido'
        );
}

function atualizarVeiculo($dadosVeiculo)
{
    //Recebe o id enviado pelo arrayDados
    $idVeiculo = $dadosVeiculo['id'];

    if (!empty($dadosVeiculo)) {

        if (!empty($dadosVeiculo[0]['placa']) && !empty($dadosVeiculo[0]['idCor']) && !empty($dadosVeiculo[0]['idCliente'])) {

            if (!empty($idVeiculo) && $idVeiculo != 0 && is_numeric($idVeiculo)) {

                $arrayDados = array(
                    "id"        => $idVeiculo,
                    "placa"      => $dadosVeiculo[0]['placa'],
                    "idCor"        => $dadosVeiculo[0]['idCor'],
                    "idCliente"    => $dadosVeiculo[0]['idCliente']
                );

                require_once(SRC . './model/veiculo.php');

                if (updateVeiculo($arrayDados)) {
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
