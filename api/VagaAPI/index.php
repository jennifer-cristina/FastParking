<?php
/**
 * DATA: 02/06/2022
 * 
 */

    require_once('vendor/autoload.php');

    //Criando um objeto do slim chamado app, para configurar os EndPoint
    $app = new \Slim\App();

    $app->post('/vaga', function ($request, $response, $args) {
        $contentTypeHeader = $request->getHeaderLine('Content-Type');
        $contentType = explode(";", $contentTypeHeader);

        switch($contentType[0]){
            case 'multipart/form-data':
                //importa do arquivo de configuração
                require_once('../modulo/config.php');
                //importe da controller de contatos, que fará a busca de dados
                require_once('../controller/controllerVaga.php');

                //Chama a função da controller para inserir os dados
                $resposta = inserirVagas($arrayDados);

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

    $app->run();

?>