<?php
/*******************************************************
 *  Arquivo para criar a conexão com o banco de dados.
 * 
 *  Jennifer e Laise
 *  02/06/2022
 *  Versão 2.0
 *****************************************************/


const SERVER = '34.95.198.220';
const USER = 'root';
const PASSWORD = 'N01d25y15b04';
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

