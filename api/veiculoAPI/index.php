<?php

/*************************************************************
 *  $request: Recebe dados do corpo da requisição (JSON, XML, FORM/DATA)
 *  $response: Envia dados de retorno da API
 *  $args: Permite receber dadso de atributos na API
 * 
 *************************************************************/

// Import do arquivo autoload, que fará as instancias do slim
require_once('vendor/autoload.php');

$app = new \Slim\App();

// EndPoint: requisição para inserir um novo veiculo
$app->post('/veiculo', function ($request, $response, $args) {

    
    // Recebe do header da requisição qual será o content-type
    $contentTypeHeader = $request->getHeaderLine('Content-Type');

    // Cria um array, pois dependendo do content-type temos mais informações separadas pelo ;
    $contentType = explode(";", $contentTypeHeader);

    switch ($contentType[0]) {
        case 'multipart/form-data':

            // Recebe os dados comuns enviado pelo da requisição
            $dadosBody = $request->getParsedBody();

            // Import da controller de contatos, que fará a busca de dados
            require_once('../modulo/config.php');
            require_once('../controller/controllerVeiculo.php');

            // Cria um array com todos os dados comuns e do arquivo que será enviado para o servidor
            $arrayDados = array(
                $dadosBody
            );

            // Chama a função da controller para inserir os dados
            $resposta = inserirVeiculo($arrayDados);

            if (is_bool($resposta) && $resposta == true) {

                return $response->withStatus(201)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message": "Registro inserido com sucesso."}');
            } elseif (is_array($resposta) && $resposta['idErro']) {

                // Cria o JSON dos dados do erro
                $dadosJSON = createJSON($resposta);

                return $response->withStatus(400)
                                ->withHeader('Content-Type', 'application/json')
                                ->write('{"message": "Houve um problema no processo de inserir.",
                                          "Erro": ' . $dadosJSON . '
                                        }');
            }

            break;

        case 'application/json':

            return $response->withStatus(200)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Formato selecionado foi JSON."}');

            break;

        default:

            return $response->withStatus(400)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Formato do Content-Type não é válido para esta requisição."}');

            break;
    }

});

// EndPoint: requisição para listar todos os veiculos
$app->get('/veiculo', function ($request, $response, $args) {

    require_once('../modulo/config.php');
    require_once('../controller/controllerVeiculo.php');


    if ($dados = listarVeiculo()) {

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

// EndPoint: requisição para listar veiculo pelo id
$app->get('/veiculo/{id}', function ($request, $response, $args) {

    // Recebe o ID do registro que devrá ser retornado pela API, esse ID esta chegando pela variael criada no endpoint
    $id = $args['id'];

    require_once('../modulo/config.php');
    require_once('../controller/controllerVeiculo.php');

    // Solicita os dados para a controller
    if ($dados = buscarVeiculo($id)) {

        // valida se existe o id erro e verifica se houve algum tipo de erro no retorno dos dados da controller
        if (!isset($dados['idErro'])) {

            // Realizar a conversão do array de dados em formato JSON
            if ($dadosJSON = createJSON($dados)) {

                // Caso exista dados a serem retornados, informamos o statusCOde 200 e enviamos
                // um JSON com o todos os dados encontrados
                return $response->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJSON);
            }
        } else {

            // Converte para JSON o erro, pois a controller retorna em array
            $dadosJSON = createJSON($dados);

            // Retorna um erro que significa que o cliente passou dados errados
            return $response->withStatus(404)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Dados inválidos",
                                      "Erro": ' . $dadosJSON . '
                                     }');
        }
    } else {

        // Retorna um statusCode de que significa que a requisição foi aceita, com o
        // conteúdo de retorno
        return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Item não encontrado"}');
    }

});

// EndPoint: requisição para listar veiculo pelo placa
$app->get('/veiculo/placa/{placa}', function ($request, $response, $args) {

    // Recebe o numero da placa do registro que devrá ser retornado pela API, essa placa esta chegando pela variael criada no endpoint
    $placa = $args['placa'];

    require_once('../modulo/config.php');
    require_once('../controller/controllerVeiculo.php');

    // Solicita os dados para a controller
    if ($dados = buscarPlacaVeiculo($placa)) {

        // valida se existe o id erro e verifica se houve algum tipo de erro no retorno dos dados da controller
        if (!isset($dados['idErro'])) {

            // Realizar a conversão do array de dados em formato JSON
            if ($dadosJSON = createJSON($dados)) {

                // Caso exista dados a serem retornados, informamos o statusCOde 200 e enviamos
                // um JSON com o todos os dados encontrados
                return $response->withStatus(200)
                                ->withHeader('Content-Type', 'application/json')
                                ->write($dadosJSON);
            }
        } else {

            // Converte para JSON o erro, pois a controller retorna em array
            $dadosJSON = createJSON($dados);

            // Retorna um erro que significa que o cliente passou dados errados
            return $response->withStatus(404)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Dados inválidos",
                                      "Erro": ' . $dadosJSON . '
                                     }');
        }
    } else {

        // Retorna um statusCode de que significa que a requisição foi aceita, com o
        // conteúdo de retorno
        return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Item não encontrado"}');
    }

});

