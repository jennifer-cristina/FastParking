<?php

/*******************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados blocos dentro do BD
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 *********************************************************************************/

require_once('conexaoMysql.php');

function selectAllBlocos()
{

   //Abre a conexão com o BD
   $conexao = conexaoMysql();

   //script para listar todos os dados do BD
   $script = "select * from tblbloco order by id desc"; /*asc = crescente */

   //Executa o script sql no BD e guarda o retorno dos dados, se houver
   $result = mysqli_query($conexao, $script);

   //Valida se o BD retornou registros
   if ($result) {
      $cont = 0;
      while ($rsDados = mysqli_fetch_assoc($result)) {
         //Cria um array com os dados do BD
         $arrayDados[$cont] = array(
            "id"               => $rsDados['id'],
            "nome"             => $rsDados['nome'],
            "capacidadeMaxima" => $rsDados['capacidadeMaxima']
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

//Função para buscar um contato no BD através do id do registro
function selectByIdBloco($id)
{
   //Abre a conexão com o BD
   $conexao = conexaoMysql();

   //script para listar o dado do BD
   $script = "select * from tblbloco where id =" . $id;

   //Executa o script sql no BD e guarda o retorno dos dados, se houver
   $result = mysqli_query($conexao, $script);

   //Valida se o BD retornou registro
   if ($result) {
      if ($rsDados = mysqli_fetch_assoc($result)) {
         $arrayDados = array(
            "id"               => $rsDados['id'],
            "nome"             => $rsDados['nome'],
            "capacidadeMaxima" => $rsDados['capacidadeMaxima']
         );
      }
      fecharConexaoMysql($conexao);

      if (isset($arrayDados))
         return $arrayDados;
      else
         return false;
   }
}
