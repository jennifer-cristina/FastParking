<?php

/*****************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados vagas
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 ****************************************************************/

//Importe do arquivo que vai buscar os dados no BD
require_once(SRC . '/model/vaga.php');

function inserirVaga($dadosVagas)
{
    if (!empty($dadosVagas)) {
        if (!empty($dadosVagas['statusVaga']) && !empty($dadosVagas['preferencial']) && !empty($dadosVagas['idTipoVaga']) && !empty($dadosVagas['idBloco'])) {


            $arrayDados = array(
                "statusVaga"   => $dadosVagas['statusVaga'],
                "preferencial" => $dadosVagas['preferencial'],
                "idTipoVaga"   => $dadosVagas['idTipoVaga'],
                "idBloco"      => $dadosVagas['idBloco']
            );

            require_once(SRC . '/model/vaga.php');

            if (insertVaga($arrayDados)) {
                return true;
            } else {
                return array(
                    'idErro'  => 1,
                    'message' => 'Não foi possível inserir os dados no Banco de dados'
                );
            }
        } else {
            return array(
                'idErro'  => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos'
            );
        }
    }
}

function atualizarVaga($dadosVagas)
{
    $id = $dadosVagas['id'];

    if (!empty($dadosVagas)) {
        if (!empty($id) && $id != 0 && is_numeric($id)) {
            if (!empty($dadosVagas[0]['statusVaga']) && !empty($dadosVagas[0]['preferencial']) && !empty($dadosVagas[0]['idTipoVaga']) && !empty($dadosVagas[0]['idBloco'])) {

                $arrayDados = array(
                    "id"           => $id,
                    "statusVaga"   => $dadosVagas[0]['statusVaga'],
                    "preferencial" => $dadosVagas[0]['preferencial'],
                    "idTipoVaga"   => $dadosVagas[0]['idTipoVaga'],
                    "idBloco"      => $dadosVagas[0]['idBloco']
                );

                require_once(SRC . '/model/vaga.php');

                if (uptadeVaga($arrayDados)) {
                    return true;
                } else {
                    return array(
                        'idErro'  => 1,
                        'message' => 'Não foi possível atualizar os dados no Banco de dados'
                    );
                }
            } else {
                return array(
                    'idErro'  => 2,
                    'message' => 'Existem campos obrigatórios que não foram preenchidos'
                );
            }
        } else {
            return array(
                'idErro'  => 3,
                'message' => 'Não é possível atualizar um registro sem informar um id  válido'
            );
        }
    }
}

function excluirVaga($id)
{
    if ($id != 0 && !empty($id) && is_numeric($id)) {
        if (deleteVaga($id)) {
            return true;
        } else {
            return array(
                'idErro'  => 3,
                'message' => 'O banco de dados não pode excluir o registro'
            );
        }
    } else {
        return array(
            'idErro'  => 3,
            'message' => 'Não é possível excluir um registro sem informar um id  válido'
        );
    }
}

function listarVaga()
{

    $dados = selectAllVaga();
    if (!empty($dados))
        return $dados;
    else
        return false;
}

function buscarVaga($id)
{
    if ($id != 0 && !empty($id) && is_numeric($id)) {
        //Chama a função na model que vai buscar no BD
        $dados = selectByIdVaga($id);

        //Valida se existem dados para serem devolvidos
        if (!empty($dados))
            return $dados;
        else
            return false;
    } else
        return array(
            'idErro'     => 4,
            'message'    => 'Não é possível buscar um registro sem informar um id válido'
        );
}
