<div class="row my-4">
     
     <div class="col-12">
          <ol class="breadcrumb shadow-lg bg-white">
               <li class="breadcrumb-item"> <a href="<?php echo(PathSystem); ?>" class="pr-md-3 pl-md-2 pr-2 pl-1 "> <i class="fa fa-home" aria-hidden="true"></i> Inicio </a></li>
               <li class="breadcrumb-item"> <a href="#" class="px-md-3 px-1 active-1"> Buscar: <?= str_replace("-"," ", $Path[1]); ?> </a> </li>
          </ol>
     </div>

</div>
          
<div class="row mx-1">
<?php

     $Limit     = 12;
     $Param     = isset($Path[1]) ? $Path[1] : "";
     $Page      = isset($Path[2]) && is_numeric($Path[2]) ? $Path[2] : 1;
     $StartFrom = ($Page - 1) * $Limit;


     $TotProds  = ProductosController :: CtrTotSearch($Param);
     $Productos = ProductosController :: CtrProdSearch($Param, $StartFrom, $Limit);

     $TotPages   = count($TotProds);

     foreach( $Productos as $Producto)
     {

          echo '<div class="col-md-3 col-sm-6">
                    <div class="ProductGrid">
                         <div class="ProductImage">
                              <a href="'. PathSystem.$Producto["Ruta"] .'"> <img class="pic-1" src="'. PathSystem.$Producto["Imagen"] .'"> </a>
                         </div>
                         <div class="ProductContent">
                              <h3 class="Title"><a href="#">'. $Producto["Nombre"] .'</a></h3>
                              <div class="Price"> $ '. number_format($Producto["Precio"], 2, '.', '') .' <span> $ '. number_format($Producto["Precio"], 2, '.', '') .' </span> </div>
                         </div>
                         <ul class="Social">
                              <li> <a href="" data-tip="Ver"><i class="fa fa-search"></i></a></li>
                              <li> <a href="" It="'. $Producto["IdProd"] .'" data-tip="Agregar WishList"> <i class="fa fa-heart" aria-hidden="true"></i> </a> </li>
                                   <!-- <li> <a href="" It="'. $Producto["IdProd"] .'" data-tip="Agregar al Carrito"> <i class="fa fa-shopping-cart"></i> </a> </li> -->
                         </ul>
                    </div>
               </div>';

     }

?>
</div>

<div class="row my-4">
     <div class="col-12 mt-3">
     <?php

          if (ceil($TotPages / $Limit) > 0)
          {
               echo '<ul class="pagination justify-content-center">';
               
               if ( $Page > 1 )
               { echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ($Page - 1) .'"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </a> </li>'; }
               
               if ( $Page > 3 )
               {
                    echo '<li class="page-item"><a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/1">1</a></li>';
                    echo '<li class="page-item">...</li>';
               }

               if ( ($Page - 2) > 0 )
               { echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ($Page - 2) .'"> '. ($Page - 2) .' </a> </li>'; }

               if ( ($Page - 1) > 0 )
               { echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ($Page - 1) .'"> '. ($Page - 1) .' </a> </li>'; }

               echo '<li class="page-item active"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. $Page .'"> '. $Page .' </a> </li> ';

               if ( ($Page + 1) < (ceil($TotPages / $Limit) + 1) )
               { echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ($Page + 1) .'"> '. ($Page + 1) .' </a> </li>'; }
               
               if ( ($Page + 2) < (ceil($TotPages / $Limit) + 1) )
               { echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ($Page + 2) .'"> '. ($Page + 2) .' </a> </li> '; }

               if ( $Page < (ceil($TotPages / $Limit) - 2) )
               {
                    echo '<li class="page-item">...</li>';
                    echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ceil($TotPages / $Limit) .'"> '. ceil($TotPages / $Limit) .' </a> </li>';
               }

               if ( $Page < ceil($TotPages / $Limit) )
               { echo '<li class="page-item"> <a class="page-link" href="'. PathSystem.$Path[0]."/".$Param .'/'. ($Page + 1) .'"> <i class="fa fa-chevron-right" aria-hidden="true"></i> </a> </li>'; }

               echo '</ul>';
               
          }

     ?>
     </div>     
</div>

<div class="row Bottom d-flex justify-content-center">

     <div class="col-12 TitleSec"> <div> <h3> Servicio al Cliente </h3> </div> </div>

     <div class="col-sm-6 col-lg-4">
          <div class="Ft"> <a href="#" class="FtLink"> Cómo ordenar </a> </div>
     </div>

     <div class="col-sm-6 col-lg-4">
          <div class="Ft"> <a href="#" class="FtLink"> Rastreo de órdenes </a> </div>
     </div>

     <div class="col-sm-6 col-lg-4 my-3">
          <div class="Ft"> <a href="#" class="FtLink"> Cambios y devoluciones </a> </div>
     </div>

     <div class="col-12 d-flex justify-content-center"> <h4> INFORMACIÓN </h4> </div>

     <div class="col-sm-6 col-lg-3">
          <div class="Ft"> <a href="#" class="FtLink"> ¿Quiénes somos? </a> </div>
     </div>
     <div class="col-sm-6 col-lg-3">
          <div class="Ft"> <a href="#" class="FtLink"> Bandas sinfónicas y educación </a> </div>
     </div>
     <div class="col-sm-6 col-lg-3">
          <div class="Ft"> <a href="#" class="FtLink"> Políticas de envío </a ></div>
     </div>
     <div class="col-sm-6 col-lg-3">
          <div class="Ft"> <a href="#" class="FtLink"> Términos y condiciones </a> </div>
     </div>

</div>