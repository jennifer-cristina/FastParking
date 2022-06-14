<?php

/********************************************************************************************
 * Objetivo: Arquivo responsavel por manipular os dados dentro do banco de dados (insert, update, select e delete)
 * Autor: Jennifer
 * Data: 08/06/2022
 * Versão: 1.0
 *************************************************************************************/

require_once('conexaoMysql.php');

function selectAllCor()
{

    $conexao = conectarMysql();

    $sql = "select * from tblCor order by id asc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;
        while ($rsDados = mysqli_fetch_assoc($result)) {

            $arrayDados[$cont] = array(
                "id"        =>  $rsDados['id'],
                "nome"      =>  $rsDados['nome']
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