<?php

/*****************************************************************************
 *  Objetivo: Arquivo principal da API que irá receber a URL requisitada
 *  e redirecionar para as APIs(router)
 *  Data: 09/06/2022
 *  Autoras: Jennifer e Laise
 *  Versão: 1.0
 ******************************************************************************/

// Permite ativar quais endereços de sites que poderão fazer requisições na API
header('Access-Control-Allow-Origin: *');

// Permite ativar os metódos do protocolo HTTP que irão requisitar a API
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

// Permite ativar o Content-Type das requisições (Formato de dados que será utilizado (JSON, XML, FORM/DATA, etc.))
header('Access-Control-Allow-Header: Content-Type');

// Permite liberar quais Content-Type serão utilizados na API
header('Content-Type: application/json');

// Recebe a url digitada na requisição
$urlHTTP = (string) $_GET['url'];

// Converte a url requisitada em um array para dividir as opções de busca, que é separa 
$url = explode('/', $urlHTTP);

// Verifica qual API será encaminhada a requisição (cliente, telefone, etc)
switch (strtoupper($url[0])) {

    case 'CLIENTE':
        require_once('clienteAPI/index.php');
        break;

    case 'TELEFONE':
        require_once('telefoneAPI/index.php');
        break;

    case 'VEICULO':
        require_once('veiculoAPI/index.php');
        break;

    case 'CONTROLE':
        require_once('controleAPI/index.php');
        break;

    case 'VAGA':  
        require_once('vagasAPI/index.php');
        break;

    case 'BLOCO':
        require_once('./blocoAPI/index.php');
        break;

    case 'TIPOVAGA':
        require_once('tipoVagaAPI/index.php');
        break;

    case 'SEXO':
        require_once('sexoAPI/index.php');
        break;
    case 'COR':
        require_once('corAPI/index.php');
        break;
}
