<?php

/*************************************************************
 *  $request: Recebe dados do corpo da requisição (JSON, XML, FORM/DATA)
 *  $response: Envia dados de retorno da API
 *  $args: Permite receber dadso de atributos na API
 * 
 *************************************************************/

// Import do arquivo autoload, que fará as instancias do slim
require_once('vendor/autoload.php');


require_once('app.php');

// EndPoint: requisição para listar todos os clientes
$app->get('/cor', function ($request, $response, $args) {

    require_once('../modulo/config.php');
    require_once('../controller/controllerCor.php');

    if ($dados = listarCor()) {

        // Realizar a conversão do array de dados em formato JSON
        if ($dadosJSON = createJSON($dados)) {

            // Caso exista dados a serem retornados, informamos o statusCOde 200 e enviamos
            // um JSON com o todos os dados encontrados
            return $response->withStatus(200)
                            ->withHeader('Content-Type', 'application/json')
                            ->write($dadosJSON);
        }
    } else {

        // Retorna um statusCode de que significa que a requisição foi aceita, com o
        // conteúdo de retorno
        return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Item não encontrado"}');
    }

});

// Executa todos os EndPoints
$app->run();