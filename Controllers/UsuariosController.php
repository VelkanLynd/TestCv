<?php

     class UsuariosController
     {

     	public function CtrRegisterUser()
          {

               if( isset($_POST["RegName"] ))
               {

                    if( preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["RegName"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', strtolower($_POST["RegMail"])) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["RegPass"]) )
                    {

                         $Opc     = [ 'cost' => 11 ];
                         $CryPass = password_hash(($_POST["RegPass"]), PASSWORD_BCRYPT, $Opc);
                         $Crymail = md5(strtolower($_POST["RegMail"]));
                         
                         $Datos = array("Modo" => "Directo", "Name" => $_POST["RegName"], "Pass" => $CryPass, "Mail" => strtolower($_POST["RegMail"]), "Foto" => "Public/Img/Users/Avatar.jpg", "Dir" => "", "Vrfy" => 1, "MlCr" => $Crymail);
                         $Resp  = UsuariosModel :: MdlRegUser($Datos);

                         if($Resp == "Ok")
                         {

                              $Mail  = new PHPMailer(true);
                              $Mail -> CharSet = 'UTF-8';
                              $Mail -> isMail();
                              $Mail -> setFrom('clave@musica.com', 'Clave - El expero en alientos');
                              $Mail -> addReplyTo('clave@musica.com', 'Clave - El expero en alientos');
                              $Mail -> Subject = "Por favor verifique su dirección de correo electrónico";
                              $Mail -> addAddress(strtolower($_POST["RegMail"]));
                              $Mail -> msgHTML('
                                        <div style="width: 100%; background: #EEE; position: relative; font-family: sans-serif; padding-bottom: 40px">

                                             <center> <img style="padding: 20px; width: 10%" src="'. PathSystem .'Public/Img/LogoClave.png"> </center>
                                   
                                             <div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px">
                                                  <center>
                                                       <img style="padding: 20px; width:15%" src="'. PathSystem .'Public/Img/MailIcon.png">
                                                       <h3 style="font-weight: 100; color: #999"> Hola '. $_POST["RegName"] .' por favor verifica tu dirección de correo electrónico </h3>
                                                       <hr style="border: 1px solid #CCC; width:80%">
                                                       <h4 style="font-weight: 100; color: #999; padding: 0 20px"> Para comenzar a usar tu cuenta, debe confirmar su dirección de correo electrónico </h4>
                                                       <a href="'. PathSystem .'Verificar/'.$Crymail.'" target="_blank" style="text-decoration: none"> <div style="line-height: 60px; background: #0AA; width: 60%; color: white"> Verifique su dirección de correo electrónico </div> </a>
                                                       <br>
                                                       <hr style="border: 1px solid #CCC; width: 80%">
                                                       <h5 style="font-weight: 100; color: #999"> Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará. </h5>
                                                  </center>
                                             </div>
                                        </div>');

                              $Envio = $Mail-> Send();

                              if( !$Envio )
                              {
                                   echo '<script>
                                             swal(
                                                  {
                                                  title            : "¡ERROR!",
                                                  text             : "¡Ha ocurrido un problema enviando verificación de correo electrónico a '. $_POST["RegMail"] . $Mail -> ErrorInfo .'!",
                                                  type             : "error",
                                                  confirmButtonText: "Cerrar",
                                                  closeOnConfirm   : false
                                             }, function(isConfirm) { if(isConfirm) { history.back(); } });
                                        </script>';
                              }
                              else
                              {
                                   echo '<script>
                                             swal(
                                             {
                                                  title            : "¡OK!",
                                                  text             : "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["RegMail"].' para verificar la cuenta!",
                                                  type             :"success",
                                                  confirmButtonText: "Cerrar",
                                                  closeOnConfirm   : false
                                             }, function(isConfirm) { if(isConfirm) { history.back(); } });
                                        </script>';

                              }

                         }

                    }
                    else
                    {
                         echo '<script> swal(
                                        {
                                             title            : "¡ERROR!",
                                             text             : "¡Error al registrar el usuario, no se permiten caracteres especiales!",
                                             type             : "error",
                                             confirmButtonText: "Cerrar",
                                             closeOnConfirm   : false
                                        }, function(isConfirm) { if(isConfirm) { history.back(); } });
                              </script>';
                    }

               }

          }

          public function CtrLoginUser()
          {

          	if(isset( $_POST["LgnMail"]) )
               {

                    if( preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', strtolower($_POST["LgnMail"])) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["LgnPass"]))
                    {

                         $User = UsuariosModel :: MdlGetUser("Mail", strtolower($_POST["LgnMail"]));

                         if( password_verify($_POST["LgnPass"], $User["Password"]) )
                         {
                              
                              if($User["Verificacion"] == 1)
                              {

                                   echo'<script>
                                             swal(
                                             {
                                                  title            : "¡NO HA VERIFICADO SU CORREO ELECTRÓNICO!",
                                                  text             : "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo para verififcar la dirección de correo electrónico '.$User["email"].'!",
                                                  type             : "error",
                                                  confirmButtonText: "Cerrar",
                                                  closeOnConfirm   : false
                                             }, function(isConfirm) { if (isConfirm) { history.back(); } });
                                        </script>';

                              }
                              else
                              {
                                  
                                   $_SESSION["ValSesion"] = "Ok";
                                   $_SESSION["IdUsr"]     = $User["IdUsr"];
                                   $_SESSION["Modo"]      = $User["Modo"];
                                   $_SESSION["Name"]      = $User["Nombre"];
                                   $_SESSION["Foto"]      = $User["Foto"];
                                   $_SESSION["Mail"]      = $User["Mail"];
                                   $_SESSION["Pass"]      = $User["Password"];
                                   
                                   echo '<script> window.location = localStorage.getItem("rutaActual"); </script>';

                              }

                         }
                         else
                         {
                              echo'<script>
                                        swal(
                                        {
                                             title            : "¡ERROR AL INGRESAR!",
                                             text             : "¡Por favor revise que el email exista o la contraseña!",
                                             type             : "error",
                                             confirmButtonText: "Cerrar",
                                             closeOnConfirm   : false
                                        }, function(isConfirm) { if (isConfirm) { window.location = localStorage.getItem("rutaActual"); } });
                                   </script>';
                         }

                    }

               }

          }

          public function CtrRecoverPass()
          {

               if( isset($_POST["RecMail"]) )
               {

                    if( preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', strtolower($_POST["RecMail"])) )
                    {

                         /* ===== Generar Contraseña aleatoria  ===== */
                         function generarPassword($longitud)
                         {

                              $key     = "";
                              $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
                              $max     = strlen($pattern) - 1;
                              
                              for( $i = 0; $i < $longitud; $i++ )
                              {
                                   $key .= $pattern{ mt_rand(0, $max) };
                              }

                              return $key;

                         }

                         $NewPassword = generarPassword(11);
                         $Opc         = [ 'cost' => 11 ];
                         $CryPass     = password_hash($NewPassword, PASSWORD_BCRYPT, $Opc);
                         $User        = UsuariosModel :: MdlGetUser("Mail", strtolower($_POST["RecMail"]));

                         if ($User)
                         {

                              $UpdPass = UsuariosModel :: MdlUpdUser($User["IdUsr"], "Password", $CryPass);

                              if( $UpdPass == "Ok" )
                              {

                                   $Mail  = new PHPMailer(true);
                                   $Mail -> CharSet = 'UTF-8';
                                   $Mail -> isMail();
                                   $Mail -> setFrom('clave@musica.com', 'Clave - El expero en alientos');
                                   $Mail -> addReplyTo('clave@musica.com', 'Clave - El expero en alientos');
                                   $Mail -> Subject = "Solicitud de Nueva Contraseña";
                                   $Mail -> addAddress(strtolower($_POST["RecMail"]));
                                   $Mail -> msgHTML('
                                                  <div style="width: 100%; background: #EEE; position: relative; font-family: sans-serif; padding-bottom: 40px">
          
                                                       <center> <img style="padding: 20px; width: 10%" src="'. PathSystem .'Public/Img/LogoClave.png"> </center>
                                             
                                                       <div style="position: relative; margin: auto; width: 600px; background: white; padding: 20px">
                                                            <center>
                                                                 <img style="padding: 20px; width:15%" src="'. PathSystem .'Public/Img/PassIcon.png">
                                                                 <h3 style="font-weight: 100; color: #999"> SOLICITUD DE NUEVA CONTRASEÑA </h3>
                                                                 <hr style="border: 1px solid #CCC; width:80%">
                                                                 <h4 style="font-weight: 100; color: #999; padding: 0 20px"> Su nueva contraseña: </strong>'. $NewPassword .' </h4>
                                                                 <a href="'. PathSystem .'" target="_blank" style="text-decoration: none"> <div style="line-height: 60px; background: #0AA; width: 60%; color: white"> Ir al Sitio </div> </a>
                                                                 <br>
                                                                 <hr style="border: 1px solid #CCC; width: 80%">
                                                                 <h5 style="font-weight: 100; color: #999"> Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará. </h5>
                                                            </center>
                                                       </div>
                                                  </div>');
     
                                   $Envio = $Mail-> Send();

                                   if(!$Envio)
                                   {
                                        echo '<script>
                                                  swal(
                                                  {
                                                       title: "¡ERROR!",
                                                       text : "¡Ha ocurrido un problema enviando cambio de contraseña a '. $_POST["RecMail"] . $Mail -> ErrorInfo .'!",
                                                       type : "error",
                                                       confirmButtonText: "Cerrar",
                                                       closeOnConfirm   : false
                                                  }, function(isConfirm) { if(isConfirm) { history.back(); } });
                                             </script>';
                                   }
                                   else
                                   {
                                        echo '<script>
                                                  swal(
                                                  {
                                                       title: "¡Nueva Contraseña Enviada!",
                                                       text : "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["RecMail"].' para su cambio de contraseña!",
                                                       type : "success",
                                                       confirmButtonText: "Cerrar",
                                                       closeOnConfirm   : false
                                                  }, function(isConfirm) { if(isConfirm) { history.back(); } });
                                             </script>';
     
                                   }

                              }

                         }
                         else
                         {
                              echo '<script>
                                        swal(
                                        {
                                             title            : "¡ERROR!",
                                             text             : "¡El correo electrónico no existe en el sistema!",
                                             type             : "error",
                                             confirmButtonText: "Cerrar",
                                             closeOnConfirm   : false
                                        }, function(isConfirm) { if(isConfirm) { history.back(); } });

					          </script>';
                         }

                    }

               }

          }

          public static function CtrGetUser($Param, $Value)
          {

               $User = UsuariosModel :: MdlGetUser($Param, $Value);

               return $User;

          }

          public static function CtrUpdUser($Id, $Item, $Valor)
          {

               $User = UsuariosModel :: MdlUpdUser($Id, $Item, $Valor);

               return $User;

          }

          public static function CtrRegistroRedes($Datos)
          {

               $Param = "Mail";
		     $Value = $Datos["Mail"];
               $MailR = false;
               
               $User  = UsuariosModel :: MdlGetUser($Param, $Value);

               if($User)
               {

                    if( $User["Modo"] != $Datos["Modo"] )
                    {

                         echo '<script> 
                                   swal(
                                   {
                                        title            : "¡ERROR!",
                                        text             : "¡El correo electrónico '. $Datos["Mail"] .', ya está registrado en el sistema con un método diferente a Google!",
                                        type             :"error",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm   : false
                                   },
                                   function(isConfirm)
                                   {
                                        if(isConfirm)
                                        {
                                             history.back();
                                        }
                                   });
                              </script>';

                         $MailR = false;

                    }

                    $MailR = true;

               }
               else
               {
                    $Registro = UsuariosModel :: MdlRegUser($Datos);
               }

               if( $MailR || $Registro == "Ok" )
               {

                    $Resp = UsuariosModel :: MdlGetUser($Param, $Value);
                    
                    if( $Resp["Modo"] == "Facebook")
                    {
                         session_start();

                         $_SESSION["ValSesion"] = "Ok";
                         $_SESSION["IdUsr"]     = $Resp["IdUsr"];
                         $_SESSION["Modo"]      = $Resp["Modo"];
                         $_SESSION["Name"]      = $Resp["Nombre"];
                         $_SESSION["Foto"]      = $Resp["Foto"];
                         $_SESSION["Mail"]      = $Resp["Mail"];
                         $_SESSION["Pass"]      = $Resp["Password"];
                                                       
                         echo "Ok";
                    
                    }
                    else if( $Resp["Modo"] == "Google" )
                    {

                         $_SESSION["ValSesion"] = "Ok";
                         $_SESSION["IdUsr"]     = $Resp["IdUsr"];
                         $_SESSION["Modo"]      = $Resp["Modo"];
                         $_SESSION["Name"]      = $Resp["Nombre"];
                         $_SESSION["Foto"]      = $Resp["Foto"];
                         $_SESSION["Mail"]      = $Resp["Mail"];
                         $_SESSION["Pass"]      = $Resp["Password"];
                         
                         // echo "<span style='color:white'>Ok</span>";

                    }
                    else
                    {
                         echo "";
                    }

               }

          }

          public function CtrUpdPerfil()
          {

               if( isset($_POST["EdtName"]) )
               {

                    /* ===== Validar Imagen =====*/
                    $FotoPerf = $_POST["Foto"];

                    if( isset($_FILES["datosImagen"]["tmp_name"]) && !empty( $_FILES["datosImagen"]["tmp_name"]) )
                    {

                         /* ===== Checar si hay Img en BD =====*/
                         if( !empty($_POST["Foto"]) && ($_POST["Foto"] != "Public/Img/Users/Avatar.jpg") )
                         {
                              unlink($_POST["Foto"]);
                         }
                         
                         /* ===== Guardar Imagen en Directorio =====*/
                         list($ancho, $alto) = getimagesize($_FILES["datosImagen"]["tmp_name"]);

                         $nuevoAncho = 500;
                         $nuevoAlto  = 500;
                         $aleatorio  = mt_rand(100, 999);

                         if($_FILES["datosImagen"]["type"] == "image/jpeg")
                         {
                              $FotoPerf = "Public/Img/Users/". $aleatorio .".jpg";

                              /* ===== Modificar tamaño de Imagen =====*/
                              $origen  = imagecreatefromjpeg($_FILES["datosImagen"]["tmp_name"]);
                              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                              
                              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                              imagejpeg($destino, $FotoPerf);
                         }

                         if($_FILES["datosImagen"]["type"] == "image/png")
                         {

                              $FotoPerf = "Public/Img/Users/". $aleatorio .".jpg";

                              /* ===== Modificar tamaño de Imagen =====*/
                              $origen  = imagecreatefrompng($_FILES["datosImagen"]["tmp_name"]);
                              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                              imagealphablending($destino, FALSE);
                              imagesavealpha($destino, TRUE);
                              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                              imagepng($destino, $FotoPerf);

                         }

                    }
                    
                    if( $_POST["EdtPass"] == "" )
                    {
                         $Pass = $_POST["Pass"];
                    }
                    else
                    {
                         $Opc  = [ 'cost' => 11 ];
                         $Pass = password_hash(($_POST["EdtPass"]), PASSWORD_BCRYPT, $Opc);                         
                    }

                    $Datos = array("Id" => $_POST["IdUsr"], "Name" => $_POST["EdtName"], "Pass" => $Pass, "Mail" => strtolower($_POST["EdtMail"]), "Foto" => $FotoPerf);                    
                    $Resp  = UsuariosModel :: MdlUpdPerfil($Datos);
                    
                    if( $Resp = "Ok" )
                    {

                         $_SESSION["ValSesion"] = "Ok";
                         $_SESSION["IdUsr"]     = $Datos["Id"];
                         $_SESSION["Modo"]      = $_POST["Modo"];
                         $_SESSION["Name"]      = $Datos["Name"];
                         $_SESSION["Foto"]      = $Datos["Foto"];
                         $_SESSION["Mail"]      = $Datos["Mail"];
                         $_SESSION["Pass"]      = $Datos["Pass"];
                         
                         echo '<script>
                                   swal(
                                   {
                                        title            : "¡OK!",
                                        text             : "¡Su cuenta ha sido actualizada correctamente!",
                                        type             :"success",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm   : false
                                   }, function(isConfirm) { if(isConfirm) { history.back(); } });';
                         
                         echo '</script>';

                    }
               }

          }

          public static function CtrGetCompras($Param, $Value)
          {

               $Compras = UsuariosModel :: MdlGetCompras($Param, $Value);
               
               return $Compras;

          }

          public static function ctrComentariosPerfil($Datos)
          {

               $Coments = UsuariosModel :: MdlComentariosPerfil($Datos);

		     return $Coments;

          }

          public function ctrActualizarComentario()
          {

               if(isset($_POST["idComentario"]))
               {

                    if(preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["comentario"]))
                    {
                         
                         if($_POST["comentario"] != "")
                         {

                              $Datos = array("id" => $_POST["idComentario"], "calificacion" => $_POST["Puntaje"], "comentario" => $_POST["comentario"]);
                              
                              $respuesta = UsuariosModel :: MdlActualizarComentario($Datos);
                              
                              if($respuesta == "Ok")
                              {
                                   echo'<script>
                                             swal(
                                             {
                                                  title: "¡GRACIAS POR COMPARTIR SU OPINIÓN!",
                                                  text: "¡Su calificación y comentario ha sido guardado!",
                                                  type: "success",
                                                  confirmButtonText: "Cerrar",
                                                  closeOnConfirm: false
                                             }, function(isConfirm) { if (isConfirm) { history.back(); } });
                                        </script>';
                              }
                         }
                         else
                         {
                              echo'<script>
                                        swal(
                                        {
                                             title: "¡ERROR AL ENVIAR SU CALIFICACIÓN!",
                                             text: "¡El comentario no puede estar vacío!",
                                             type: "error",
                                             confirmButtonText: "Cerrar",
                                             closeOnConfirm: false
                                        }, function(isConfirm) { if (isConfirm) { history.back(); } });
                                   </script>';
                         }
                    
                    }
                    else
                    {
                         echo'<script>
                                   swal(
                                   {
                                        title: "¡ERROR AL ENVIAR SU CALIFICACIÓN!",
                                        text: "¡El comentario no puede llevar caracteres especiales!",
                                        type: "error",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                   }, function(isConfirm) { if (isConfirm) { history.back(); } });
                              </script>';
                    }

               }

          }

          public static function CtrAgregarDeseo($Datos)
          {

               $Wish = UsuariosModel :: MdlAgregarDeseo($Datos);

               return $Wish;

          }
          
          public static function CtrMostrarDeseos($Item)
          {
               
               $Wish = UsuariosModel :: MdlMostrarDeseos($Item);

               return $Wish;

          }
          
          public static function CtrQuitarDeseo($Datos)
          {

               $Resp = UsuariosModel :: MdlQuitarDeseo($Datos);

               return $Resp;

          }

          public function CtrEliminarUsuario()
          {

               if( isset($_GET["Id"]) )
               {
                    
                    $Id = $_GET["Id"];

                    if( $_GET["Foto"] != "Public/Img/Users/Avatar.png" )
                    {
                         unlink($_GET["Foto"]);                         
                    }

                    $Resp = UsuariosModel :: MdlEliminarUsuario($Id);
                    
                    UsuariosModel :: MdlEliminarComentarios($Id);

                    UsuariosModel :: MdlEliminarCompras($Id);

                    UsuariosModel :: MdlEliminarListaDeseos($Id);

                    if( $Resp == "Ok" )
                    {
                         echo'<script>
                                   swal(
                                   {
                                        title            : "¡SU CUENTA HA SIDO BORRADA!",
                                        text             : "¡Debe registrarse nuevamente si desea ingresar!",
                                        type             : "success",
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm   : false
                                   }, function(isConfirm) { if (isConfirm) { window.location = "'. PathSystem .'Salir"; } });
                              </script>';
                    }
               
               }
          
          }

     }