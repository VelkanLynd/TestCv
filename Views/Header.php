<?php

     if( isset($_SESSION["ValSesion"]) )
     {
          if($_SESSION["ValSesion"] == "Ok")
          {
               echo '<script> localStorage.setItem("Usr", "'. $_SESSION["IdUsr"] .'"); </script>';
          }
     }

     /* ===== CREAR EL OBJETO DE LA API GOOGLE ===== */
     $cliente  = new Google_Client();
     $cliente -> setAuthConfig('Models/googleusercontent.json');
     $cliente -> setAccessType("offline");
     $cliente -> setScopes(['profile','email']);

     /* ===== RUTA PARA EL LOGIN DE GOOGLE ===== */
     $rutaGoogle = $cliente -> createAuthUrl();

     /* ===== RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE ===== */
     if(isset($_GET["code"]))
     {
          $token = $cliente -> authenticate($_GET["code"]);
          
          $_SESSION['TokenGoogle'] = $token;
          
          $cliente -> setAccessToken($token);
     }

     /* ===== RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY ===== */
     if($cliente -> getAccessToken())
     {
          $item  = $cliente -> verifyIdToken();
          $Datos = array("Modo" => "Google", "Name" => $item["name"], "Pass" => "null", "Mail" => strtolower($item["email"]), "Foto" => $item["picture"], "Dir" => "", "Vrfy" => 0, "MlCr" => "null");
          
          $Resp = UsuariosController :: CtrRegistroRedes($Datos);

          echo '<script>
                    setTimeout(function() { window.location = localStorage.getItem("rutaActual"); }, 1000);
               </script>';

     }

?>


<div class="row my-3 d-flex align-items-baseline">
	
	<div class="col-md-4">
		<a href="<?php echo(PathSystem); ?>"> <img src="<?php echo(PathSystem); ?>Public/Img/LogoClave.png" alt="Clave" class="img-fluid"> </a>
	</div>
	
	<div class="col-md-8">
		<div class="row my-3">
			<div class="col-md-12 d-flex justify-content-center justify-content-sm-end">
               <?php

                    if( isset($_SESSION["ValSesion"]) )
                    {
                         if( $_SESSION["ValSesion"] == "Ok" )
                         {
                              if( $_SESSION["Modo"] == "Directo" )
                              {
                                   echo '<img class="img-circle img-thumbnail" src="'. PathSystem . $_SESSION["Foto"] .'" width="30px">';
                                   echo '&nbsp; &#8226; &nbsp;';
                                   echo '<a href="'. PathSystem .'Perfil" class="Link">'. $_SESSION["Name"] .'</a>';
                                   echo '&nbsp; &#8226; &nbsp;';
                                   echo '<a href="'. PathSystem .'Salir" class="Link"> Salir </a>';
                              }
                              elseif( $_SESSION["Modo"] == "Facebook" )
                              {
                                   echo '<img class="img-circle img-thumbnail" src="'. $_SESSION["Foto"] .'" width="30px">';
                                   echo '&nbsp; &#8226; &nbsp;';
                                   echo '<a href="'. PathSystem .'Perfil" class="Link">'. $_SESSION["Name"] .'</a>';
                                   echo '&nbsp; &#8226; &nbsp;';
                                   echo '<a href="'. PathSystem .'Salir" class="Link Salir"> Salir </a>';
                              }
                              elseif( $_SESSION["Modo"] == "Google" )
                              {
                                   echo '<img class="img-circle img-thumbnail" src="'. $_SESSION["Foto"] .'" width="30px">';
                                   echo '&nbsp; &#8226; &nbsp;';
                                   echo '<a href="'. PathSystem .'Perfil" class="Link">'. $_SESSION["Name"] .'</a>';
                                   echo '&nbsp; &#8226; &nbsp;';
                                   echo '<a href="'. PathSystem .'Salir" class="Link"> Salir </a>';
                              }
                         }
                    }
                    else
                    {
                         echo '<a href="#" class="Link" data-toggle="modal" data-target="#MdlLogin"> Cuenta </a>';
                    }

               ?>
				
                    &nbsp; &#8226; &nbsp;
                    <a href="<?= PathSystem ?>Cart" class="Link text-right"> <span id="CntPrd" class="badge badge-dark"></span> <i class="fa fa-shopping-basket" aria-hidden="true"></i> </a>
			</div>
		</div>
		<div class="row">
               <div class="col-md-1"></div>
               <div class="col-md-6 mb-3">
                    <div id="Buscador" class="input-group">
                         <input type="search" name="PrmSearch" class="form-control border-secondary py-2" placeholder="Buscar...">
                         <div class="input-group-append"> <a href="<?php echo(PathSystem); ?>Buscador"> <button class="btn btn-outline-secondary"> <i class="fa fa-search"></i> </button> </a> </div>
                    </div>
               </div>
			<div class="col-md-5 d-flex justify-content-center justify-content-sm-end mb-3">
				<img src="<?php echo(PathSystem); ?>Public/Img/Facebook.png" alt="" class="img-fluid SocIcnF">
				<img src="<?php echo(PathSystem); ?>Public/Img/Instagram.png" alt="" class="img-fluid SocIcnI">
			</div>
		</div>
	</div>
	
