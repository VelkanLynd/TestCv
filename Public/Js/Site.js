var SystemPath = $("#rutaOculta").val();

$(function ()
{
	$('[data-toggle="tooltip"]').tooltip()
})

/* ----- Ruta Actual ----- */
var rutaActual = location.href;

$(".BtnIngreso, .Facebook, .Google").click(function()
{
	localStorage.setItem("rutaActual", rutaActual);	
})


/* ----- Enviar formulario con Enter ----- */
$("#LgnMail, #LgnPass").keydown(function(event)
{
	
	var Key = (event.keyCode ? event.keyCode : event.which);

	if( Key === 13 )
	{
		if ( $("#LgnMail").val().length > 0 && $("#LgnPass").val().length > 0 )
		{
			localStorage.setItem("rutaActual", rutaActual);
    		$('#FrmLgn').submit();    		
		}
		
	}

});

/* ----- Enviar formulario con Enter ----- */
$("#RegName, #RegMail, #RegPass").keydown(function(event)
{
	
	var Key = (event.keyCode ? event.keyCode : event.which);

	if( Key === 13 )
	{
		if ( $("#RegName").val().length > 0 && $("#RegMail").val().length > 0 && $("#RegPass").val().length > 0 )
		{
			localStorage.setItem("rutaActual", rutaActual);
    		$('#FrmReg').submit();
		}
		
	}

});

$(".TogglePass").click(function()
{
	$(this).toggleClass("fa-eye fa-eye-slash");
	
	var input = $($(this).attr("toggle"));
	
	if (input.attr("type") == "password")
	{
		input.attr("type", "text");
	}
	else
	{
		input.attr("type", "password");
	}
});


/* ----- Validar Email Repetido ----- */
var validarEmailRepetido = false;

$("#RegMail").change(function()
{
	
	var email = $("#RegMail").val();
	var datos = new FormData();

	datos.append("ValidarEmail", email);

	$.ajax(
	{

		url        : SystemPath + "Ajax/UsersAjax.php",
		method     : "POST",
		data       : datos,
		cache      : false,
		contentType: false,
		processData: false,
		success    : function(respuesta)
				   {
					   if(respuesta == "false")
					   {
						   $(".alert").remove();
						   validarEmailRepetido = false;
					   }
					   else
					   {
						   var modo = JSON.parse(respuesta).Modo;
				
						   if(modo == "Directo")
						   {
							   modo = "nuestra página";
						   }
				
						   $("#RegMail").parent().after('<div class="alert alert-warning"> <strong> Error: </strong> El correo electrónico ya existe en la base de datos, fue registrado a través de ' + modo + ', por favor ingrese otro diferente </div>')

						   validarEmailRepetido = true;
					   }
				   }

	})

})


/* ----- Registrar Usuario ----- */
function RegUser()
{
	var Name = $("#RegName").val();
	var Mail = $("#RegMail").val();
	var Pass = $("#RegPass").val();
	// var Pols = $("#ChkPriv:checked").val();
     
     
	if( Name != "" )
	{
		var expresion = /^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]*$/;
	
		if(!expresion.test(Name))
		{
			$("#RegName").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')
		
			return false;
		}
	}
	else
	{
		$("#RegName").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
		
		return false;
	}

	if( Mail != "" )
	{
	
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		
		if(!expresion.test(Mail))
		{
			$("#RegMail").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>')
			
			return false;
		}
		
	 	if(validarEmailRepetido)
	 	{
			 $("#RegMail").parent().after('<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>')
			 
	 		return false;
		}
	
	}
	else
	{
	
		$("#RegMail").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
		
		return false;
	}

	if( Pass != "" )
	{
		
		var expresion = /^[a-zA-Z0-9]*$/;
		
		if(!expresion.test(Pass))
		{
			$("#RegPass").parent().after('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')
			
			return false;
		}
	
	}
	else
	{
		
		$("#RegPass").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
		
		return false;
	}


	// if( politicas != "on" )
	// {
	// 	$("#ChkPriv").parent().after('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>')
		
	// 	return false;
	// }

	return true;

}

$("input").focus(function()
{
	$(".alert").remove();
})

/* ===== BOTÓN FACEBOOK ===== */
$(".Facebook").click(function()
{
	FB.login(function(response)
	{
		validarUsuario();
	}, {scope: 'public_profile, email'})
})

