<?php

require_once("Conexion.php");

     class MenuModel
     {
           
          public function MdlGetCategorias()
          {

               $SqlStr = "Select * From Categorias";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          static public function MdlGetSubCats1($IdCat)
          {

               $SqlStr = "Select * From Categorias,SubCat1 Where Categorias.IdCat=SubCat1.IdCat And Categorias.IdCat=:IdCat";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":IdCat", $IdCat, PDO::PARAM_INT);               
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          static public function MdlGetSubCats2($IdSubCat1)
          {

               $SqlStr = "Select * From SubCat1,SubCat2 Where SubCat1.IdSubCat1=SubCat2.IdSubCat1 And SubCat1.IdSubCat1=:IdCat";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":IdCat", $IdSubCat1, PDO::PARAM_INT);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          static public function MdlGetSubCats3($IdSubCat2)
          {

               $SqlStr = "Select * From SubCat2,SubCat3 Where SubCat2.IdSubCat2=SubCat3.IdSubCat2 And SubCat2.IdSubCat2=:IdCat";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":IdCat", $IdSubCat2, PDO::PARAM_INT);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

     }