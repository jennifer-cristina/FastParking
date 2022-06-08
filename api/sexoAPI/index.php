<?php

/**
 * DATA: 02/06/2022
 * Autor:Laise
 */

require_once('vendor/autoload.php');

//Criando um objeto do slim chamado app, para configurar os EndPoint
$app = new \Slim\App();

//endpoit para pegar todos blocos
$app->get('/sexo', function ($request, $response, $args) {

   //importa do arquivo de configuração
   require_once('../modulo/config.php');
   //importe da controller 
   require_once('../controller/controllerSexo.php');

   //Solicita os dados para a controller
   if ($dados = listarSexo()) {
   
      //realiza a conversão do array de dados em formato json
      if ($dadosJSON = createJSON($dados)) {
         //caso exista dados, retornamos o status code e enviamos os dados em json
         return $response->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->write($dadosJSON);
      }
   } else {
      //retorna um status code caso a solicitação dê errado
      return $response->withStatus(404)
         ->withHeader('Content-Type', 'application/json')
         ->write('{"id-erro": "404", "message": "Não foi possivel encontrar registros."}');
   }
});

$app->run();