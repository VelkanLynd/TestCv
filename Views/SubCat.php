<?php

     $CatPrm = isset($Path[1]) ? $Path[1] : "";     
     $SubCat = CategoriasController :: CtrGetIdSubCat("SubCat1", "Ruta", $CatPrm);

          
     if( is_array($SubCat) )
     {
          
          $SubCatChk = CategoriasController :: CtrGetIdSubCat("SubCat2", "IdSubCat1", $SubCat["IdSubCat1"]);

          if( is_array($SubCatChk) )
          {
               $Tabla = "SubCat2";
               $Param = "IdSubCat1";
               $Value = $SubCat[$Param];
          }
              
     }
     else
     {
          $SubCat = CategoriasController :: CtrGetIdSubCat("SubCat2", "Ruta", $CatPrm);
          
          if( is_array($SubCat) )
          {
               $SubCatChk = CategoriasController :: CtrGetIdSubCat("SubCat3", "IdSubCat2", $SubCat["IdSubCat2"]);

               if( is_array($SubCatChk) )
               {
                    $Tabla = "SubCat3";
                    $Param = "IdSubCat2";
                    $Value = $SubCat[$Param];
               }

          }          

     }

          
     if( isset($Tabla) )
     {
          $SubCategorias = CategoriasController :: CtrGetSubCats($Tabla, $Param, $Value);
     }
     else
     {
          echo "Redirect " . $CatPrm;
          echo('<script> window.location = "'. PathSystem .'Productos/'. $CatPrm .'"; </script>');
     }
              
?>

<div class="row my-4">
     
     <div class="col-12">
          <ol class="breadcrumb shadow-lg bg-white">
               <li class="breadcrumb-item"> <a href="<?php echo(PathSystem); ?>" class="pr-md-3 pl-md-2 pr-2 pl-1 "> <i class="fa fa-home" aria-hidden="true"></i> Inicio </a></li>
               <li class="breadcrumb-item"> <a href="#" class="px-md-3 px-1 active-1"> <?= str_replace("-"," ", $CatPrm); ?> </a> </li>
          </ol>
     </div>

     <?php

          foreach($SubCategorias as $SubCat)
          {

               echo '<div class="col-6 col-sm-4 col-lg-3 my-1">
                         <div class="card">
                              <a href="'. PathSystem .'SubCat/'. $SubCat["Ruta"] .'">
                              <img class="card-img-top" src="'. PathSystem .'Public/Img/Btn01.jpg" alt="Saxofones">
                              <div class="card-body"> <p class="CardLink card-text text-center"> '. $SubCat["SubCategoria"] .' </p> </div>
                              </a>
                         </div>
                    </div>';

          }

     ?>

</div>