</div>

<div class="sticky-top">

	<!-- Navbar -->
	<nav id="main_navbar" class="navbar navbar-expand-xl navbar-light bg-light justify-content-center">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div id="navbarSupportedContent" class="collapse navbar-collapse">

			<ul class="navbar-nav">
			<?php
                    

				$Categorias = MenuController :: ctrGetCategorias();

                    foreach( $Categorias as $Categoria )                    
                    {

                         array_push($WhiteList, $Categoria["Ruta"]);

                         echo '<li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle" href="'. PathSystem .'Cat/'. $Categoria['Ruta'] .'" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '. $Categoria['Categoria'] .' </a>
                                   <ul class="dropdown-menu">
                         ';
                         
					$SubCat1 = MenuController :: ctrGetSubCats1($Categoria["IdCat"]);
                         
                         foreach($SubCat1 as $SubCategoria)
                         {

                              array_push($WhiteList, $SubCategoria["Ruta"]);
                                             	
						$SubCat2 = MenuController :: ctrGetSubCats2($SubCategoria["IdSubCat1"]);

                              if( count($SubCat2) > 0 )
                              {
                                   echo '<li class="nav-item dropdown">
                                         <a class="dropdown-item dropdown-toggle" href="'. PathSystem .'SubCat/'. $SubCategoria['Ruta'] .'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '. $SubCategoria["SubCategoria"] .' </a>
                                         <ul class="dropdown-menu">
                                   ';
                                   
                                   foreach($SubCat2 as $SubCategoria)
                                   {

                                        array_push($WhiteList, $SubCategoria["Ruta"]);
							
								$SubCat3 = MenuController :: ctrGetSubCats3($SubCategoria["IdSubCat2"]);

                                        if ( count($SubCat3) > 0 )
                                        {

                                             echo '<li class="nav-item dropdown">
                                                       <a class="dropdown-item dropdown-toggle" href="'. PathSystem .'SubCat/'. $SubCategoria['Ruta'] .'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '. $SubCategoria["SubCategoria"] .' </a>
                                                       <ul class="dropdown-menu">
                                             ';

                                             foreach($SubCat3 as $SubCategoria)
                                             {

                                                  array_push($WhiteList, $SubCategoria["Ruta"]);

                                                  echo '<li> <a class="dropdown-item" href="'. PathSystem .'SubCat/'. $SubCategoria['Ruta'] .'"> '. $SubCategoria["SubCategoria"] .' </a> </li>';
                                                  
                                             }

                                             echo '</ul> </li>';

                                        }
                                        else
                                        { echo '<li> <a class="dropdown-item" href="'. PathSystem .'SubCat/'. $SubCategoria['Ruta'] .'"> '. $SubCategoria["SubCategoria"] .' </a> </li>'; }
                                        
                                   }                    

                                   echo '</ul> </li>';
                              }
                              else
                              {
                                   echo '<li> <a class="dropdown-item" href="'. PathSystem .'SubCat/'. $SubCategoria['Ruta'] .'"> '. $SubCategoria["SubCategoria"] .' </a> </li>';
                              }

                         }

                         echo('</ul> </li>');

                    }

               ?>			
			</ul>

		</div>            
	</nav>

</div>



