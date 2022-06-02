<?php

/**********************************************************
 * Objetivo: Arquivo para criar a conexão BD Mysql
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 ************************************************************/

//constante para estabelecer a conexão com o BD (local do BD, usuário, senha e database)
const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbFastParking';

//Abre a conexão com o BD Mysql
function conexaoMysql()
{
    $conexao = array();

    //Se a conexão for estabelecida com o BD, iremos ter um array de dados sobre a conexão
    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    //Validação para verificar se a conexão foi realizada com sucesso
    if($conexao)
        return $conexao;
    else
        return false;
}

//Fecha conexão com o BD Mysql
function fecharConexaoMysql($conexao)
{
    mysqli_close($conexao);
}

