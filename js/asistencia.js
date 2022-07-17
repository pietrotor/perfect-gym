function cambiarsrc(id,src){
  var Imagen = document.getElementById(id);
  Imagen.src=src;
}
var imagne_default="imagenes/default-avatar.png"
$(document).ready(function(){
    $("#estado").hide();
    var screen = $('#loading-screen');
    configureLoadingScreen(screen);

    function showalert(message,alerttype) {

        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' +  alerttype + ' alert-dismissible fade show" role="alert"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
 
        setTimeout(function() { // cierra automaticamente el alert
 
 
          $("#alertdiv").remove();
 
        }, 3500);
      }
      let mesaje_alerta_sesiones='';
    $("#formAsistencia").submit(function(e){
        e.preventDefault();        
        carnet_identidad= $.trim($("#codigo_acceso").val());
        $.ajax({
            url:"bd/asistencia.php",
            type: "POST",
            dataType: "json",
            data:{carnet_identidad:carnet_identidad},
            success:function(data){
                if(data.error!==undefined){
                    $('#estado').html(''+data.error);
                    showalert(data.error,'alert-danger')
                    if(data.nombre!==undefined){$('#nombre').val(data.nombre)};
                    if(data.apellido!==undefined){$('#apellido').val(data.apellido)};
                    $('#fecha_in').val('');
                    $('#fecha_fin').val('');
                    $('#sesiones').val('');
                    $('#discipli').val('');
                    $('#codigo_acceso').val('');
                    if(data.foto!=='') cambiarsrc('foto-persona',data.foto)
                    else cambiarsrc('foto-persona',imagne_default)                    

                    return false;
                 } else {
                    $('#codigo_acceso').val('');                    
                    if(data.sesion!==undefined){$('#sesiones').val(data.sesion);if(data.sesion<=3){mesaje_alerta_sesiones='Solo quedan '+data.sesion+' sesiones, recuerda renovar tu membresia'}else{mesaje_alerta_sesiones='';}};
                    if(data.nombre!==undefined){$('#nombre').val(data.nombre)};
                    if(data.apellido!==undefined){$('#apellido').val(data.apellido)};
                    if(data.inicio!==undefined){$('#fecha_in').val(data.inicio)};
                    if(data.fin!==undefined){$('#fecha_fin').val(data.fin)};
                    if(data.clase!==undefined){$('#discipli').val(data.clase)};
                    if(data.foto!==''){cambiarsrc('foto-persona',data.foto)};
                    showalert('Bienvenido, ingrese por favor. '+mesaje_alerta_sesiones,'alert-success');

                    return true;
                 }
            }
          });


    });

});
function configureLoadingScreen(screen){
  $(document)
      .ajaxStart(function () {
          screen.fadeIn();
      })
      .ajaxStop(function () {
          screen.fadeOut();
      });
}