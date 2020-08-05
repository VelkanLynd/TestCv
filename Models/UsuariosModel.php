<?php

     require_once("Conexion.php");

     class UsuariosModel
     {

          public static function MdlRegUser($Datos)
          {

               $SqlStr = "Insert Into usuarios (Modo, Nombre, Password, Mail, Foto, Direccion, Verificacion, MailCrypt) Values (:Modo, :Nombre, :Password, :Mail, :Foto, :Direccion, :Verificacion, :MailCrypt)";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Modo", $Datos["Modo"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Nombre", $Datos["Name"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Password", $Datos["Pass"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Mail", $Datos["Mail"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Foto", $Datos["Foto"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Direccion", $Datos["Dir"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Verificacion", $Datos["Vrfy"], PDO :: PARAM_INT);
               $Conx -> bindParam(":MailCrypt", $Datos["MlCr"], PDO :: PARAM_STR);               

               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
               
          }

          public static function MdlGetUser($Param, $Value)
          {

               $SqlStr = "Select * From Usuarios Where $Param=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_STR);
               $Conx -> execute();
               
               return $Conx -> fetch();
               
               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlUpdUser($Id, $Item, $Valor)
          {

               $SqlStr = "Update Usuarios Set $Item=:$Item Where IdUsr=:Id";
               
               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":$Item", $Valor, PDO :: PARAM_STR);
               $Conx -> bindParam(":Id", $Id, PDO :: PARAM_INT);
               $Conx -> execute();

               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlUpdPerfil($Datos)
          {
               
               $SqlStr = "Update Usuarios Set Nombre=:Name, Mail=:Mail, Password=:Pass, Foto=:Foto Where IdUsr=:Id";
               
               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Name", $Datos["Name"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Mail", $Datos["Mail"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Pass", $Datos["Pass"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Foto", $Datos["Foto"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Id",   $Datos["Id"], PDO :: PARAM_INT);

               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlGetCompras($Param, $Value)
          {

               $SqlStr = "Select * From Ventas Where $Param=:Param";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Param", $Value, PDO :: PARAM_INT);
               $Conx -> execute();
               
               return $Conx -> fetchAll();
               
               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlComentariosPerfil($Datos)
          {
               
               if( $Datos["IdUsr"] != "" )
               {
                    
                    $SqlStr = "Select * From Comentarios Where IdUsr=:Usuario And IdProd=:Producto";

                    $Conx  = Conexion :: Conectar() -> prepare($SqlStr);     
                    $Conx -> bindParam(":Usuario", $Datos["IdUsr"], PDO :: PARAM_INT);
                    $Conx -> bindParam(":Producto", $Datos["IdPrd"], PDO :: PARAM_INT);
     
                    $Conx -> execute();
     
                    return $Conx -> fetch();
     
               }
               else
               {
                    
                    $SqlStr = "Select * From Comentarios Where IdProd=:Producto Order By Rand()";
     
                    $Conx  = Conexion :: Conectar() -> prepare($SqlStr);                         
                    $Conx -> bindParam(":Producto", $Datos["IdPrd"], PDO :: PARAM_INT);                    
     
                    $Conx -> execute();
     
                    return $Conx -> fetchAll();
     
               }
     
               $Conx -> close();
               $Conx  = null;

          }


          public static function MdlActualizarComentario($Datos)
          {

               $SqlStr = "Update Comentarios Set Calificacion=:Calificacion, Comentario=:Comentario Where IdCmt=:Id";
               
               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Calificacion", $Datos["calificacion"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Comentario", $Datos["comentario"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Id", $Datos["id"], PDO :: PARAM_INT);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
          }

          public static function MdlAgregarDeseo($Datos)
          {

               $SqlStr = "Insert Into WishList (IdUsr, IdProd) Values (:Usuario, :Producto)";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Usuario", $Datos["idUsuario"], PDO :: PARAM_STR);
               $Conx -> bindParam(":Producto", $Datos["idProducto"], PDO :: PARAM_STR);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;

          }

          public static function MdlMostrarDeseos($Item)
          {
               
               $SqlStr = "Select * From Productos,WishList Where Productos.IdProd=WishList.IdProd And IdUsr=:Usuario Order By IdWsh Desc";
               
               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Usuario", $Item, PDO :: PARAM_INT);
               $Conx -> execute();
               
               return $Conx -> fetchAll();

               $Conx -> close();
               $Conx  = null;

          }
          
          public static function MdlQuitarDeseo($Datos)
          {
               
               $SqlStr = "Delete From WishList Where IdWsh=:Id";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Id", $Datos, PDO :: PARAM_INT);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
               
          }
          
          public static function MdlEliminarUsuario($Id)
          {

               $SqlStr = "Delete From Usuarios Where IdUsr=:Id";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Id", $Id, PDO :: PARAM_INT);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
               
          }
               
          public static function MdlEliminarComentarios($Id)
          {

               $SqlStr = "Delete From Comentarios Where IdUsr=:Id";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Id", $Id, PDO :: PARAM_INT);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
     
          }
     
          public static function MdlEliminarCompras($Id)
          {

               $SqlStr = "Delete From Ventas Where IdUsr=:Id";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Id", $Id, PDO :: PARAM_INT);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
     
          }
     
          public static function MdlEliminarListaDeseos($Id)
          {

               $SqlStr = "Delete From WishList Where IdUsr=:Id";

               $Conx  = Conexion :: Conectar() -> prepare($SqlStr);
               $Conx -> bindParam(":Id", $Id, PDO :: PARAM_INT);
               
               if( $Conx -> execute() )
               {
                    return "Ok";
               }
               else
               {
                    return "Error";
               }

               $Conx -> close();
               $Conx  = null;
     
          }

     }