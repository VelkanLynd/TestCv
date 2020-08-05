<?php

     $UserVerified = false;
     $Param        = "MailCrypt";
     $Value        =  $Path[1];
     
     $Respuesta    = UsuariosController :: CtrGetUser($Param, $Value);

     if( $Value == $Respuesta["MailCrypt"] )
     {

          $Id    = $Respuesta["IdUsr"];
		$Item  = "Verificacion";
          $Valor = 0;          
          $Resp  = UsuariosController :: CtrUpdUser($Id, $Item, $Valor);
          
          if( $Resp == "Ok")
          {
               $UserVerified = true;
          }
     
     }

?>

<div class="container">
     <div class="row">
     
          <div class="col-xs-12 text-center verificar">
          <?php
          
               if( $UserVerified )
               {
                    echo '<h3>Gracias '. $Respuesta["Nombre"] .' </h3>
                          <h2> <small>¡Hemos verificado tu correo electrónico, ya puedes ingresar al sistema!</small> </h2>
                          <br>
                          <a href="#MdlLogin" data-toggle="modal"> <button class="btn btn-default BackColor btn-lg"> Ingresar </button> </a>';
               }
               else
               {
                    echo '<h3>Error</h3>
                          <h2><small>¡No se ha podido verificar el correo electrónico, vuelva a registrarse!</small></h2>
                          <br>
                          <a href="#MdlRegister" data-toggle="modal"> <button class="btn btn-default btn-lg"> Registrar </button></a>';
               }
               
          ?>
          </div>
          
     </div>
</div>