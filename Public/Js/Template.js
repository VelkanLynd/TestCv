/* Template */

$(function() { $('#main_navbar').bootnavbar(); })

$(document).ready(function()
{
     $(window).keydown(function(event)
     {
          if(event.keyCode == 13)
          {
               event.preventDefault();
               return false;
          }
     });
});


$("#Buscador a").click(function()
{
     
     if($("#Buscador input").val() == "")
     {
          $("#Buscador a").attr("href", "");
     }

})


$("#Buscador input").change(function()
{
     
     var busqueda  = $("#Buscador input").val();
	var expresion = /^[a-zA-Z0-9ñÑáéíóúüÁÉÍÓÚÜ ]*$/;

     if( !expresion.test(busqueda) )
     {
          $("#Buscador input").val("");
     }
     else
     {
          var evaluarBusqueda = busqueda.replace(/[áéíóúüÁÉÍÓÚÜ ]/g, "_");
          var rutaBuscador    = $("#Buscador a").attr("href");
          
          if($("#Buscador input").val() != "")
          {
               $("#Buscador a").attr("href", rutaBuscador + "/" + evaluarBusqueda);
          }
     }

})


$("#Buscador input").focus(function()
{
     
     $(document).keyup(function(event)
     {
          event.preventDefault();
          
          if(event.keyCode == 13 && $("#Buscador input").val() != "")
          {
               var rutaBuscador = $("#Buscador a").attr("href");
               
               window.location.href = rutaBuscador;
          }
     })

})