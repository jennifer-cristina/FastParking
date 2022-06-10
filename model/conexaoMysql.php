<?php
/*******************************************************
 *  Arquivo para criar a conexão com o banco de dados.
 * 
 *  Jennifer e Laise
 *  02/06/2022
 *  Versão 1.0
 *****************************************************/


const SERVER = 'localhost';
const USER = 'root';
const PASSWORD = 'bcd127';
const DATABASE = 'dbFastParking';

 function conectarMysql(){
    $conexao = array();

    $conexao = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if($conexao){
        return $conexao;
   
    }else{
        return false;
    }
 }

 function fecharConexaoMysql($conexao){

    mysqli_close($conexao);
 }

?>

