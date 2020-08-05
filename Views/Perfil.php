<?php

if( !isset($_SESSION["ValSesion"]) )
{
	echo '<script> window.location = "'. PathSystem .'"; </script>';

     exit();
}

?>

<div class="row my-4">

     <div class="col-12">
          <ol class="breadcrumb shadow-lg bg-white">
               <li class="breadcrumb-item"> <a href="<?php echo(PathSystem); ?>" class="pr-md-3 pl-md-2 pr-2 pl-1 "> <i class="fa fa-home" aria-hidden="true"></i> Inicio </a></li>
               <li class="breadcrumb-item"> <a href="#" class="px-md-3 px-1 active-1"> Perfil </a> </li>
          </ol>
     </div>
     
</div>

<nav>
     <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-Compras-tab" data-toggle="tab" href="#nav-Compras" role="tab" aria-controls="nav-Compras" aria-selected="true"> <i class="fa fa-list-alt" aria-hidden="true"></i> Compras </a>
          <a class="nav-item nav-link" id="nav-WhishList-tab" data-toggle="tab" href="#nav-WhishList" role="tab" aria-controls="nav-WhishList" aria-selected="false"> <i class="fa fa-heart" aria-hidden="true"></i> Lista de Deseos </a>
          <a class="nav-item nav-link" id="nav-Ofertas-tab" data-toggle="tab" href="#nav-Ofertas" role="tab" aria-controls="nav-Ofertas" aria-selected="false"> <i class="fa fa-tags" aria-hidden="true"></i> Ofertas </a>
          <a class="nav-item nav-link" id="nav-Perfil-tab" data-toggle="tab" href="#nav-Perfil" role="tab" aria-controls="nav-Perfil" aria-selected="false"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> Perfil </a>
     </div>
</nav>