/* ===== VALIDAR EL INGRESO ===== */

function validarUsuario()
{
	FB.getLoginStatus(function(response)
	{
		statusChangeCallback(response);
	})
}

/* ===== VALIDAMOS EL CAMBIO DE ESTADO EN FACEBOOK ===== */
function statusChangeCallback(response)
{
	if(response.status === 'connected')
	{
		testApi();
	}
	else
	{
		swal(
		{
			title            : "¡ERROR!",
			text             : "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
			type             : "error",
			confirmButtonText: "Cerrar",
			closeOnConfirm   : false
		},
		function(isConfirm)
		{
			if (isConfirm)
			{
				window.location = localStorage.getItem("rutaActual");
			} 
		});
	}
}

/* ===== INGRESAMOS A LA API DE FACEBOOK ===== */
function testApi()
{
	FB.api('/me?fields=id,name,email,picture',function(response)
	{
		if(response.email == null)
		{
			swal(
			{
				title            : "¡ERROR!",
				text             : "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",
				type             : "error",
				confirmButtonText: "Cerrar",
				closeOnConfirm   : false
			},
			function(isConfirm)
			{
				if (isConfirm)
				{
					window.location = localStorage.getItem("rutaActual");
				}
			});
		}
		else
		{
			var email  = response.email;
			var nombre = response.name;
			var foto   = "http://graph.facebook.com/" + response.id + "/picture?type=large";
			var datos  = new FormData();
			
			datos.append("Mail", email);
			datos.append("Name",nombre);
			datos.append("Foto",foto);

			$.ajax(
			{
				url        : SystemPath + "Ajax/UsersAjax.php",
				method     : "POST",
				data       : datos,
				cache      : false,
				contentType: false,
				processData: false,
				success    : function(respuesta)
				{
					if(respuesta == "Ok")
					{
						window.location = localStorage.getItem("rutaActual");
					}
					else
					{
						swal(
						{
							title            : "¡ERROR!",
							text             : "¡El correo electrónico " + email + " ya está registrado con un método diferente a Facebook!",
							type             : "error",
							confirmButtonText: "Cerrar",
							closeOnConfirm   : false
						},
						function(isConfirm)
						{
							if (isConfirm)
							{
								FB.getLoginStatus(function(response)
								{
									if(response.status === 'connected')
									{
										FB.logout(function(response)
										{
											deleteCookie("fblo_2785389238361368");
											setTimeout(function()
											{
												window.location = "Salir";
											},500)
										});

										function deleteCookie(name)
										{
											document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
										}
									}
								})
							} 
						});
					}
				}
			})
		}
	})
}

/* ===== SALIR DE FACEBOOK ===== */
$(".Salir").click(function(e)
{
	e.preventDefault();
	
	FB.getLoginStatus(function(response)
	{
		if(response.status === 'connected')
		{
			FB.logout(function(response)
			{
				deleteCookie("fblo_2785389238361368");
				// console.log("salir");
				setTimeout(function() { window.location = SystemPath + "Salir"; },500)
			});
			
			function deleteCookie(name)
			{
				document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
			}
		}
	})
})

/* ===== CAMBIAR FOTO ===== */
$("#btnCambiarFoto").click(function()
{
	$("#imgPerfil").toggle();
	$("#subirImagen").toggle();

})

$("#datosImagen").change(function()
{
	var imagen = this.files[0];

	/* ===== FORMATO DE LA IMAGEN ===== */	
	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
	{
		$("#datosImagen").val("");
		
		swal(
		{
			title            : "Error al subir la imagen",
			text             : "¡La imagen debe estar en formato JPG o PNG!",
			type             : "error",
			confirmButtonText: "¡Cerrar!",
			closeOnConfirm   : false
		},
		function(isConfirm)
		{
			if (isConfirm)
			{ window.location = "Perfil"; }
		});
	}
	else if(Number(imagen["size"]) > 2097152)
	{
		$("#datosImagen").val("");
		
		swal(
		{
			title            : "Error al subir la imagen",
			text             : "¡La imagen no debe pesar más de 2 MB!",
			type             : "error",
			confirmButtonText: "¡Cerrar!",
			closeOnConfirm   : false
		},
		function(isConfirm)
		{
			if (isConfirm)
			{ window.location = "Perfil"; }
		});
	}
	else
	{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		
		$(datosImagen).on("load", function(event)
		{
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src",  rutaImagen);
		})
	}

})

