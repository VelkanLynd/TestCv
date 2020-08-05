<div class="row Slider">
               
     <div class="col-md-12">
          
          <div id="Slider" class="carousel slide" data-ride="carousel">
               
               <!-- <ul class="carousel-indicators">
                    <li data-target="#Slider" data-slide-to="0" class="active"></li>
                    <li data-target="#Slider" data-slide-to="1"></li>
                    <li data-target="#Slider" data-slide-to="2"></li>
               </ul> -->
               
               <div class="carousel-inner">
                    <div class="carousel-item active">
                         <img src="Public/Img/02.jpg" alt="">                         
                    </div>
                    <div class="carousel-item">
                         <img src="Public/Img/02.jpg" alt="">
                    </div>
                    <div class="carousel-item">
                         <img src="Public/Img/02.jpg" alt="">
                    </div>
               </div>
               
               <!-- <a href="#Slider" class="carousel-control-prev" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> </a>
               <a href="#Slider" class="carousel-control-next" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> </a> -->
          
          </div>
     </div>

</div>

<div class="row my-4">
     <div class="col-6 col-sm-4 col-lg-2 my-1">
          <div class="card">
               <a href="<?= PathSystem .'SubCat/Saxofones' ?>">
               <img class="card-img-top" src="Public/Img/Btn01.jpg" alt="Saxofones">
               <div class="card-body"> <p class="CardLink card-text text-center"> Saxofones </p> </div>
               </a>
          </div>
     </div>
     <div class="col-6 col-sm-4 col-lg-2 my-1">
          <div class="card">
               <a href="<?= PathSystem .'SubCat/Clarinetes' ?>">
               <img class="card-img-top" src="Public/Img/Btn02.jpg" alt="Clarinetes">
               <div class="card-body"> <p class="CardLink card-text text-center"> Clarinetes </p> </div>
               </a>
          </div>
     </div>
     <div class="col-6 col-sm-4 col-lg-2 my-1">
          <div class="card">
               <a href="<?= PathSystem .'SubCat/Trompetas' ?>">
               <img class="card-img-top" src="Public/Img/Btn03.jpg" alt="Trompetas">
               <div class="card-body"> <p class="CardLink card-text text-center"> Trompetas </p> </div>
               </a>
          </div>
     </div>
     <div class="col-6 col-sm-4 col-lg-2 my-1">
          <div class="card">
               <a href="<?= PathSystem .'SubCat/Trombones' ?>">
               <img class="card-img-top" src="Public/Img/Btn04.jpg" alt="Trombones">
               <div class="card-body"> <p class="CardLink card-text text-center"> Trombones </p> </div>
               </a>
          </div>
     </div>
     <div class="col-6 col-sm-4 col-lg-2 my-1">
          <div class="card">
               <a href="<?= PathSystem .'SubCat/Flautas' ?>">
               <img class="card-img-top" src="Public/Img/Btn05.jpg" alt="Flautas">
               <div class="card-body"> <p class="CardLink card-text text-center"> Flautas </p> </div>
               </a>
          </div>
     </div>
     <div class="col-6 col-sm-4 col-lg-2 my-1">
          <div class="card">
               <a href="<?= PathSystem .'SubCat/Cañas-Dobles' ?>">
               <img class="card-img-top" src="Public/Img/Btn06.jpg" alt="Cañas Dobles">
               <div class="card-body"> <p class="CardLink card-text text-center"> Cañas Dobles </p> </div>
               </a>
          </div>
     </div>
</div>

<div class="row Novedades">
     
     <div class="col-12 TitleSec"> <div> <h3> Novedades </h3> </div> </div>

     <?php

          $ProdsNov = ProductosController :: CtrProdsNov();
          
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
                                   <li> <a href="'. $ProdNov["Ruta"] .'" data-tip="Ver"> <i class="fa fa-search"></i> </a> </li>
                                   <li> <a href="" It="'. $ProdNov["IdProd"] .'" data-tip="Agregar WishList"> <i class="fa fa-heart" aria-hidden="true"></i> </a> </li>
                                   <!-- <li> <a href="" It="'. $ProdNov["IdProd"] .'" data-tip="Agregar al Carrito"> <i class="fa fa-shopping-cart"></i> </a> </li> -->
                              </ul>
                         </div>
                    </div>';

          }

     ?>

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
                                   <li> <a href="'. $ProdNov["Ruta"] .'" data-tip="Ver"> <i class="fa fa-search"></i> </a> </li>
                                   <li> <a href="" It="'. $ProdNov["IdProd"] .'" data-tip="Agregar WishList"> <i class="fa fa-heart" aria-hidden="true"></i> </a> </li>
                                   <!-- <li> <a href="" It="'. $ProdNov["IdProd"] .'" data-tip="Agregar al Carrito"> <i class="fa fa-shopping-cart"></i> </a> </li> -->
                              </ul>
                         </div>
                    </div>';

          }

     ?>
     
