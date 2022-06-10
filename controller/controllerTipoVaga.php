<?php

/*****************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados tipoVaga
 * Autor: Laise 
 * Data:03/06/2022 
 * Versão: 1.0          
 ****************************************************************/


//Importe do arquivo que vai buscar os dados no BD
require_once(SRC . './model/tipoVaga.php');

function listarTipoVaga()
{
   $dados = selectAllTipoVaga();
   if (!empty($dados))
      return $dados;
   else
      return false;
}

function buscarTipoVaga($id)
{
   if ($id != 0 && !empty($id) && is_numeric($id)) {
      //Chama a função na model que vai buscar no BD
      $dados = selectByIdTipoVaga($id);

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