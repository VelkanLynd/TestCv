<?php

     class CategoriasController
     {

          public static function CtrGetCategoria($Param, $Value)
          {
               
               $Cat = CategoriasModel :: MdlGetCategoria($Param, $Value);

               return $Cat;

          }

          public static function CtrGetIdSubCat($Tabla, $Param, $Value)
          {
               
               $Cat = CategoriasModel :: MdlGetIdSubCat($Tabla, $Param, $Value);

               return $Cat;

          }

          public static function CtrGetSubCats($Tabla, $Param, $Value)
          {

               $Cat = CategoriasModel :: MdlGetSubCats($Tabla, $Param, $Value);

               return $Cat;

          }

          public static function CtrGetPrdIdSC3($Value)
          {
               
               $Cat = CategoriasModel :: MdlGetPrdIdSC3($Value);

               return $Cat;

          }

          public static function CtrGetPrdIdSC2($Value)
          {
               
               $Cat = CategoriasModel :: MdlGetPrdIdSC2($Value);

               return $Cat;

          }

          public static function CtrGetPrdIdSC1($Value)
          {
               
               $Cat = CategoriasModel :: MdlGetPrdIdSC1($Value);

               return $Cat;

          }

     }