</div>

<div class="row Marcas">

     <div class="col-12 TitleSec"> <div> <h3> Marcas </h3> </div> </div>

     <div class="col-6 col-md-3 my-3 d-flex justify-content-center">
          <img alt="Bootstrap Image Preview" src="Public/Img/Vandoren.png" class="img-fluid">
     </div>
     <div class="col-6 col-md-3 my-3 d-flex justify-content-center">
          <img alt="Bootstrap Image Preview" src="Public/Img/Bam.png" class="img-fluid">
     </div>
     <div class="col-6 col-md-3 my-3 d-flex justify-content-center">
          <img alt="Bootstrap Image Preview" src="Public/Img/Yamaha.png" class="img-fluid">
     </div>
     <div class="col-6 col-md-3 my-3 d-flex justify-content-center">
          <img alt="Bootstrap Image Preview" src="Public/Img/Cora.png" class="img-fluid">
     </div>
</div>

<div class="row Bottom">

     <div class="col-12 TitleSec"> <div> <h3> </h3> </div> </div>

     <div class="col-sm-6 col-lg-3">
          <div class="InfoCard card card-cascade narrower">
               
               <!-- Card content -->
               <div class="NS card-body card-body-cascade">
                    <div class="NewsL">
                         <h2> NEWSLETTER </h2>                                   
                    </div>
                    
                    <form action="#">
                         <div class="input-group mb-2">                                   
                              <div class="input-group-prepend">
                                   <span class="input-group-text"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                              </div>
                              <input type="text" class="form-control" placeholder="Nombre">
                         </div>                                  
                         <div class="input-group mb-2">                                   
                              <div class="input-group-prepend">
                                   <span class="input-group-text"> <i class="fa fa-at"></i> </span>
                              </div>
                              <input type="text" class="form-control" placeholder="Correo">
                         </div>
                         <div class="form-check">
                              <input type="checkbox" id="ChkTrm" class="form-check-input">
                              <label for="ChkTrm" class="form-check-label">He leído la política de privacidad y autorizo el tratamiento de mis datos.</label>
                              <span></span>
                         </div>
                         <div class="form-group text-center">
                              <button type="submit" class="btn btn-sm btn-outline-dark"> <i class="fa fa-paper-plane"></i> Enviar </button>                              
                              </div>
                    </form>

               </div>

          </div>
     </div>

     <div class="col-sm-6 col-lg-3">
          <div class="InfoCard card card-cascade narrower">

               <!-- Card content -->
               <div class="card-body card-body-cascade">
                    <!-- Title -->
                    <h4 class="card-title"> SERVICIO AL CLIENTE </h4>
                    <!-- Text -->
                    <p class="card-text">
                         <div class="Ft"> <a href="#" class="FtLink"> Cómo ordenar </a> </div>
                         <div class="Ft"> <a href="#" class="FtLink"> Rastreo de órdenes </a> </div>
                         <div class="Ft"> <a href="#" class="FtLink"> Cambios y devoluciones </a> </div>
                    </p>
               </div>

          </div>
     </div>

     <div class="col-sm-6 col-lg-3">
          <div class="InfoCard card card-cascade narrower">

               <!-- Card content -->
               <div class="card-body card-body-cascade">
                    <!-- Title -->
                    <h4 class="card-title"> INFORMACIÓN </h4>
                    <!-- Text -->
                    <p class="card-text">
                         <div class="Ft"> <a href="#" class="FtLink"> ¿Quiénes somos? </a> </div>
                         <div class="Ft"> <a href="#" class="FtLink"> Bandas sinfónicas y educación </a> </div>
                         <div class="Ft"> <a href="#" class="FtLink"> Políticas de envío </a ></div>
                         <div class="Ft"> <a href="#" class="FtLink"> Términos y condiciones </a> </div>
                    </p>
               </div>

          </div>
     </div>

     <div class="col-sm-6 col-lg-3">
          <div class="InfoCard card card-cascade narrower">

               <!-- Card content -->
               <div class="card-body card-body-cascade">
                    <!-- Title -->
                    <h4 class="card-title"> MÉTODOS DE PAGO </h4>
                    <!-- Text -->
                    <p class="card-text">
                         <div class="FtPay"> MasterCard, Visa, Carnet </div>
                         <div class="FtPay"> American Express, Walmart </div>
                         <div class="FtPay"> 7 Eleven, Sams Club </div>
                         <div class="FtPay"> Farmacias del Ahorro </div>
                         <div class="FtPay"> Superama, Bodega Aurrera </div>
                         <div class="FtPay"> Farmacia Guadalajara </div>
                         <div class="FtPay"> Extra </div>
                    </p>
               </div>

          </div>
     </div>
</div>