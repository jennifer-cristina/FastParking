<?php
/*****************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados vagas
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 ****************************************************************/

function inserirVaga($dadosVagas){
    if(!empty($dadosVagas)){
        if(!empty($dadosVagas['statusVaga']) && !empty($dadosVagas['preferencial']) && !empty($dadosVagas['idTipoVaga']) && !empty($dadosVagas['idBloco'])){

            $arrayDados = array(
                "statusVaga"   => $dadosVagas[0]['statusVaga'],
                "preferencial" => $dadosVagas[0]['preferencial'],
                "idTipoVaga"   => $dadosVagas[0]['idTipoVaga'],
                "idBloco"      => $dadosVagas[0]['idBloco']
            );

            require_once(SRC . '/model/vaga.php');

            if(insertVaga($arrayDados)){
                return true;
            }else{
                return array(
                    'idErro'  => 1,
                    'message' => 'Não foi possível inserir os dados no Banco de dados'
                );
            }
        }else{
            return array(
                'idErro'  => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos'
            );
        }
    }
}

function atualizarVaga($dadosVagas){

} 

function excluirVaga($id){

}

function listarVaga(){

}

function buscarVaga($id){
    
}




?>