<?php
/*******************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados vagas dentro do BD
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 *********************************************************************************/

 require_once('conexaoMyslq.php');


 function insertVaga($dadosVagas){
    $statusResposta = (boolean) false;

    $conexao = conexaoMysql();

    $script = "insert into tblVaga
                        (statusvaga,
                           preferencial,
                           idtipovaga,
                           idbloco)
                        values(
                            ".$dadosVagas['statusVaga'].",
                            ".$dadosVagas['preferencal'].",
                            ".$dadosVagas['idTipoVaga'].",
                            ".$dadosVagas['idBloco'].";
                        )";

    if(mysqli_query($conexao,$script)){
        if(mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMysql($conexao);

    return $statusResposta;

 }

 function uptadeVaga($dadosVagas){

 } 

 function deleteVaga($id){

 }

 function selectAllVaga(){

 }

 function selectByIdVaga(){

 }
