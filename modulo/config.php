<?php

/********************************************************************************************
 * Objetivo: Arquivo responsável pela criação de variáveis e constantes do projeto
 * Autor: Jennifer
 * Data: 02/06/2022
 * Versão: 1.0
 *************************************************************************************/

// define: 
define('SRC', $_SERVER['DOCUMENT_ROOT'] . '/Jennifer/FastParking/');

/****************************FUNÇÕES GLOBAIS PARA O PROJETO****************************** */

// Função para converter um array em um formato JSON
function createJSON($arrayDados)
{

    // Validação para tratar array sem dados
    if (!empty($arrayDados)) {
        // Configura o padrão da conversão para formato JSON
        header('Content-Type: application/json');
        $dadosJSON = json_encode($arrayDados);

        // json_encode(); converte um array para JSON
        // json_decode(); converte um JSON para array

        return $dadosJSON;
    } else {
        return false;
    }
}
