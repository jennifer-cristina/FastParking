<?php

/********************************************************************************************
 * Objetivo: Arquivo responsável pela criação de variáveis e constantes do projeto
 * Autoras: Jennifer e Laise
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

// define: 
define('SRC', $_SERVER['DOCUMENT_ROOT'].'/fastParking/FastParking');

//função para converter um array em formato json
function createJSON($arrayDados)
{
    //validação para tratar array sem dados
    if(!empty($arrayDados)){
        //json_encode converte o array para json
        //json_decode faz o inverso

        //configura o padrão da conversão para formato json
        header('Content-Type: application/json');

        return json_encode($arrayDados);
    }else{
        return false;
    }
}
