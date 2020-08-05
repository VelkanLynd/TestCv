<!doctype html>
<html lang="es">

<?php

     session_start();

?>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, shrink-to-fit=no">
     <meta name="description" content="Clave, Instrumentos">
     <meta name="keywords" content="Clave, música, instrumentos, musicales">
     <meta name="author" content="Dev Fenryr">
     <meta name="copyright" content="Copyright®">
     <title> Clave - El Experto en alientos </title>

    <link rel="icon" href="<?php echo(PathSystem); ?>Public/Img/IconClave.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/FontAwesome.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/bootnavbar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/Site.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/ProductDetail.css">
    <link rel="stylesheet" type="text/css" href="<?php echo(PathSystem); ?>Public/Css/sweetalert.css">

    
    <script type="text/javascript" src="<?php echo(PathSystem); ?>Public/Js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo(PathSystem); ?>Public/Js/popper.js"></script>
    <script type="text/javascript" src="<?php echo(PathSystem); ?>Public/Js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo(PathSystem); ?>Public/Js/owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo(PathSystem); ?>Public/Js/sweetalert.min.js"></script>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">
    
</head>

<body>

     <div class="container">
     <?php
          
          $WhiteList = array("Cat", "SubCat", "Buscador", "Cart", "Productos", "Perfil", "Verificar", "Salir");
          
          include_once("Header.php");
          
          if( isset($_GET["Path"]) )
          {

               $Path     = explode("/", trim($_GET["Path"], "/"));
               $ProdPath = ProductosController :: CtrInfoProducto("Ruta", $Path[0]);
               $PagePhp  = $Path[0].".php";
               
               if( in_array($Path[0], $WhiteList) )
               {
                    include_once($PagePhp);
               }
               else if( isset($ProdPath["Ruta"]) && ($Path[0] == $ProdPath["Ruta"]) )
               {
                    include_once("Producto.php");
               }
               else
               {
                    include_once("404.php");
               }

          }
          else
          {
               
               include_once("Main.php");

          }

          include_once("Footer.php");

     ?>
     
          <input type="hidden" value="<?= PathSystem; ?>" id="rutaOculta">

     </div>

     <script src="<?php echo(PathSystem); ?>Public/Js/bootnavbar.js" ></script>
     <script src="<?php echo(PathSystem); ?>Public/Js/Template.js" ></script>
     <script src="<?php echo(PathSystem); ?>Public/Js/Site.js" ></script>
     <script src="<?php echo(PathSystem); ?>Public/Js/ProductDetail.js"></script>
     <script>
     
          window.fbAsyncInit = function()
          {
               FB.init(
               {
                    appId      : '2785389238361368',
                    cookie     : true,
                    xfbml      : true,
                    version    : 'v7.0'
               });
               
               FB.AppEvents.logPageView();   
          
          };
          
          (function(d, s, id)
          {
               
               var js, fjs = d.getElementsByTagName(s)[0];
               
               if (d.getElementById(id)) {return;}
               
               js = d.createElement(s); js.id = id;
               js.src = "https://connect.facebook.net/en_US/sdk.js";
               fjs.parentNode.insertBefore(js, fjs);
               
          }(document, 'script', 'facebook-jssdk'));

</script>

</body>
</html>