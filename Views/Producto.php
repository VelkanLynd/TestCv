<div class="row my-4">

     <div class="col-12">
          <ol class="breadcrumb shadow-lg bg-white">
               <li class="breadcrumb-item"> <a href="<?php echo(PathSystem); ?>" class="pr-md-3 pl-md-2 pr-2 pl-1 "> <i class="fa fa-home" aria-hidden="true"></i> Inicio </a></li>
               <li class="breadcrumb-item"> <a href="#" class="px-md-3 px-1 active-1"> Instrumentos Aliento Madera </a> </li>
          </ol>
     </div>
     
</div>

<div class="row">
     <?php

          $Item     = $Path[0];
          $Producto = ProductosController :: CtrInfoProducto("Ruta", $Item);
          // $Imagenes = json_decode($Producto["Imagen"], true);


          $Comentarios = ProductosController :: CtrGetComents("IdProd", $Producto["IdProd"]);
          $Promedio    = 0;
          $NumComs     = 0;

          if( is_array($Comentarios) && count($Comentarios) > 0 )
          {

               $Calif   = 0;
               $NumComs = count($Comentarios);

               foreach( $Comentarios as $Comentario )
               {
                    if( $Comentario["Calificacion"] != 0 )
                    {
                         $Calif += $Comentario["Calificacion"];
                    }
               }

               $Promedio = round($Calif / $NumComs, 1);

          }

     ?>
     <div class="col-md-6">
          
          <div id="slider" class="owl-carousel product-slider">
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax01.jpg"> </div>
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax02.jpg"> </div>
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax03.jpg"> </div>
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax04.jpg"> </div>
          </div>
          <div id="thumb" class="owl-carousel product-thumb">
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax01.jpg"> </div>
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax02.jpg"> </div>
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax03.jpg"> </div>
               <div class="item"> <img src="<?php echo(PathSystem); ?>Public/Img/Productos/Sax04.jpg"> </div>
          </div>

     </div>
     
     <div class="col-md-6">

          <div class="product-dtl mt-3">

               <div class="product-info">
                    <div class="product-name"> <?= $Producto["Nombre"] ?> </div>
                    <div class="reviews-counter">
                         <div>
                         <?php

                              if($Promedio >= 0 && $Promedio < 0.5)
                              {
                                   echo '<i class="fa fa-star-half-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 0.5 && $Promedio < 1)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 1 && $Promedio < 1.5)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-half-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 1.5 && $Promedio < 2)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 2 && $Promedio < 2.5)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-half-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 2.5 && $Promedio < 3)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 3 && $Promedio < 3.5)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-half-o text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 3.5 && $Promedio < 4)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-o text-success"></i>';
                              }
                              else if($Promedio >= 4 && $Promedio < 4.5)
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star-half-o text-success"></i>';
                              }
                              else
                              {
                                   echo '<i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>
                                         <i class="fa fa-star text-success"></i>';
                              }

                         ?>
                         </div>
                         <span><?= $NumComs ?> Opiniones</span>
                    </div>
                    <div class="product-price-discount"> <span>$ <?= $Producto["Precio"] ?></span> <!-- <span class="line-through">$ 39.00</span> --> </div>
               </div>
               
               <p> <?= $Producto["Descripcion"] ?> </p>

               <div class="row">
                    <div class="col-md-8">
                         <label for="Modelo"> Modelo </label>
                         <select id="Modelo" name="Modelo" class="form-control">
                              <option value=""></option>
                              <option value="S">S</option>
                              <option value="M">M</option>
                              <option value="L">L</option>
                              <option value="X">XL</option>
                         </select>
                    </div>
                    <div class="col-md-4">
                         <div class="product-count">
                              <label for="size">Cantidad</label>
                              <form action="#" class="display-flex">
                                   <div class="qtyminus"> - </div>
                                   <input type="text" name="Cantidad" value="1" class="qty">
                                   <div class="qtyplus"> + </div>
                              </form>
                         </div>
                    </div>
               </div>
          
               <a href="#" It="<?= $Producto["IdProd"] ?>" data-tip="Agregar WishList" class="round-black-btn"> Agregar a Lista de deseos </a>
               <a href="#" It="<?= $Producto["IdProd"] ?>" Nm="<?= $Producto["Nombre"] ?>" Ig="<?= $Producto["Imagen"] ?>" Pr="<?= $Producto["Precio"] ?>" Ps="<?= $Producto["Peso"] ?>" data-tip="Agregar al Carrito" class="round-black-btn"> Agregar a Carrito </a>
          </div>
     </div>
</div>

