<?php

/*******************************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados tipoVaga dentro do BD
 * Autor: Laise 
 * Data:03/06/2022 
 * Versão: 1.0          
 *********************************************************************************/

require_once('conexaoMysql.php');

function selectAllTipoVaga()
{
   //Abre a conexão com o BD
   $conexao = conectarMysql();

   //script para listar todos os dados do BD
   $script = "select * from tblTipoVaga";

   //Executa o script sql no BD e guarda o retorno dos dados, se houver
   $result = mysqli_query($conexao, $script);

   //Valida se o BD retornou registros
   if ($result) {
      $cont = 0;
      while ($rsDados = mysqli_fetch_assoc($result)) {
         //Cria um array com os dados do BD
         $arrayDados[$cont] = array(
            "id"             => $rsDados['id'],
            "nome"           => $rsDados['nome'],
            "precoHora"      => $rsDados['precoHora'],
            "precoAdicional" => $rsDados['precoAdicional'],
            "precoDiaria"    => $rsDados['precoDiaria']
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

//Função para buscar um tipo vaga no BD através do id do registro
function selectByIdTipoVaga($id)
{
   //Abre a conexão com o BD
   $conexao = conectarMysql();

   //script para listar o dado do BD
   $script = "select * from tblTipoVaga where id =" . $id;

   //Executa o script sql no BD e guarda o retorno dos dados, se houver
   $result = mysqli_query($conexao, $script);

   //Valida se o BD retornou registro
   if ($result) {
      if ($rsDados = mysqli_fetch_assoc($result)) {
         $arrayDados = array(
            "id"             => $rsDados['id'],
            "nome"           => $rsDados['nome'],
            "precoHora"      => $rsDados['precoHora'],
            "precoAdicional" => $rsDados['precoAdicional'],
            "precoDiaria"    => $rsDados['precoDiaria']
         );
      }
      fecharConexaoMysql($conexao);

      if (isset($arrayDados))
         return $arrayDados;
      else
         return false;
   }
}

function selectCountVagaDisponiveis()
{
   //Abre a conexão com o BD
   $conexao = conectarMysql();

   //script para listar o dado do BD
   $script = "select 
            (select count(statusVaga) from tblVaga where statusVaga = false and idTipoVaga=1) as 'pequenoPorte',       
            (select count(statusVaga) from tblVaga where statusVaga = false and idTipoVaga=2) as 'medioPorte',
            (select count(statusVaga) from tblVaga where statusVaga = false and idTipoVaga=3) as 'grandePorte';";

   //Executa o script sql no BD e guarda o retorno dos dados, se houver
   $result = mysqli_query($conexao, $script);

   //Valida se o BD retornou registros
   if ($result) {
      $cont = 0;
      while ($rsDados = mysqli_fetch_assoc($result)) {
         //Cria um array com os dados do BD
         $arrayDados[$cont] = array(
            "pequenoPorte" => $rsDados['pequenoPorte'],
            "medioPorte"   => $rsDados['medioPorte'],
            "grandePorte"  => $rsDados['grandePorte'],
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