<div class="tab-content" id="nav-tabContent" style="margin-top: 25px;">

     <!-- Compras -->
     <div id="nav-Compras" class="tab-pane fade show active" role="tabpanel" aria-labelledby="nav-Compras-tab">

          <div style="height: 25px;"></div>
          <div class="row justify-content-center">          
          <?php

               $Compras = UsuariosController :: CtrGetCompras("IdUsr", $_SESSION["IdUsr"]);
                                        
               if( !$Compras )
               {
                    echo '<div class="col-xs-12 text-center"> <h2>Aún no tienes compras realizadas</h2> </div>';
               }
               else
               {
                    foreach($Compras as $Compra)
                    {

                         $Sort  = "IdProd";
                         $Param = "IdProd";
                         $Value = $Compra["IdPrd"];
                         
                         $Prods = ProductosController :: CtrGetProdCompras($Param, $Value, $Sort);

                         foreach ($Prods as $Prod)
                         {
                              
                              $Datos       = array("IdUsr" => $_SESSION["IdUsr"], "IdPrd" => $Prod["IdProd"] );
                              $Comentarios = UsuariosController :: CtrComentariosPerfil($Datos);

                              echo'<div class="col-12">
                                        <div class="card mb-2" style="max-width: 100%;">
                                             <div class="row no-gutters">
                                                  <div class="col-md-3">
                                                       <img src="'. PathSystem . $Prod["Imagen"] .'" class="img-thumbnail">
                                                  </div>
                                                  <div class="col-md-9">
                                                       <div class="card-body">
                                                            <div class="card-title">                                                            
                                                                 <h5 class="pull-right">';                                                                 
                                                                 if (is_array($Comentarios) && $Comentarios["Calificacion"] == 0 && $Comentarios["Comentario"] == "")
                                                                 {
                                                                      echo '<button type="button" class="btn btn-dark calificarProducto" idComentario="'.(is_array($Comentarios) ? $Comentarios["IdCmt"] : '').'" data-toggle="modal" data-target="#MdlComent"> Calificar </button>';
                                                                 }
                                                                 else
                                                                 {                                                                 
                                                                      if( is_array($Comentarios) )
                                                                      {
                                                                           switch($Comentarios["Calificacion"])
                                                                           {
                                                                                case 0.5:
                                                                                     echo '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 1.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 1.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 2.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 2.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 3.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 3.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 4.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 4.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
     
                                                                                case 5.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                           <i class="fa fa-commenting-o text-black" data-toggle="tooltip" data-placement="top" title="'. $Comentarios["Comentario"] .'"></i>';
                                                                                break;
                                                                           }
                                                                      }
                                                                 }
                              echo'                              </h5>
                                                                 <h3>'. $Prod["Nombre"] .'</h3>                                                                 
                                                            </div>
                                                            <div class="card-text">
                                                                 <h6 class="pull-right"> Comprado el '. date("d-m-Y", strtotime(substr($Compra["Fecha"],0,-8))) .' </h6>
                                                                 <h6>Proceso de entrega: 5 días hábiles</h6>';

                                                                 if($Compra["Envio"] == 0)
                                                                 {
                                                                      echo '<div class="progress" style="height: 35px">
                                                                                <div class="progress-bar bg-secondary" style="width: 33.33%"> <i class="fa fa-check"></i> Despachando </div>
                                                                                <div class="progress-bar bg-info" style="width: 33.33%"> <i class="fa fa-clock-o" aria-hidden="true"></i> Enviando </div>
                                                                                <div class="progress-bar bg-success" style="width: 33.33%"> <i class="fa fa-clock-o" aria-hidden="true"></i> Entregado </div>
                                                                           </div>';
                                                                 }

                                                                 if($Compra["Envio"] == 1)
                                                                 {
                                                                      echo '<div class="progress" style="height: 35px">
                                                                                <div class="progress-bar bg-secondary" style="width: 33.33%"> <i class="fa fa-check"></i> Despachando </div>
                                                                                <div class="progress-bar bg-info" style="width: 33.33%"> <i class="fa fa-check"></i> Enviando </div>
                                                                                <div class="progress-bar bg-success" style="width: 33.33%"> <i class="fa fa-clock-o" aria-hidden="true"></i> Entregado </div>
                                                                           </div>';
                                                                 }
                                                                 
                                                                 if($Compra["Envio"] == 2)
                                                                 {
                                                                      echo '<div class="progress" style="height: 35px">
                                                                                <div class="progress-bar bg-secondary" style="width:33.33%"> <i class="fa fa-check"></i> Despachando </div>
                                                                                <div class="progress-bar bg-info" style="width:33.33%"> <i class="fa fa-check"></i> Enviando </div>
                                                                                <div class="progress-bar bg-success" style="width:33.33%"> <i class="fa fa-check"></i> Entregado </div>
                                                                           </div>';
                                                                 }

                              
                              echo'                         </div>
                                                            <div style="height: 25px;"></div>
                                                            <div class="card-text">'. mb_strimwidth($Prod["Descripcion"], 0, 925, "...") .'</div>                                                            
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>';
                         }

                    }
               }

          ?>
          </div>

     </div>

     <!-- WishList -->
     <div id="nav-WhishList" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-WhishList-tab">
     <?php     
     
          $Item  = $_SESSION["IdUsr"];

          $Wishs = UsuariosController :: CtrMostrarDeseos($Item);
          
          foreach( $Wishs as $Wish )
          {

               echo '<div class="col-md-3 col-sm-6">
                         <div class="ProductGrid">
                              <div class="ProductImage">
                                   <a href="'. $Wish["Ruta"] .'"> <img class="pic-1" src="'. $Wish["Imagen"] .'"> </a>
                              </div>
                              <div class="ProductContent">
                                   <h3 class="Title"><a href="#">'. $Wish["Nombre"] .'</a></h3>
                                   <div class="Price"> $ '. number_format($Wish["Precio"], 2, '.', '') .' <span> $ '. number_format($Wish["Precio"], 2, '.', '') .' </span> </div>
                              </div>
                              <ul class="Social">
                                   <li> <a href="'. $Wish["Ruta"] .'" data-tip="Ver"> <i class="fa fa-search"></i> </a> </li>
                                   <li> <a href="" It="'. $Wish["IdWsh"] .'" data-tip="Quitar de WishList"> <i class="fa fa-trash-o"></i> </a> </li>
                                   <li> <a href="" It="'. $Wish["IdProd"] .'" data-tip="Agregar al Carrito"> <i class="fa fa-shopping-cart"></i> </a> </li>
                              </ul>
                         </div>
                    </div>';

          }

     ?>
     </div>

     <!-- Ofertas -->
     <div id="nav-Ofertas" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-Ofertas-tab"> Ofertas </div>

     <!-- Perfil -->
     <div id="nav-Perfil" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-Perfil-tab">

          <form method="post" enctype="multipart/form-data">

               <div class="row">
               
                    <div class="col-md-3 col-sm-4 col-xs-12 text-center">

                         <figure id="imgPerfil">
                         <?php
                         
                              echo '<input type="hidden" value="'. $_SESSION["IdUsr"] .'" id="IdUsr" name="IdUsr">
                                    <input type="hidden" value="'. $_SESSION["Modo"] .'" id="Modo" name="Modo">
                                    <input type="hidden" value="'. $_SESSION["Foto"] .'" id="Foto" name="Foto">
                                    <input type="hidden" value="'. $_SESSION["Pass"] .'" id="Pass" name="Pass">';
                         
                              
                              if( $_SESSION["Modo"] == "Directo" )
                              {
                                   echo '<img src="'. PathSystem .$_SESSION["Foto"].'" class="img-thumbnail ImgPrf">';
                              }
                              else
                              {
                                   echo '<img src="'. $_SESSION["Foto"] .'" class="img-thumbnail ImgPrf">';
                              }

                         ?>
                         </figure>

                         <div id="subirImagen">
                              <img class="previsualizar">
                              <input type="file" class="form-control" id="datosImagen" name="datosImagen">                                        
                         </div>

                         <?php

                              if( $_SESSION["Modo"] == "Directo" )
                              {
                                   echo '<button type="button" class="btn btn-block btn-dark" id="btnCambiarFoto"> Cambiar foto de perfil </button>';
                              }

                         ?>
                    
                    </div>
                         
                    <div class="col-md-9 col-sm-8 col-xs-12">
                    
                    <?php
     
                         if($_SESSION["Modo"] != "Directo")
                         {

                              echo'<div class="form-group">
                                        <label class="control-label text-muted" for="editarNombre">Cambiar Nombre:</label>
                                        <div class="input-group">
                                             <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-user"></span> </span> </div>
                                             <input type="text" class="form-control" id="EdtName" name="EdtName" placeholder="Nombre" value="'. $_SESSION["Name"] .'" readonly>
                                        </div>
                                   </div>

                                   <div class="form-group">
                                        <label class="control-label text-muted" for="editarEmail">Correo Electrónico:</label>
                                        <div class="input-group">
                                             <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-envelope"></span> </span> </div>
                                             <input type="correo" class="form-control" id="EdtMail" name="EdtMail" placeholder="Correo" value="'. $_SESSION["Mail"] .'" readonly>
                                        </div>
                                   </div>

                                   <div class="form-group">
                                   <label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
                                        <div class="input-group">
                                             <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-'. strtolower($_SESSION["Modo"]) .'"></i> </span> </div>
                                             <input type="text" class="form-control"  value="'. $_SESSION["Modo"] .'" readonly>
                                        </div>
                                   </div>
                                   
                                   <div style="height: 25px;"></div>
                                   
                                   <div class="row w-100 mx-1">
                                        <div class="col-6">
                                             
                                        </div>
                                        <div class="col-6">
                                             <button type="button" class="btn btn-block btn-danger" id="DelUsr">Eliminar cuenta</button>
                                        </div>
                                   </div>';
                                   
                         }
                         else
                         {
                              echo '<div class="form-group">
                                        <label class="control-label text-muted" for="editarNombre">Cambiar Nombre:</label>
                                        <div class="input-group">
                                             <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-user"></span> </span> </div>
                                             <input type="text" class="form-control" id="EdtName" name="EdtName" placeholder="Nombre" value="'. $_SESSION["Name"] .'">
                                        </div>
                                   </div>
                              
                                   <div class="form-group">
                                        <label class="control-label text-muted" for="editarEmail">Cambiar Correo Electrónico:</label>
                                        <div class="input-group">
                                             <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-envelope"></span> </span> </div>
                                             <input type="correo" class="form-control" id="EdtMail" name="EdtMail" placeholder="Correo" value="'. $_SESSION["Mail"] .'">
                                        </div>
                                   </div>

                                   <div class="form-group">
                                        <label class="control-label text-muted" for="editarEmail">Cambiar Contraseña:</label>
                                        <div class="input-group">                              
                                             <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-lock"></i> </span> </div>
                                             <input type="password" class="form-control" id="EdtPass" name="EdtPass" placeholder="Escribir Nueva Contraseña">
                                             <div class="input-group-append"> <span class="input-group-text fa fa-eye TogglePass" toggle="#EdtPass"></div>                              
                                        </div>
                                   </div>
                                   
                                   <div style="height: 25px;"></div>
                                   
                                   <div class="row w-100 mx-1">
                                        <div class="col-6">
                                             <button type="button" class="btn btn-block btn-danger" id="DelUsr">Eliminar cuenta</button>
                                        </div>
                                        <div class="col-6">
                                             <button type="submit" class="btn btn-block btn-dark"> Actualizar Datos </button>
                                        </div>
                                   </div>';

                         }

                         $UpdPerfil  = new UsuariosController();
                         $UpdPerfil -> CtrUpdPerfil();

                         $DelPerfil  = new UsuariosController();
                         $DelPerfil -> CtrEliminarUsuario();
     
                    ?>

                    </div>
               
               </div>

          </form>

     </div>

