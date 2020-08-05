<?php

     require_once("Config/Config.php");
     require_once("Libraries/PhpMailer/PHPMailerAutoload.php");
     require_once("Libraries/vendor/autoload.php");
     require_once("Controllers/TemplateController.php");
     require_once("Controllers/MenuController.php");
     require_once("Controllers/ProductosController.php");
     require_once("Controllers/CategoriasController.php");
     require_once("Controllers/UsuariosController.php");

     require_once("Models/MenuModel.php");
     require_once("Models/ProductosModel.php");
     require_once("Models/CategoriasModel.php");
     require_once("Models/UsuariosModel.php");

     $Template  = new TemplateController();
     $Template -> Template();