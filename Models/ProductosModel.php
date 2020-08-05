<?php

     require_once("Conexion.php");


     class ProductosModel
     {

          public static function MdlInfoProducto($Param, $Value)
          {

               $SqlStr = "Select * From Productos Where $Param=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetch();

               $Conx -> close();
               $Conx  = null;
               
          }

          public static function MdlProdsNov()
          {

               $SqlStr = "Select * From Productos Order By IdProd Desc Limit 4";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);               
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;               

          }

          public static function MdlProdsRec()
          {

               $SqlStr = "Select * From Productos Order By Rand() Limit 4";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;
                              
          }

          public static function MdlTotSearch($Param)
          {

               $SqlStr = "Select * From Productos Where (Ruta Like '%$Param%') Or (Nombre Like '%$Param%') Or (Descripcion Like '%$Param%') Order By IdProd";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          public static function CtrProdSearch($Param, $StartFrom, $Limit)
          {

               $SqlStr = "Select * From Productos Where (Ruta Like '%$Param%') Or (Nombre Like '%$Param%') Or (Descripcion Like '%$Param%') Order By IdProd Limit $StartFrom, $Limit";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_STR);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlTotProds($IdCat, $IdSubCat1, $IdSubCat2, $IdSubCat3)
          {

               $SqlStr = "Select * From Productos Where IdCat=:Cat And IdSubCat1=:SC1 And IdSubCat2=:SC2 And IdSubCat3=:SC3 Order By IdProd Desc";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Cat", $IdCat, PDO :: PARAM_INT);
               $Conx -> bindParam(":SC1", $IdSubCat1, PDO :: PARAM_INT);
               $Conx -> bindParam(":SC2", $IdSubCat2, PDO :: PARAM_INT);
               $Conx -> bindParam(":SC3", $IdSubCat3, PDO :: PARAM_INT);               
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          public static function CtrProductos($IdCat, $IdSubCat1, $IdSubCat2, $IdSubCat3, $StartFrom, $Limit)
          {

               $SqlStr = "Select * From Productos Where IdCat=:Cat And IdSubCat1=:SC1 And IdSubCat2=:SC2 And IdSubCat3=:SC3 Order By IdProd Desc Limit $StartFrom, $Limit";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Cat", $IdCat, PDO :: PARAM_INT);
               $Conx -> bindParam(":SC1", $IdSubCat1, PDO :: PARAM_INT);
               $Conx -> bindParam(":SC2", $IdSubCat2, PDO :: PARAM_INT);
               $Conx -> bindParam(":SC3", $IdSubCat3, PDO :: PARAM_INT);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetProdCompras($Param, $Value, $Sort)
          {

               $SqlStr = "Select * From Productos Where $Param=:Param Order By $Sort Desc";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_INT);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetComents($Param, $Value)
          {

               $SqlStr = "Select Usuarios.Nombre, Usuarios.Foto, Comentarios.Calificacion, Comentarios.Comentario From Usuarios, Comentarios Where Usuarios.IdUsr=Comentarios.IdUsr And $Param=:Param Order By Rand()";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_INT);
               $Conx -> execute();

               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }

     }