<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel pela manipulação de dados de clientes, é aqui que fazemos todos os ajustes antes de mandar para o banco
 *  Obs(Este arquivo fará a ponte entre a View e a Model)
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once(SRC . './modulo/config.php');

function inserirCliente($dadosCliente)
{

    if (!empty($dadosCliente)) {

        if (!empty($dadosCliente[0]['nome']) && !empty($dadosCliente[0]['cpf']) && !empty($dadosCliente[0]['idSexo'])) {

            $arrayDados = array(
                "nome"      => $dadosCliente[0]['nome'],
                "cpf"       => $dadosCliente[0]['cpf'],
                "rg"        => $dadosCliente[0]['rg'],
                "cnh"       => $dadosCliente[0]['cnh'],
                "idSexo"    => $dadosCliente[0]['idSexo']

            );

            require_once(SRC . './model/cliente.php');

            if (insertCliente($arrayDados))
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

function listarCliente()
{
    require_once(SRC . 'model/cliente.php');

    $dados = selectAllCliente();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

function buscarCliente($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . 'model/cliente.php');

        $dados = selectByIdCliente($id);

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

function excluirCliente($id)
{
    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once(SRC . 'model/cliente.php');

        if (deleteCliente($id)) {

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

function atualizarCliente($dadosCliente)
{
    //Recebe o id enviado pelo arrayDados
    $idCliente = $dadosCliente['id'];

    if (!empty($dadosCliente)) {

        var_dump($dadosCliente);
        die;

        if (!empty($dadosCliente[0]['nome']) && !empty($dadosCliente[0]['cpf']) && !empty($dadosCliente[0]['idSexo'])) {

            if (!empty($idCliente) && $idCliente != 0 && is_numeric($idCliente)) {

                $arrayDados = array(
                    "id"        => $idCliente,
                    "nome"      => $dadosCliente[0]['nome'],
                    "rg"        => $dadosCliente[0]['rg'],
                    "cpf"       => $dadosCliente[0]['cpf'],
                    "cnh"       => $dadosCliente[0]['cnh'],
                    "idSexo"    => $dadosCliente[0]['idSexo']
                );

                require_once(SRC . './model/cliente.php');

                if (updateCliente($arrayDados)) {
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
