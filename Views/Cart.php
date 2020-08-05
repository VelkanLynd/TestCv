<div class="container">
     
     <div style="height: 30px;"></div>
     
     <div class="card text-center">
          
          <div class="card-header" id="CartHdr">
               <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-12 text-center"> <h4> <small> Producto </small> </h4> </div>
                    <div class="col-md-2 col-sm-1 col-xs-0 text-center"> <h4> <small> Precio </small> </h4> </div>
                    <div class="col-sm-1 col-xs-0 text-center"> <h4> <small> Cant </small> </h4> </div>
                    <div class="col-sm-2 col-xs-0 text-center"> <h4> <small> Subtotal </small> </h4> </div>
               </div>
          </div>
        
          <div class="card-body" id="CartBdy">
               <!-- <hr> -->
          </div>
        
          <div class="clearfix"></div>
        
          <div class="card-footer" id="CartSum">
               <div class="row mt-3">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                         <div class="row d-flex justify-content-around align-items-center">
                              <div class="col-xs-6"> <h4>Total:</h4> </div>
                              <div class="col-xs-6"> <h4 class="SumaSubTotal"> <strong>$ <span>21.00</span> </strong> </h4> </div>
                         </div>
                    </div>
               </div>
               <div class="row my-3" id="CartChk">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                    <?php

                         if( isset($_SESSION["ValSesion"]) )
                         {
                              if($_SESSION["ValSesion"] == "Ok")
                              {
                                   echo '<button id="BtnCheckOut" Iu="'. $_SESSION["IdUsr"] .'" data-toggle="modal" data-target="#MdlCheckOut" class="btn btn-default btn-dark btn-block pull-right"> Pagar </button>';
                              }
                         }
                         else
                         {
                              echo '<button id="BtnCheckOut" data-toggle="modal" data-target="#MdlLogin" class="btn btn-default btn-dark btn-block pull-right"> Pagar </button>';
                         }

                    ?>
                         
                    </div>
               </div>
          </div>
    
     </div>

</div>


<!-- Modal Checkout -->
<div id="MdlCheckOut" role="dialog" class="modal fade">
     <div class="modal-dialog" role="document">

          <div class="modal-content">

               <div class="modal-header">
                    <h3 class="modal-title w-100 text-center"> Realizar Pago </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
               </div>

               <div class="modal-body ChkCnt">
                    
                    <div class="row ChkEnv">
                         <div class="col-12">
                              <h4 class="text-muted w-100 text-center">Información de envío</h4>

                              <div class="form-group">
                                   <div class="input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-user"></span> </span> </div>
                                        <input type="text" class="form-control" id="ChkName" name="ChkName" placeholder="Nombre" required="required">
                                   </div>
                              </div>

                              <div class="form-group">
                                   <div class="input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-envelope"></span> </span> </div>
                                        <input type="correo" class="form-control" id="ChkMail" name="ChkMail" placeholder="Correo" required="required">
                                   </div>
                              </div>
                              
                              <!-- <div class="form-group">
                                   <div class="input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-plane"></span> </span> </div>
                                        <select class="custom-select" id="ChkEdo">
                                             <option selected>Estado...</option>
                                        </select>
                                   </div>
                              </div> -->

                              <div class="form-group">
                                   <div class="input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-map-marker"></span> </span> </div>
                                        <input type="text" class="form-control" id="ChkDir" name="ChkDir" placeholder="Dirección" required="required">
                                   </div>
                              </div>

                         </div>
                    </div>

                    <div class="or-seperator"><i></i></div>

                    <div class="row ChkPay">
                         <h4 class="text-muted w-100 text-center my-2">Forma de pago</h4>
                         <div class="col-1"> <input id="ChkPaypal" type="radio" name="Pago" value="paypal" checked> </div>
                         <div class="col-5"> <figure> <img src="<?= PathSystem ?>Public/Img/Paypal.png" class="img-thumbnail"> </figure> </div>
                         <div class="col-1"> <input id="ChkPayu" type="radio" name="Pago" value="payu"> </div>
                         <div class="col-5"> <figure> <img src="<?= PathSystem ?>Public/Img/Payu.png" class="img-thumbnail"> </figure> </div>
                    </div>

                    <div class="or-seperator"><i></i></div>

                    <div class="row">
                         <div class="col-12 col-sm-6 pull-right">
                              <h5 class="text-muted">Moneda</h5>
                              <div class="form-group">
                                   <div class="input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text"> <span class="fa fa-usd"></span> </span> </div>
                                        <select class="custom-select" id="Divisa">
                                        <option selected>MXN</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <div class="col-12 col-sm-6 pull-right">
                              <h5 class="text-muted">Detalle</h5>
                              <table class="table table-striped TblProds">
                                   <tbody>
                                        <tr>
                                             <td>Subtotal</td>
                                             <td><span class="cambioDivisa">MXN</span> $<span class="ChkSubtotal" valor="0">0</span></td>
                                        </tr>
                                        <tr>
                                             <td>Envío</td>	
									<td><span class="cambioDivisa">MXN</span> $<span class="ChkTotalEnvio" valor="0">0</span></td>	
                                        </tr>
                                        <tr>
									<td>Impuesto</td>	
									<td><span class="cambioDivisa">MXN</span> $<span class="ChkTotalImpuesto" valor="0">0</span></td>	
                                        </tr>
                                        <tr>
									<td><strong>Total</strong></td>	
									<td><strong><span class="cambioDivisa">MXN</span> $<span class="ChkTotalCompra" valor="0">0</span></strong></td>	
								</tr>

							</tbody>
                              </table>
                         </div>
                    </div>

               </div>

               <div class="modal-footer">
                    <button class="btn btn-default btn-dark btn-block"> Pagar </button>
               </div>

          </div>
          
     </div>
</div>