<?php

     class CategoriasModel
     {

          public static function MdlGetCategoria($Param, $Value)
          {
               
               $SqlStr = "Select * From Categorias Where Ruta=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO::PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetch();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetIdSubCat($Tabla, $Param, $Value)
          {
               
               $SqlStr = "Select * From $Tabla Where $Param=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO::PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetch();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetSubCats($Tabla, $Param, $Value)
          {

               $SqlStr = "Select * From $Tabla Where $Param=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO::PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetPrdIdSC3($Value)
          {
               
               $SqlStr = "Select Categorias.IdCat, SubCat1.IdSubCat1, SubCat2.IdSubCat2, SubCat3.IdSubCat3 From Categorias, Subcat1, SubCat2, SubCat3 Where Categorias.IdCat=SubCat1.IdCat And SubCat1.IdSubCat1=SubCat2.IdSubCat1 And SubCat2.IdSubCat2=SubCat3.IdSubCat2 And SubCat3.Ruta=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO::PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetch();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetPrdIdSC2($Value)
          {
               
               $SqlStr   = "Select Categorias.IdCat, SubCat1.IdSubCat1, SubCat2.IdSubCat2 From Categorias, SubCat1, SubCat2 Where Categorias.IdCat=SubCat1.IdCat And SubCat1.IdSubCat1=SubCat2.IdSubCat1 And SubCat2.Ruta=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO::PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetch();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetPrdIdSC1($Value)
          {
               
               $SqlStr   = "Select Categorias.IdCat, SubCat1.IdSubCat1 From Categorias, SubCat1 Where Categorias.IdCat=SubCat1.IdCat And SubCat1.Ruta=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO::PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetch();

               $Conx -> close();
               $Conx  = null;

          }

     }