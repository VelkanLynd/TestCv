<?php
     
     class Conexion
     {
          
          public function Conectar()
          {
               $ConnStr = "mysql:host=". SrvHost ."; dbname=". SrvDb ."; ". SrvChrS;

               try
               {
                    $Conn = new PDO($ConnStr, SrvUser, SrvPass);
                    $Conn -> setAttribute(PDO :: ATTR_ERRMODE, PDO :: ERRMODE_EXCEPTION);
               }
               catch (PDOException $Ex)
               {
                    $Conn = "Error en la conexión";
                    echo("Error: {$Ex -> getMessage()}");
               }

               return $Conn;
          }

     }