// EndPoint: requisição para deletar um veiculo
$app->delete('/veiculo/{id}', function ($request, $response, $args) {

    // Verifica se o id não esta vazio e se é um número
    if (is_numeric($args['id'])) {

        // Recebe o ID do registro que deverá ser retornado pela API, esse ID esta chegando pela variavel criada no endpoint
        $id = $args['id'];

        require_once('../modulo/config.php');
        require_once('../controller/controllerVeiculo.php');

        if (buscarVeiculo($id)) {

            $resposta = excluirVeiculo($id);

            if (is_bool($resposta) && $resposta ==  true) {

                // Retorna uma mensagem de sucesso
                return $response->withStatus(200)
                    ->withHeader('Content-Type', 'application/json')
                    ->write('{"message": "Registro excluído com sucesso!"}');
            } elseif (is_array($resposta) && isset($resposta['idErro'])) {

                    // Converte para JSON o erro, pois a controller retorna em array
                    $dadosJSON = createJSON($resposta);

                    // Retorna um erro que significa que o cliente passou dados errados
                    return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "Houve um problema no processo de excluir",
                                      "Erro": ' . $dadosJSON . '
                                     }');
            }
        } else {

            // Retorna um erro que significa que o cliente informou um id inválido
            return $response->withStatus(404)
                ->withHeader('Content-Type', 'application/json')
                ->write('{"message": "O ID informado não existe na base de dados."}');
        }
    } else {

        // Retorna um erro que significa que o cliente passou dados errados
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write('{"message": "É obrigatório um ID com formato válido (número)"}');
    }

});

// EndPoint: requisição para atualizar um veiculo
$app->post('/veiculo/{id}', function ($request, $response, $args) {

    // Verifica se o id não esta vazio e se é um número
    if (is_numeric($args['id'])) {

        // Recebe o ID do registro que deverá ser retornado pela API, esse ID esta chegando pela variavel criada no endpoint
        $id = $args['id'];

        require_once('../modulo/config.php');
        require_once('../controller/controllerVeiculo.php');

        $contentTypeHeader = $request->getHeaderLine('Content-Type');

        $contentType = explode(";", $contentTypeHeader);

        switch ($contentType[0]) {

            case 'multipart/form-data':

                if (buscarVeiculo($id)) {

                    // Recebe os dados comuns enviado pelo da requisição
                    $dadosBody = $request->getParsedBody();

                    // Cria um array com todos os dados comuns e do arquivo que será enviado para o servidor
                    $arrayDados = array(
                        $dadosBody,
                        "id"    => $id
                    );

                    // Chama a função da controller para inserir os dados
                    $resposta = atualizarVeiculo($arrayDados);

                    if (is_bool($resposta) && $resposta == true) {

                        return $response->withStatus(201)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Registro atualizado com sucesso."}');
                    } elseif (is_array($resposta) && $resposta['idErro']) {

                        // Cria o JSON dos dados do erro
                        $dadosJSON = createJSON($resposta);

                        return $response->withStatus(400)
                            ->withHeader('Content-Type', 'application/json')
                            ->write('{"message": "Houve um problema no processo de atualizar.",
                                            "Erro": ' . $dadosJSON . '
                                            }');
                    }
                } else {
                    // Retorna um erro que significa que o cliente informou um id inválido
                    return $response->withStatus(404)
                        ->withHeader('Content-Type', 'application/json')
                        ->write('{"message": "O ID informado não existe na base de dados."}');
                }

                break;
        }
    } else {

        // Retorna um erro que significa que o cliente passou dados errados
        return $response->withStatus(404)
            ->withHeader('Content-Type', 'application/json')
            ->write('{"message": "É obrigatório um ID com formato válido (número)"}');
    }
    
});


// Executa todos os EndPoints
$app->run();