<div class="product-info-tabs">

     <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item"> <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true"> Descripción </a> </li>
          <li class="nav-item"> <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false"> Opiniones (<?= $NumComs ?>) </a> </li>
     </ul>

     <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab"> <?= $Producto["Descripcion"] ?> </div>

          <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
               
               <div class="row">

                    <div class="col-sm-12">

                         <div id="myCarousel" class="carousel slide" data-ride="carousel">                              
                              <?php

                                   if( is_array($Comentarios) && count($Comentarios) > 0 )
                                   {
                                        echo '<h2 class="Comm"> Comentarios </h2>
                                              <div class="carousel-inner">';
                                                                          
                                        echo '<div class="carousel-item active">
                                                  <div class="row">
                                        ';

                                        for($Indx = 0; $Indx < 2; $Indx++ )
                                        {
                                             echo'     <div class="col-sm-6">
                                                            <div class="testimonial">
                                                                 <p>'. $Comentarios[$Indx]["Comentario"] .'</p>
                                                            </div>
                                                            <div class="media">
                                                                 <img src="'. PathSystem . $Comentarios[$Indx]["Foto"] .'" class="mr-3" alt="">
                                                                 <div class="media-body">
                                                                      <div class="overview">
                                                                           <div class="name"> <b> '. $Comentarios[$Indx]["Nombre"] .' </b> </div>
                                                                           <div class="star-rating">
                                                                                <ul class="list-inline">';
                                                                                switch($Comentarios[$Indx]["Calificacion"])
                                                                                {
                                                                                     case 0.5:
                                                                                     echo '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 1.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 1.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 2.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 2.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 3.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 3.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 4.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 4.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 5.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                }
                                             echo '                             </ul>
                                                                           </div>
                                                                      </div>										
                                                                 </div>
                                                            </div>
                                                       </div>
                                             ';
                                        }
                                                       
                                        echo'     </div>
                                             </div>
                                        ';

                                        if( $NumComs > 2)
                                        {
                                             echo '<div class="carousel-item">
                                                       <div class="row">
                                        ';

                                        for($Ind = $Indx; $Ind < $NumComs; $Ind++ )
                                        {
                                             echo'     <div class="col-sm-6">
                                                            <div class="testimonial">
                                                                 <p> '. $Comentarios[$Ind]["Comentario"] .'</p>
                                                            </div>
                                                            <div class="media">
                                                                 <img src="'. PathSystem . $Comentarios[$Indx]["Foto"] .'" class="mr-3" alt="">
                                                                 <div class="media-body">
                                                                      <div class="overview">
                                                                           <div class="name"> <b>'. $Comentarios[$Indx]["Nombre"] .'</b> </div>                                                                      
                                                                           <div class="star-rating">
                                                                                <ul class="list-inline">';
                                                                                switch($Comentarios[$Indx]["Calificacion"])
                                                                                {
                                                                                     case 0.5:
                                                                                     echo '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 1.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 1.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 2.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 2.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 3.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 3.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 4.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 4.5:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star-half-o text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                     case 5.0:
                                                                                     echo '<i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>
                                                                                          <i class="fa fa-star text-success" aria-hidden="true"></i>';
                                                                                     break;
                                                  
                                                                                }
                                             echo '                             </ul>
                                                                           </div>
                                                                      </div>										
                                                                 </div>
                                                            </div>
                                                       </div>
                                             ';                                        
                                             if( ($Ind > 2) && (($Ind % 2) == 0) )
                                             {
                                                  echo '</div> </div> <div class="carousel-item"> <div class="row"> ';
                                             }
                                        }
                                                       
                                        echo'     </div>
                                             </div>
                                        ';
                                        }

                                        echo '</div>
                              
                                        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev"> <i class="fa fa-chevron-left"></i> </a>
                                        <a class="carousel-control-next" href="#myCarousel" data-slide="next"> <i class="fa fa-chevron-right"></i> </a>';
                                   
                                   }
                                                                     
                                   
                              ?>                              
                         </div>
                    </div>

               </div>

          </div>

     </div>

</div>

<div class="row Recomendaciones">
     
     <div class="col-12 TitleSec"> <div> <h3> Recomendaciones </h3> </div> </div>
     
     <?php

          $ProdsNov = ProductosController :: CtrProdsRec();
          
          foreach( $ProdsNov as $ProdNov)
          {

               echo '<div class="col-md-3 col-sm-6">
                         <div class="ProductGrid">
                              <div class="ProductImage">
                                   <a href="'. $ProdNov["Ruta"] .'"> <img class="pic-1" src="'. $ProdNov["Imagen"] .'"> </a>
                              </div>
                              <div class="ProductContent">
                                   <h3 class="Title"><a href="#">'. $ProdNov["Nombre"] .'</a></h3>
                                   <div class="Price"> $ '. number_format($ProdNov["Precio"], 2, '.', '') .' <span> $ '. number_format($ProdNov["Precio"], 2, '.', '') .' </span> </div>
                              </div>
                              <ul class="Social">
                                   <li> <a href="" data-tip="Ver"><i class="fa fa-search"></i></a></li>
                                   <li> <a href="" It="'. $ProdNov["IdProd"] .'" data-tip="Agregar WishList"> <i class="fa fa-heart" aria-hidden="true"></i> </a> </li>
                                   <!-- <li> <a href="" It="'. $ProdNov["IdProd"] .'" data-tip="Agregar al Carrito"> <i class="fa fa-shopping-cart"></i> </a> </li> -->
                              </ul>
                         </div>
                    </div>';

          }

     ?>

</div>

<div class="row Bottom d-flex justify-content-center">

     <div class="col-12 d-flex justify-content-center my-3"> <div> <h4> SERVICIO AL CLIENTE </h4> </div> </div>

     <div class="col-sm-6 col-lg-4">
          <div class="Ft"> <a href="#" class="FtLink"> Cómo ordenar </a> </div>
     </div>

     <div class="col-sm-6 col-lg-4">
          <div class="Ft"> <a href="#" class="FtLink"> Rastreo de órdenes </a> </div>
     </div>

     <div class="col-sm-6 col-lg-4">
          <div class="Ft"> <a href="#" class="FtLink"> Cambios y devoluciones </a> </div>
     </div>

     <div class="col-12 d-flex justify-content-center my-3"> <h4> INFORMACIÓN </h4> </div>

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