<!-- Modal Login -->
<div id="MdlLogin" role="dialog" class="modal fade">
     <div class="modal-dialog" role="document">

          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title w-100 text-center"> Ingresar </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
               </div>

               <div class="modal-body">
                    <form id="FrmLgn" method="POST">

                         <div class="row social-btn">
                              <div class="col-md-6">
                                   <a href="#" id="LgnFacebook" class="btn btn-block btn-secondary Facebook"><i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                              </div>
                              <div class="col-md-6">
                                   <a href="<?php echo $rutaGoogle; ?>" id="LgnGoogle" class="btn btn-block btn-danger Google"><i class="fa fa-google"></i>&nbsp; Google</a>
                              </div>
                         </div>

                         <div class="or-seperator"><i></i></div>

                         <div class="form-group">
                              <div class="input-group">
                                   <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-envelope"></span> </span> </div>
                                   <input type="correo" class="form-control" id="LgnMail" name="LgnMail" placeholder="Correo" required="required">
                              </div>
                         </div>
                         <div class="form-group">
                              <div class="input-group">
                                   <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-lock"></i> </span> </div>
                                   <input type="password" class="form-control" id="LgnPass" name="LgnPass" placeholder="Contraseña" required="required">
                              </div>
                         </div>
                         <div class="form-group">
                              <button type="submit" class="btn btn-block btn-info BtnIngreso"> Ingresar </button>
                         </div>

                         <div class="or-seperator"><i></i></div>

                         <div class="row">
                              <div class="col-md-6">
                                   <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#MdlRegister" class="btn btn-block btn-dark"> Registrar </button>
                              </div>
                              <div class="col-md-6">
                                   <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#MdlRecover" class="btn btn-block btn-dark"> Recuperar contraseña </button>
                              </div>
                         </div>

                         <?php

                              $Ingreso =  new UsuariosController();
                              $Ingreso -> CtrLoginUser();

                         ?>

                    </form>

               </div>

               <div class="modal-footer">
               </div>

          </div>

     </div>
</div>





<!-- Modal Registro -->
<div id="MdlRegister" role="dialog" class="modal fade">
     <div class="modal-dialog" role="document">

          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title w-100 text-center"> Registrar </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
               </div>

               <div class="modal-body">
                    <form id="FrmReg" method="POST" onsubmit="return RegUser(this);">

                    <div class="row social-btn">
                              <div class="col-md-6">
                                   <a href="#" id="LgnFacebook" class="btn btn-block btn-secondary Facebook"><i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                              </div>
                              <div class="col-md-6">
                                   <a href="<?php echo $rutaGoogle; ?>" id="LgnGoogle" class="btn btn-block btn-danger Google"><i class="fa fa-google"></i>&nbsp; Google</a>
                              </div>
                         </div>

                         <div class="or-seperator"><i></i></div>

                         <div class="form-group">
                              <div class="input-group">
                                   <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-user"></span> </span> </div>
                                   <input type="text" class="form-control" id="RegName" name="RegName" placeholder="Nombre" required="required">
                              </div>
                         </div>

                         <div class="form-group">
                              <div class="input-group">
                                   <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-envelope"></span> </span> </div>
                                   <input type="correo" class="form-control" id="RegMail" name="RegMail" placeholder="Correo" required="required">
                              </div>
                         </div>

                         <div class="form-group">
                              <div class="input-group">
                                   <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-lock"></i> </span> </div>
                                   <input type="password" class="form-control" id="RegPass" name="RegPass" placeholder="Contraseña" required="required">
                              </div>
                         </div>

                         <div class="form-group">
                              <button type="submit" class="btn btn-block btn-info"> Registrar </button>
                         </div>

                         <div class="or-seperator"><i></i></div>

                         <div class="row">
                              <div class="col-md-6">
                                   <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#MdlLogin" class="btn btn-block btn-dark"> Ingresar </button>
                              </div>
                              <div class="col-md-6">
                                   <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#MdlRecover" class="btn btn-block btn-dark"> Recuperar contraseña </button>
                              </div>
                         </div>

                         <?php

                              $Registro =  new UsuariosController();
                              $Registro -> CtrRegisterUser();

                         ?>

                    </form>

               </div>

               <div class="modal-footer">
               </div>

          </div>
          
     </div>
</div>





<!-- Modal Recuperar -->
<div id="MdlRecover" role="dialog" class="modal fade">
     <div class="modal-dialog" role="document">

          <div class="modal-content">

               <div class="modal-header">
                    <h4 class="modal-title w-100 text-center"> Recuperar contraseña </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
               </div>

               <div class="modal-body">
                    <form method="POST">

                         <label class="text-muted">Escribe el correo electrónico con el que te registraste y te enviaremos una nueva contraseña</label>

                         <div class="form-group">
                              <div class="input-group">
                                   <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-envelope"></span> </span> </div>
                                   <input type="correo" class="form-control" name="RecMail" placeholder="Correo" required="required">
                              </div>
                         </div>
                         <div class="form-group">
                              <button type="submit" class="btn btn-block btn-info"> Ingresar </button>
                         </div>


                         <?php

                              $RecPass =  new UsuariosController();
                              $RecPass -> CtrRecoverPass();

                         ?>

                    </form>

               </div>

               <div class="modal-footer">
               </div>

          </div>
          
     </div>
</div>