</div>

<div class="modal" id="MdlComent">
     <div class="modal-dialog">
          <div class="modal-content">
               <!-- Modal Header -->
               <div class="modal-header">
                    <h4 class="modal-title"> Calificar Producto </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
      
               <!-- Modal body -->
               <div class="modal-body">
                    <form method="post" onsubmit="return validarComentario()">

                         <input type="hidden" value="" id="idComentario" name="idComentario">

                         <h1 class="text-center" id="estrellas">
                              <i class="fa fa-star text-success"></i>
                              <i class="fa fa-star text-success"></i>
                              <i class="fa fa-star text-success"></i>
                              <i class="fa fa-star text-success"></i>
                              <i class="fa fa-star text-success"></i>
                         </h1>

                         <div class="form-group text-center">
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="0.5">0.5</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="1.0">1.0</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="1.5">1.5</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="2.0">2.0</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="2.5">2.5</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="3.0">3.0</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="3.5">3.5</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="4.0">4.0</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="4.5">4.5</label> &nbsp;
                              <label class="radio-inline"><input type="radio" name="Puntaje" value="5.0" checked>5.0</label>
                         </div>

                         <div class="form-group">
                              <label for="comment" class="text-muted">Opinión acerca de este producto: <span><small>(máximo 300 caracteres)</small></span></label>
                              <textarea class="form-control" rows="5" id="comentario" name="comentario" maxlength="300" required></textarea>
                              <br>
                              <input type="submit" class="btn btn-dark btn-block" value=" Calificar ">
                         </div>

                         <?php

                              $actualizarComentario  = new UsuariosController();
                              $actualizarComentario -> ctrActualizarComentario();

                         ?>

                    </form>
               </div>
      
               <!-- Modal footer -->
               <div class="modal-footer">                    
               </div>
          </div>
     </div>
</div>