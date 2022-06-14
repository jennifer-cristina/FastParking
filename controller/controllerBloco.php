<?php

/*****************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados blocos
 * Autor: Laise 
 * Data:02/06/2022 
 * Versão: 1.0          
 ****************************************************************/


//Importe do arquivo que vai buscar os dados no BD
require_once(SRC . '/model/bloco.php');

function listarBloco()
{
   //Chama a função que vai buscar os dados no BD
   $dados = selectAllBlocos();

   if (!empty($dados))
      return $dados;
   else
      return false;
}

function buscarBloco($id)
{
   if ($id != 0 && !empty($id) && is_numeric($id)) {
      //Chama a função na model que vai buscar no BD
      $dados = selectByIdBloco($id);

      //Valida se existem dados para serem devolvidos
      if (!empty($dados))
         return $dados;
      else
         return false;
   } else
      return array(
         'idErro'     => 4,
         'message'    => 'Não é possível buscar um registro sem informar um id válido'
      );
}
