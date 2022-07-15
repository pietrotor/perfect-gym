function Registrar(){          

  var archivo = $("#seleccionararchivo").val();  
  if (archivo != ""){
    var extension = archivo.split('.').pop();
    var nombrearchivo = "logo"+"."+extension;
  
    var formData= new FormData();
    var foto = $("#seleccionararchivo")[0].files[0];  
    formData.append('f',foto);    
    formData.append('nombrearchivo',nombrearchivo);         
    $.ajax({
        url:'subir-logo.php',
        type:'post',
        data:formData,
        contentType:false,
        async:false,
        processData:false,
        success: function(respuesta){
            if(respuesta !=0){
                console.log('Se subio la imagen con exito');
            }
        }
    });
  }
  else{
    nombrearchivo="";
  }
  return nombrearchivo;
}

$(document).ready(function(){
  var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
  triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)
  
    triggerEl.addEventListener('click', function (event) {
      event.preventDefault();
      tabTrigger.show();
    })
  })
    $("#btnEditar").click(function(){
        //ESTÉTICA DEL MODAL
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color","#007BFF");
        $(".modal-title").text("Editar Información");
        $(".modal-title").css("color","#ffffff");
        $(".modal-title").css("font-weight","bold");
        $("#btnGuardar").css("background-color","#007BFF");
        $("#btnGuardar").css("border-color","#007BFF");
        $("#btnGuardar").css("font-weight","500");
        $("#btnGuardar").text("Guardar");        
        // $("#btnGuardar").css("border-color","#007BFF");
        document.getElementById("btnGuardar").addEventListener("mouseover", function() {
          document.getElementById("btnGuardar").style.backgroundColor = "#006BDD";
          document.getElementById("btnGuardar").style.borderColor = "#006BDD";
        });
        document.getElementById("btnGuardar").addEventListener("mouseout", function() {
          document.getElementById("btnGuardar").style.backgroundColor = "#007BFF";
          document.getElementById("btnGuardar").style.borderColor = "#007BFF";
        });
        $('#modalEmpresa').modal({backdrop: 'static', keyboard: false})
        //FIN ESTÉTICA MODAL

        //RECUPERAR DATOS
        opcion=1;
        $.ajax({
            url:"bd/datos-empresa.php",
            type: "POST",
            dataType: "json",
            async:false,
            data:{opcion:opcion},
            success:function(data){        
                $("#nombre_modal").val(data[0].razon_social);                   
                $("#direccion_modal").val(data[0].direccion);                   
                $("#correo_modal").val(data[0].correo_electronico);                   
                $("#password_modal").val(data[0].password_correo);                   
                $("#nit_modal").val(data[0].nit);                   
                $("#sitio_web_modal").val(data[0].sitio_web);                   
                $("#ciudad_modal").val(data[0].ciudad);                   
                $("#pais_modal").val(data[0].pais);                                               
            }   
          });
        //FIN RECUPERAR DATOS
        $("#modalEmpresa").modal("show");  
    });

    $("#formPersonas").submit(function(e){
        e.preventDefault();        
        opcion=2; 
        nombre_modal = $.trim($("#nombre_modal").val());    
        direccion_modal = $.trim($("#direccion_modal").val());    
        correo_modal = $.trim($("#correo_modal").val());    
        password_modal = $.trim($("#password_modal").val());    
        nit_modal = $.trim($("#nit_modal").val());    
        sitio_web_modal = $.trim($("#sitio_web_modal").val());    
        ciudad_modal = $.trim($("#ciudad_modal").val());    
        pais_modal = $.trim($("#pais_modal").val());    
        cambio_de_foto=Registrar();  
        $.ajax({
          url:"bd/datos-empresa.php",
          type: "POST",
          dataType: "json",
          async:false,
        //   data:{ opcion:opcion, nombre_modal:nombre_modal, direccion_modal:direccion_modal, correo_modal:correo_modal, 
        //     passowrd_modal:passowrd_modal, nit_modal:nit_modal, sitio_web_modal:sitio_web_modal, ciudad_modal:ciudad_modal,
        //     pais_modal:pais_modal},
          data:{opcion:opcion,nombre_modal:nombre_modal, direccion_modal:direccion_modal, correo_modal:correo_modal,
                password_modal:password_modal, nit_modal:nit_modal, sitio_web_modal:sitio_web_modal, ciudad_modal:ciudad_modal,
                pais_modal:pais_modal},
          success:function(data){                    

          }
        });
        $("#modalEmpresa").modal("hide");
        // window.location = window.location.href+'?eraseCache=true';
        // location.reload(true);
        // REFRESCAR CACHE Y PAGINA
        $.ajax({
          url: window.location.href,
          headers: {
              "Pragma": "no-cache",
              "Expires": -1,
              "Cache-Control": "no-cache"
          }
        }).done(function () {
          swal({
            title:"Cambios Guardados",
            text: "Se realizo guardo los cambios de manera correcta",
            type: "success",
            timer: 1500,
            showConfirmButton: false
          }, function(){
            window.history.forward(1);
            location.reload(true);
            });            
          });
        });

    $("#formConfiguraciones").submit(function(e){
      e.preventDefault();
      opcion = 3;
      email_inscripcion_asunto = $.trim($("#email_inscripcion_asunto").val());    
      email_inscripcion_cuerpo = $.trim($("#email_inscripcion_cuerpo").val());    
      email_inscripcion_alt = $.trim($("#email_inscripcion_alt").val());    
      email_inscripcion_texto_boton = $.trim($("#email_inscripcion_texto_boton").val());    
      email_inscripcion_link_boton = $.trim($("#email_inscripcion_link_boton").val());    
      email_recordatorio_asunto = $.trim($("#email_recordatorio_asunto").val());    
      email_recordatorio_cuerpo = $.trim($("#email_recordatorio_cuerpo").val());    
      email_recordatorio_alt = $.trim($("#email_recordatorio_alt").val());    
      email_recordatorio_sesiones = $.trim($("#email_recordatorio_sesiones").val());    
      email_vencimiento_asunto = $.trim($("#email_vencimiento_asunto").val());    
      email_vencimiento_cuerpo = $.trim($("#email_vencimiento_cuerpo").val());    
      email_vencimiento_alt = $.trim($("#email_vencimiento_alt").val());    
      comprobante_pdf_cuerpo = $.trim($("#comprobante_pdf_cuerpo").val());    
      $.ajax({
        url:"bd/datos-empresa.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{ opcion, email_inscripcion_asunto, email_inscripcion_cuerpo, email_inscripcion_alt, email_inscripcion_texto_boton, email_inscripcion_link_boton,
          email_recordatorio_asunto, email_recordatorio_cuerpo, email_recordatorio_alt, email_recordatorio_sesiones, email_vencimiento_asunto, email_vencimiento_cuerpo,
          email_vencimiento_alt, comprobante_pdf_cuerpo },
        success:function(data){                    

        }
      });
      $("#modalConfiguraciones").modal("hide");
      $.ajax({
        url: window.location.href,
        headers: {
            "Pragma": "no-cache",
            "Expires": -1,
            "Cache-Control": "no-cache"
        }
      }).done(function () {
        swal({
          title:"Cambios Guardados",
          text: "Se realizo guardo los cambios de manera correcta",
          type: "success",
          timer: 1500,
          showConfirmButton: false
        }, function(){
          window.history.forward(1);
          location.reload(true);
          });            
      });

    })
    $("#textRichText").click(function(){
      const valorRichText = $(".content").val()
      console.log('RICH: ', valorRichText);
      alert('CLICK');
    })

    $("#configuraciones").click(function(){
      console.log('CLICK');
      $(".modal-header").css("background-color","#007BFF");
      $(".modal-title").text("Configuraciones");
      $(".modal-title").css("color","#ffffff");
      $(".modal-title").css("font-weight","bold");
      $("#modalConfiguraciones").modal("show");
    })

    $("#backup").click (function(){
      console.log("EMPEZO EL BACKUP");
      $.ajax({
        url:"bd/crear-backup.php",
        type: "POST",
        async:false,
        data:{  },
        success:function(data){                    
          swal("Back Up", "Se realizo el respaldo de la base de datos de forma correcta", "success");
        }
      });
      console.log("TERMINO EL BACKUP");
    })
});