/* ===== COMENTARIOS ID ===== */
$(".calificarProducto").click(function()
{
	var idComentario = $(this).attr("idComentario");
	
	$("#idComentario").val(idComentario);

})

/* ===== COMENTARIOS CAMBIO DE ESTRELLAS ===== */
$("input[name='Puntaje']").change(function()
{
	
	var puntaje = $(this).val();
	
	switch(puntaje)
	{

		case "0.5":
		$("#estrellas").html('<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "1.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "1.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "2.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "2.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "3.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "3.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "4.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-o text-success" aria-hidden="true"></i>');
		break;

		case "4.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>');
		break;

		case "5.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i> '+
						 '<i class="fa fa-star text-success" aria-hidden="true"></i>');
		break;

	}

})

/* ===== VALIDAR EL COMENTARIO ===== */
function validarComentario()
{

	var comentario = $("#comentario").val();

	if(comentario != "")
	{
		var expresion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;

		if(!expresion.test(comentario))
		{
			$("#comentario").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> No se permiten caracteres especiales como por ejemplo !$%&/?¡¿[]*</div>');

			return false;
		}
	
	}
	else
	{
		$("#comentario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Campo obligatorio</div>');
		
		return false;
	}

	return true;

}

/* ===== Agregar a Lista de Deseos ===== */
$('a[data-tip="Agregar WishList"]').click(function(e)
{

	e.preventDefault();

	var idProducto = $(this).attr("It");
	var idUsuario  = localStorage.getItem("Usr");
	var rutaOculta = window.location.href;

	if(idUsuario == null)
	{
		swal(
		{
			title            : "Debe ingresar al sistema",
			text             : "¡Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema!",
			type             : "warning",
			confirmButtonText: "¡Cerrar!",
			closeOnConfirm   : false
		}, function(isConfirm) { if (isConfirm) { window.location = rutaOculta; } });
	}
	else
	{
		// $(this).addClass("btn-danger");
		
		var datos = new FormData();
		datos.append("idUsuario", idUsuario);
		datos.append("idProducto", idProducto);

		$.ajax(
		{
			url        : SystemPath + "Ajax/UsersAjax.php",
			method     : "POST",
			data       : datos,
			cache      : false,
			contentType: false,
			processData: false,
			success:function(respuesta){}

		})

	}

})

/* ===== Eliminar de Lista de Deseos ===== */
$('a[data-tip="Quitar de WishList"]').click(function(e)
{

	e.preventDefault();

	var IdWish = $(this).attr("It");

	$(this).parent().parent().parent().remove();

	var datos = new FormData();
	datos.append("IdWish", IdWish);
		
	$.ajax(
	{
		url        : SystemPath + "Ajax/UsersAjax.php",
		method     : "POST",
		data       : datos,
		cache      : false,
		contentType: false,
		processData: false,
		success:function(respuesta){}
	});

})

/* ===== Eliminar Usuario ===== */
$("#DelUsr").click(function()
{
	
	var IdUsr = $("#IdUsr").val();
	
	if($("#Modo").val() == "Directo")
	{
		if($("#Foto").val() != "")
		{
			var Foto = $("#Foto").val();
		}
	}

	swal(
	{
		title             : "¿Está usted seguro(a) de eliminar su cuenta?",
		text              : "¡Si borra esta cuenta ya no se puede recuperar los datos!",
		type              : "warning",
		showCancelButton  : true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText : "¡Si, borrar cuenta!",
		closeOnConfirm    : false
	}, function(isConfirm) { if (isConfirm) { window.location = "index.php?Path=Perfil&Id=" + IdUsr + "&Foto=" + Foto; } });

})




/* =========================== */
/* ===== Sección Carrito ===== */
/* =========================== */
if( localStorage.getItem("CartDtl") != null )
{
	$("#CntPrd").html(localStorage.getItem("CartDtl"));
}
else
{
	$("#CntPrd").html("0 - $ 0.00");
}

/* ===== Cargar carrito ===== */
if(localStorage.getItem("CartList") != null)
{
	var CartList = JSON.parse(localStorage.getItem("CartList"));
	var SumaSubT = 0;

	CartList.forEach(funcionForEach);

	function funcionForEach(Item, Index)
	{
		$("#CartBdy").append(
			'<div class="row d-flex my-2">' +
			'     <div class="col-sm-1 col-xs-12"> <div style="height: 20px;"></div> <button It="' + Item.IdProd + '" class="btn btn-default btn-outline-danger DelCart"> <i class="fa fa-times"></i> </button> </div>' +
			'     <div class="col-sm-1 col-xs-12"> <figure> <img src="' + SystemPath + Item.Imagen + '" class="img-thumbnail"> </figure> </div>' +
			'     <div class="col-sm-5 col-xs-12 align-self-center"> <p class="CartPrd text-left">' + Item.Nombre + '</p> </div>' +
			'     <div class="col-md-2 col-sm-1 col-xs-12 align-self-center text-center"> <p class="CartPrc text-center"> $ ' + Item.Precio + ' </p> </div>' +
			'     <div class="col-md-1 col-sm-3 col-xs-8"> <div style="height: 20px;"></div> <input type="number" class="form-control CartCnt" min="1" It="' + Index + '" Pr="' + Item.Precio + '" Ps="' + Item.Peso + '" value="' + Item.Cantidad + '"> </div>' +
			'     <div class="col-md-2 col-sm-1 col-xs-4 align-self-center text-center"> <p class="CartStl subTotal' + Index + '"> $ ' + Number(Item.Cantidad * Number(Item.Precio)).toFixed(2) + ' </p> </div>' +
			'</div>'
		);

		SumaSubT += Number(Item.Cantidad * Number(Item.Precio)).toFixed(2)
	}

	$(".SumaSubTotal").html("<strong>$ <span>" + Number(SumaSubT).toFixed(2) + "</span> </strong>");
}
else
{
	$("#CartBdy").html(' <div> <h3> Aún no hay productos en el carrito de compras. </h3> </div> ');
	$("#CartSum").hide();
}

/* ===== Agregar al carrito ===== */
$('a[data-tip="Agregar al Carrito"]').click(function(e)
{

	e.preventDefault();

	var IdPrd = $(this).attr("It");
	var Imgn  = $(this).attr("Ig");
	var Prod  = $(this).attr("Nm");
	var Cant  = $(".qty").val();
	var Prec  = $(this).attr("Pr");
	var Peso  = $(this).attr("Ps");
	var Model = "";

	if( $("#Modelo").val() != "")
	{
		Model = $("#Modelo").val();
	}

	if(localStorage.getItem("CartList") == null)
	{
		CartList = [];
	}
	else
	{

		var CartList = JSON.parse(localStorage.getItem("CartList"));

		for(var i = 0; i < CartList.length; i++)
		{
			// Despues agregar los modelos en la validación
			if( CartList[i]["IdProd"] == IdPrd )
			{
				swal(
				{
					title             : "El producto ya está en el carrito de compras",
					text              : "",
					type              : "warning",
					showCancelButton  : false,
					confirmButtonColor: "#DD6B55",
					confirmButtonText : "Aceptar",
					closeOnConfirm    : false
				})

				return;

			}

		}

		CartList.concat(localStorage.getItem("CartList"));
	}

	CartList.push({"IdProd" : IdPrd, "Nombre" : Prod, "Imagen" : Imgn, "Cantidad" : Cant, "Precio" : Prec, "Peso" : Peso});

	localStorage.setItem("CartList", JSON.stringify(CartList));
	
	var CartPrds = Number( Number($("#CntPrd").html().substring(0, $("#CntPrd").html().indexOf("-") - 1)) + Number(Cant));
	var CartSuma = Number($("#CntPrd").html().substring($("#CntPrd").html().indexOf("-") + 3, $("#CntPrd").html().length)) + (Number(Prec) * Number(Cant));
	
	$("#CntPrd").html(CartPrds + " - $ " + CartSuma);

	localStorage.setItem("CartDtl", CartPrds + " - $ " + CartSuma);
		
	swal(
	{
		title             : "",
		text              : "Se ha agregó al carrito de compras",
		type              : "success",
		showCancelButton  : true,
		confirmButtonColor: "#DD6B55",
		cancelButtonText  : "¡Continuar comprando!",
		confirmButtonText : "¡Ir a mi carrito de compras!",
		closeOnConfirm    : false
	}, function(isConfirm)
	{ if (isConfirm) { window.location = SystemPath + "Cart"; } });

})


/* ===== Quitar del carrito ===== */
$(document).on("click", ".DelCart", function()
{

	$(this).parent().parent().remove();

	var IdPrd = $("#CartBdy .DelCart");
	var Prod  = $("#CartBdy .CartPrd");
	var Imgn  = $("#CartBdy img");
	var Cant  = $("#CartBdy .CartCnt");
	var Prec  = $("#CartBdy .CartPrc");
	
	CartList = [];

	if(IdPrd.length > 0)
	{

		for(var Ind = 0; Ind < IdPrd.length; Ind++)
		{

			var ArrIdPrd = $(IdPrd[Ind]).attr("It");
			var ArrProd  = $(Prod[Ind]).html();
			var ArrImgn  = $(Imgn[Ind]).attr("src").replace(SystemPath, '');
			var ArrCant  = $(Cant[Ind]).val();
			var ArrPrec  = $(Prec[Ind]).html().replace(" $ ","");

			CartList.push({"IdProd" : ArrIdPrd, "Nombre" : ArrProd, "Imagen" : ArrImgn, "Cantidad" : ArrCant, "Precio" : ArrPrec});

		}
		
		localStorage.setItem("CartList", JSON.stringify(CartList));

		SumaSubTotales();

	}
	else
	{

		localStorage.removeItem("CartList");

		localStorage.setItem("CartDtl", "0 - $ 0.00");

		$("#CntPrd").html("0 - $ 0.00");

		$("#CartBdy").html(' <div> <h3> Aún no hay productos en el carrito de compras. </h3> </div> ');
		$("#CartSum").hide();

	}

})


/* ===== Actualizar subtotal al cambiar cantidad ===== */
$(document).on("change", ".CartCnt", function()
{

	var Cnt = $(this).val();
	var Prc = $(this).attr("Pr");
	var Itm = $(this).attr("It");

	$(".subTotal" + Itm).html('$ ' + (Cnt * Prc).toFixed(2) );

	var IdPrd = $("#CartBdy .DelCart");
	var Prod  = $("#CartBdy .CartPrd");
	var Imgn  = $("#CartBdy img");
	var Cant  = $("#CartBdy .CartCnt");
	var Prec  = $("#CartBdy .CartPrc");
	
	CartList = [];
	
	for(var Ind = 0; Ind < IdPrd.length; Ind++)
	{

		var ArrIdPrd = $(IdPrd[Ind]).attr("It");
		var ArrProd  = $(Prod[Ind]).html();
		var ArrImgn  = $(Imgn[Ind]).attr("src").replace(SystemPath, '');
		var ArrCant  = $(Cant[Ind]).val();
		var ArrPrec  = $(Prec[Ind]).html().replace(" $ ","");

		CartList.push({"IdProd" : ArrIdPrd, "Nombre" : ArrProd, "Imagen" : ArrImgn, "Cantidad" : ArrCant, "Precio" : ArrPrec});

	}
	
	localStorage.setItem("CartList", JSON.stringify(CartList));

	SumaSubTotales();

})


/* ===== Suma Subtotales ===== */
function SumaSubTotales()
{

	var SubTotales = $(".CartStl");
	var ArrSubTot  = [];
	var SumaSubTot = 0;

	for(var i = 0; i < SubTotales.length; i++)
	{
		ArrSubTot.push( Number($(SubTotales[i]).html().substring(2, $(SubTotales[i]).html().length)) );
	}

	ArrSubTot.forEach(function(Numero)
	{
        SumaSubTot += Numero;
    });

    $(".SumaSubTotal").html("<strong>$ <span>" + SumaSubTot.toFixed(2) + "</span> </strong>");

    var Cants   = $(".CartCnt");
    var ArrCant = [];
    var SumCant = 0;

    for(var i = 0; i < Cants.length; i++)
	{
		ArrCant.push( Number($(Cants[i]).val()) );
	}

	ArrCant.forEach(function(Numero)
	{
        SumCant += Numero;
    });
	
	$("#CntPrd").html(SumCant + " - $ " + SumaSubTot.toFixed(2));
    localStorage.setItem("CartDtl", SumCant + " - $ " + SumaSubTot.toFixed(2));    

}




/* ============================ */
/* ===== Sección Checkout ===== */
/* ============================ */
$("#BtnCheckOut").click(function()
{

	var IdUsr = $(this).attr("Iu");
	var IdPrd = $("#CartBdy .DelCart");
	
	
})