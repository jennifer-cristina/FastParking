<?php

/*******************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados vagas dentro do BD
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 *********************************************************************************/

require_once('conexaoMysql.php');

//Funçao para inserir uma nova vaga
function insertVaga($dadosVagas)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $script = "insert into tblVaga
                        (statusVaga,
                           preferencial,
                           idTipoVaga,
                           idBloco)
                        values(
                            " . $dadosVagas['statusVaga'] . ",
                            " . $dadosVagas['preferencial'] . ",
                            " . $dadosVagas['idTipoVaga'] . ",
                            " . $dadosVagas['idBloco'] . ");";

    if (mysqli_query($conexao, $script)) {
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMysql($conexao);

    return $statusResposta;
}


//Função para atualizar no bano
function uptadeVaga($dadosVagas)
{
    $statusResposta = (bool) false;

    $conexao = conectarMysql();

    $script = "update tblVaga set
                    statusVaga   = " . $dadosVagas['statusVaga'] . ",
                    preferencial = " . $dadosVagas['preferencial'] . ",
                    idTipoVaga   = " . $dadosVagas['idTipoVaga'] . ",
                    idBloco      = " . $dadosVagas['idBloco'] . "
                where id=" . $dadosVagas['id'];

    // var_dump($script);
    // die;

    if (mysqli_query($conexao, $script)) {
        if (mysqli_affected_rows($conexao))
            $statusResposta = true;
    }

    fecharConexaoMysql($conexao);

    return $statusResposta;
}

function deleteVaga($id)
{
    $statusResposta = (bool) false;
    $conexao = conectarMysql();

        //script para deletar um resgistro do BD
        $script = "delete from tblVaga where id=".$id;

        //Valida se o script está correto, sem erro de sintaxe e executa no BD
        if(mysqli_query($conexao, $script))
        {
            //Valida se o BD teve sucesso na execução do script
            if(mysqli_affected_rows($conexao))
                $statusResposta = true;
        }

        //Fecha a conexão com o BD mysql
        fecharConexaoMysql($conexao);
        return $statusResposta;
}

function selectAllVaga()
{
    //Abre a conexão com o BD
    $conexao = conectarMysql();

    //script para listar todos os dados do BD
    $script = "select * from tblVaga";

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $script);

    //Valida se o BD retornou registros
    if ($result) {
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {
            //Cria um array com os dados do BD
            $arrayDados[$cont] = array(
                "id"           => $rsDados['id'],
                "statusVaga"   => $rsDados['statusVaga'],
                "preferencial" => $rsDados['preferencial'],
                "idTipoVaga"   => $rsDados['idTipoVaga'],
                "idBloco"      => $rsDados['idBloco']
            );

            $cont++;
        }

        fecharConexaoMysql($conexao);
        if (isset($arrayDados))
            return $arrayDados;
        else
            return false;
    }
}

function selectByIdVaga($id)
{
    //Abre a conexão com o BD
    $conexao = conectarMysql();

    //script para listar o dado do BD
    $script = "select * from tblVaga where id =" . $id;

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $script);

    //Valida se o BD retornou registro
    if ($result) {
        if ($rsDados = mysqli_fetch_assoc($result)) {
            $arrayDados = array(
                "id"           => $rsDados['id'],
                "statusVaga"   => $rsDados['statusVaga'],
                "preferencial" => $rsDados['preferencial'],
                "idTipoVaga"   => $rsDados['idTipoVaga'],
                "idBloco"      => $rsDados['idBloco']
            );
        }
        fecharConexaoMysql($conexao);

        if (isset($arrayDados))
            return $arrayDados;
        else
            return false;
    }
}
