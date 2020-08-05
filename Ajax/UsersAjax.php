<?php

     require_once("../Config/Config.php");
     require_once("../Controllers/UsuariosController.php");
     require_once("../Models/UsuariosModel.php");

     class UserAjax
     {

          /* ===== Validar Email Existente ===== */
          public $validarEmail;

          public function ValidarEmail()
          {
               
               $Datos = $this -> validarEmail;

               $Resp = UsuariosController :: CtrGetUser("Mail", $Datos);

               echo json_encode($Resp);
               

          }

          /* ===== Registro con Facebook ===== */
          public $Mail;
          public $Name;
          public $Foto;

          public function RegistroFacebook()
          {

               $Datos = array( "Modo" => "Facebook", "Name" => $this -> Name, "Pass" => "null", "Mail" => $this -> Mail, "Foto" => $this -> Foto, "Dir" => "", "Vrfy" => 0, "MlCr" => "null");

               $Resp = UsuariosController :: CtrRegistroRedes($Datos);

               echo $Resp;

          }

          /* ===== Agregar a Lista de Deseos ===== */	
          public $idUsuario;
          public $idProducto;

          public function AgregarDeseo()
          {
               
               $Datos = array("idUsuario" => $this -> idUsuario, "idProducto" => $this -> idProducto);

               $Resp = UsuariosController :: CtrAgregarDeseo($Datos);

               echo $Resp;

          }

          /* ===== Quitar producto de  Lista de Deseos ===== */
          public $IdWish;	

          public function QuitarDeseo()
          {
               
               $Datos = $this -> IdWish;
               
               $Resp = UsuariosController :: CtrQuitarDeseo($Datos);

               echo $Resp;
               
          }

     }



     /* ===== Validar Email Existente ===== */
     if( isset($_POST["ValidarEmail"]) )
     {

          $valEmail  = new UserAjax();
          $valEmail -> validarEmail = $_POST["ValidarEmail"];
          $valEmail -> ValidarEmail();

     }

     /* ===== Registro con Facebook ===== */
     if(isset($_POST["Mail"]))
     {
          $regFacebook  = new UserAjax();
          $regFacebook -> Mail = $_POST["Mail"];
          $regFacebook -> Name = $_POST["Name"];
          $regFacebook -> Foto = $_POST["Foto"];
          $regFacebook -> RegistroFacebook();
     }

     /* ===== Agregar a Lista de Deseos ===== */	
     if( isset($_POST["idUsuario"]) )
     {
          $deseo =  new UserAjax();
          $deseo -> idUsuario  = $_POST["idUsuario"];
          $deseo -> idProducto = $_POST["idProducto"];
          $deseo -> AgregarDeseo();
     }

     /* ===== Quitar de Lista de Deseos ===== */
     if( isset($_POST["IdWish"]) )
     {     
          $quitarDeseo =  new UserAjax();
          $quitarDeseo -> IdWish = $_POST["IdWish"];
          $quitarDeseo -> QuitarDeseo();
     }