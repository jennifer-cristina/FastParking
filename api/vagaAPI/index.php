<?php

/**
 * DATA: 02/06/2022
 * 
 */



require_once('vendor/autoload.php');



//Criando um objeto do slim chamado app, para configurar os EndPoint
$app = new \Slim\App();



$app->post('/vaga', function ($request, $response, $args) {

    //importa do arquivo de configuração
    require_once('../modulo/config.php');
    //importe da controller 
    require_once('../controller/controllerVaga.php');


    $contentTypeHeader = $request->getHeaderLine('Content-Type');
    $contentType = explode(";", $contentTypeHeader);

    switch ($contentType[0]) {
        case 'multipart/form-data':

            $arrayDados = $request->getParsedBody();

            //Chama a função da controller para inserir os dados
            $resposta = inserirVaga($arrayDados);

            if (is_bool($resposta) && $resposta == true) {
                return $response->withStatus(201)
                    ->withHeader('Content-Type', 'application/json')
                    ->write('{"message":"Registro inserido com sucesso" }');
            } elseif (is_array($resposta) && $resposta['idErro']) {
                //Converte para JSON o erro, pois a controller retorna um array
                $dadosJSON = createJSON($resposta);

                return $response->withStatus(400)
                    ->withHeader('Content-Type', 'application/json')
                    ->write('{"message": "Houve um problema no processo de inserir",
                                                                    "Erro": ' . $dadosJSON . '}');
            }
            break;
    }
});

$app->post('/vaga/{id}', function ($request, $response, $args) {

    //importa do arquivo de configuração
    require_once('../modulo/config.php');
    //importe da controller 
    require_once('../controller/controllerVaga.php');

    if (is_numeric($args['id'])) {

        $id = $args['id'];
        $contentTypeHeader = $request->getHeaderLine('Content-Type');
        $contentType = explode(";", $contentTypeHeader);

        switch ($contentType[0]) {
            case 'multipart/form-data':
                $dadosBody = $request->getParsedBody();

                $arrayDados = array(
                    $dadosBody,
                    "id" => $id
                );

                //Chama a função da controller para inserir os dados
                $resposta = atualizarVaga($arrayDados);

                if (is_bool($resposta) && $resposta == true) {
                    return $response->withStatus(201)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message":"Registro atualizado com sucesso" }');
                } elseif (is_array($resposta) && $resposta['idErro']) {
                    //Converte para JSON o erro, pois a controller retorna um array
                    $dadosJSON = createJSON($resposta);

                    return $response->withStatus(400)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Houve um problema no processo de inserir",
                                                                    "Erro": ' . $dadosJSON . '}');
                }
                break;
        }
    }
});

$app->get('/vaga', function ($request, $response, $args) {

    //importa do arquivo de configuração
    require_once('../modulo/config.php');
    //importe da controller 
    require_once('../controller/controllerVaga.php');

    //Solicita os dados para a controller
    if ($dados = listarVaga()) {
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

$app->get('/vaga/{id}', function ($request, $response, $args) {

    //importa do arquivo de configuração
    require_once('../modulo/config.php');
    //importe da controller 
    require_once('../controller/controllerVaga.php');

    //recebe o id do registro que deverá ser retornado pela api, ele está chegando pela váriavel criada no endpoint
    $id = $args['id'];

    //Solicita os dados para a controller
    if ($dados = buscarVaga($id)) {

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

$app->delete('/vaga/{id}', function ($request, $response, $args) {

    //importa do arquivo de configuração
    require_once('../modulo/config.php');
    //importe da controller 
    require_once('../controller/controllerVaga.php');

    if (is_numeric($args['id'])) {
        //Recebe o id enviado no enpoint através da váriavel id 
        $id = $args['id'];
        $resposta = excluirVaga($id);

        //chama a função de excluir contato, encaminhando o id e a foto
        if (is_bool($resposta) && $resposta == true) {
            return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write('{"message": "Registro excluído com sucesso!"}');
        }
    }
});

$app->run();
