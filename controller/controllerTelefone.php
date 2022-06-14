<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel pela manipulação de dados de telefone, é aqui que fazemos todos os ajustes antes de mandar para o banco
 *  Obs(Este arquivo fará a ponte entre a View e a Model)
 * Autor: Jennifer
 * Data: 03/06/2022
 * Versão: 1.0
 *************************************************************************************/



function inserirTelefone($dadosTelefone)
{

    if (!empty($dadosTelefone)) {

        
        if (!empty($dadosTelefone[0]['ddd']) && !empty($dadosTelefone[0]['numero']) && !empty($dadosTelefone[0]['idCliente'])) {

            $arrayDados = array(
                "ddd"        => $dadosTelefone[0]['ddd'],
                "numero"     => $dadosTelefone[0]['numero'],
                "idCliente"  => $dadosTelefone[0]['idCliente']

            );

            require_once(SRC . './model/telefone.php');

            if (insertTelefone($arrayDados))
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

function listarTelefone()
{
    require_once(SRC . 'model/telefone.php');

    $dados = selectAllTelefone();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

function buscarTelefone($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . 'model/telefone.php');

        $dados = selectByIdTelefone($id);

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

function excluirTelefone($id)
{
    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . 'model/telefone.php');

        if (deleteTelefone($id)) {

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

function atualizarTelefone($dadosTelefone)
{
    //Recebe o id enviado pelo arrayDados
    $idTelefone = $dadosTelefone['id'];

    if (!empty($dadosTelefone)) {

        if (!empty($dadosTelefone[0]['ddd']) && !empty($dadosTelefone[0]['numero']) && !empty($dadosTelefone[0]['idCliente'])) {

            if (!empty($idTelefone) && $idTelefone != 0 && is_numeric($idTelefone)) {

                $arrayDados = array(
                    "id"            => $idTelefone,
                    "ddd"           => $dadosTelefone[0]['ddd'],
                    "numero"        => $dadosTelefone[0]['numero'],
                    "idCliente"     => $dadosTelefone[0]['idCliente']
                );

                require_once(SRC . './model/telefone.php');

                if (updateTelefone($arrayDados)) {
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