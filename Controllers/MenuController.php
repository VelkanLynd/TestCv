<?php

     class MenuController
     {
           
          public function ctrGetCategorias()
          {

               $Resp = MenuModel :: MdlGetCategorias();

               return $Resp;

          }

          static public function ctrGetSubCats1($IdCat)
          {

               $Resp = MenuModel :: MdlGetSubCats1($IdCat);

               return $Resp;

          }

          static public function ctrGetSubCats2($IdSubCat1)
          {

               $Resp = MenuModel :: MdlGetSubCats2($IdSubCat1);

               return $Resp;

          }

          static public function ctrGetSubCats3($IdSubCat2)
          {

               $Resp = MenuModel :: MdlGetSubCats3($IdSubCat2);

               return $Resp;

          }

     }