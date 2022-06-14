<?php

/*******************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados blocos dentro do BD
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 *********************************************************************************/

require_once('conexaoMysql.php');

function selectAllSexo()
{
    //Abre a conexão com o BD
    $conexao = conectarMysql();

    //script para listar todos os dados do BD
    $script = "select * from tblSexo"; /*asc = crescente */

    //Executa o script sql no BD e guarda o retorno dos dados, se houver
    $result = mysqli_query($conexao, $script);

    //Valida se o BD retornou registros
    if ($result) {
        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {
            //Cria um array com os dados do BD
            $arrayDados[$cont] = array(
                "id"     => $rsDados['id'],
                "nome"   => $rsDados['nome'],
                "sigla"  => $rsDados['sigla']
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
