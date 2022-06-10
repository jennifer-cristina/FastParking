<?php

/**
 * DATA: 02/06/2022
 * Autor:Laise
 */

require_once('vendor/autoload.php');

//Criando um objeto do slim chamado app, para configurar os EndPoint
require_once('../app.php');

//endpoit para pegar todos blocos
$app->get('/bloco', function ($request, $response, $args) {

   //importa do arquivo de configuração
   require_once('../modulo/config.php');
   //importe da controller 
   require_once('../controller/controllerBloco.php');

   //Solicita os dados para a controller
   if ($dados = listarBloco()) {
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

//endpoit para pegar o bloco por id
$app->get('/bloco/{id}', function ($request, $response, $args) {

   //importa do arquivo de configuração
   require_once('../modulo/config.php');
   //importe da controller 
   require_once('../controller/controllerBloco.php');

   //recebe o id do registro que deverá ser retornado pela api, ele está chegando pela váriavel criada no endpoint
   $id = $args['id'];

   //Solicita os dados para a controller
   if ($dados = buscarBloco($id)) {

      //Verifica se houve algum tipo de erro dos dados da controller
      if (!isset($dados['idErro'])) {
         //realiza a conversão do array de dados em formato json
         if ($dadosJSON = createJSON($dados)) {
            //caso exista dados, retornamos o status code e enviamos os dados em json
            return $response->withStatus(200)
               ->withHeader('Content-Type', 'application/json')
               ->write($dadosJSON);
         }
      } else {

         //Converte para JSON o erro, pois a controller retorna um array
         $dadosJSON = createJSON($dados);

         //Retorna um erro que significa que o cliente passo dados errados
         return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write('{"message": "Dados inválidos",
                                      "Erro": ' . $dadosJSON . '}');
      }
   } else {
      //retorna um status code caso a solicitação dê errado
      return $response->withStatus(204);
   }
});

$app->run();
