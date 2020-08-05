<?php

     class ProductosController
     {

          public static function CtrInfoProducto($Param, $Value)
          {

               $DetProd = ProductosModel :: MdlInfoProducto($Param, $Value);

               return $DetProd;

          }

          public static function CtrProdsNov()
          {

               $Prods = ProductosModel :: MdlProdsNov();

               return $Prods;

          }

          public static function CtrProdsRec()
          {

               $Prods = ProductosModel :: MdlProdsRec();

               return $Prods;

          }

          public static function CtrTotSearch($Param)
          {

               $Prods = ProductosModel :: MdlTotSearch($Param);

               return $Prods;

          }

          public static function CtrProdSearch($Param, $StartFrom, $Limit)
          {

               $Prods = ProductosModel :: CtrProdSearch($Param, $StartFrom, $Limit);

               return $Prods;

          }

          public static function CtrTotProds($IdCat, $IdSubCat1, $IdSubCat2, $IdSubCat3)
          {

               $Prods = ProductosModel :: MdlTotProds($IdCat, $IdSubCat1, $IdSubCat2, $IdSubCat3);

               return $Prods;

          }

          public static function CtrProductos($IdCat, $IdSubCat1, $IdSubCat2, $IdSubCat3, $StartFrom, $Limit)
          {

               $Prods = ProductosModel :: CtrProductos($IdCat, $IdSubCat1, $IdSubCat2, $IdSubCat3, $StartFrom, $Limit);

               return $Prods;

          }

          public static function CtrGetProdCompras($Param, $Value, $Sort)
          {

               $Prods = ProductosModel :: MdlGetProdCompras($Param, $Value, $Sort);

               return $Prods;

          }

          public static function CtrGetComents($Param, $Value)
          {

               $Coms = ProductosModel :: MdlGetComents($Param, $Value);

               return $Coms;

          }

     }