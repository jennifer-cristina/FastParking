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

// EndPoint: requisição para inserir um novo controle
$app->post('/controle', function ($request, $response, $args) {

    
    // Recebe do header da requisição qual será o content-type
    $contentTypeHeader = $request->getHeaderLine('Content-Type');

    // Cria um array, pois dependendo do content-type temos mais informações separadas pelo ;
    $contentType = explode(";", $contentTypeHeader);

    switch ($contentType[0]) {
        case 'multipart/form-data':

            // Recebe os dados comuns enviado pelo da requisição
            $dadosBody = $request->getParsedBody();

            // Import da controller de controle, que fará a busca de dados
            require_once('../modulo/config.php');
            require_once('../controller/controllerControle.php');

            
            // Cria um array com todos os dados comuns e do arquivo que será enviado para o servidor
            $arrayDados = array(
                $dadosBody
            );

            // Chama a função da controller para inserir os dados
            $resposta = inserirControle($arrayDados);

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


// Executa todos os EndPoints
$app->run();
