$(document).ready(function(){   
    tablaAsistentesHoy=$("#tablaAsistentesHoy").DataTable({       
          
          
          //cambiar el idioma a español
          "language": {
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "zeroRecords": "No se encontraron resultados",
                  "info": "Mostrando registros del _START_ de un total de _TOTAL_ ",
                  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                  "sSearch": "Buscar:",
                  "oPaginate": {
                      "sFirst": "Primero",
                      "sLast":"Último",
                      "sNext":"Siguiente",
                      "sPrevious": "Anterior"
                   },
                   "sProcessing":"Procesando...",
              }
  
  
        });
    tablasInscritosHoy=$("#tablasInscritosHoy").DataTable({       
          
          
          //cambiar el idioma a español
          "language": {
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "zeroRecords": "No se encontraron resultados",
                  "info": "Mostrando registros del _START_ de un total de _TOTAL_ ",
                  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                  "sSearch": "Buscar:",
                  "oPaginate": {
                      "sFirst": "Primero",
                      "sLast":"Último",
                      "sNext":"Siguiente",
                      "sPrevious": "Anterior"
                   },
                   "sProcessing":"Procesando...",
              }
  
  
        });

    $("#form-actu").submit(function(e){
        e.preventDefault();
        hora=2;
        $.ajax({
            url:"bd/inicio.php",
            type: "POST",
            dataType: "json",
            data:{hora:hora},
            success:function(data){
                if(data.error!==undefined){                    
                    return false;
                 } else {
                    if(data.activos!==undefined){$('#clientes-inscritos').html(''+data.activos);};                    
                    if(data.ingreso!==undefined){$('#clientes-asistencia').html(''+data.ingreso);};                    
                    return true;
                 }
            }
          });
    });
    
});