function mostrar_swat_exitoso(titulo, mensaje, tipo = "success"){
  swal(titulo, mensaje, tipo);
}
$(document).ready(function(){
  var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})
let estado_memb=0; //VE SI EXISTE ALGUNA MEMBRESIA ACTIVA


    tablaPersonas=$("#tablaPersonas").DataTable({  

        "createdRow": function( row, data, dataIndex ) {
            if ( data[6] == "1" ) {        
                $(row).find('td:eq(6)').html("<span class='badge badge-success'>Activo</span>");
                estado_memb=1;                             
            }else{
                if(data[6]=="0" && estado_memb==0 ){
                    $(row).find('td:eq(6)').html("<span class='badge badge-danger'>Vencida</span>");
                    $(row).find('td:eq(7)').html("<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-warning btnImprimir'><span class='material-icons'>print</span></button><button class='btn btn-sm btn-danger btnRenovar'><span class='material-icons'>cached</span></button></div></div>");
                    
                }else if(data[6]=="0" && estado_memb==1){
                  $(row).find('td:eq(6)').html("<span class='badge badge-danger'>Vencida</span>");
                  $(row).find('td:eq(7)').html("<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-warning btnImprimir'><span class='material-icons'>print</span></button></div></div>");
              
                }

            }    
        },

      "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-sm btn-warning btnImprimir'><span class='material-icons'>print</span></button></div></div>",
      
          }/* ,
          {
            "targets":[-3,-4,-5],
            "visible":false,
          } */
          ],  
        
        
        //cambiar el idioma a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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


      tablaAsistencia=$("#tablaAsistencia").DataTable({       
        "aaSorting": [[ 0, "desc" ]],
        //cambiar el idioma a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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


      tablaPagos=$("#tablaPagos").DataTable({  
        "aaSorting": [[ 0, "desc" ]],
          
          
          //cambiar el idioma a español
          "language": {
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "zeroRecords": "No se encontraron resultados",
                  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
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


      $(document).on("click",".btnImprimir", function(){//Mostrar modal imprimir
        fila=$(this).closest("tr");
        var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
        id_membresia=fila.find('td:eq(0)').text();
        document.getElementById('id-membresia').value=id_membresia;   
        $("#modalPDF").modal("show");
      });
    // IMPRIMIR PDF
  $("#formPDF").submit(function(e){
    $("#modalPDF").modal("hide");
  });
    //MOSTRA MODAL MEMBRESIA 

  $(document).on("click",".btnRenovar", function(){    
    $('#precio').val('');
    $('#sesiones').val('');
    $('#id-clase').val('0');
    $(".modal-header").css("background-color","#007bff");
    $(".modal-title").css("color","#ffffff");
    $("#modalMembresia").modal("show");
  });

  $("#formMembresia").submit(function(e){//agregar membresia
    e.preventDefault();
    // id=$trim($("#id").val());
    id = $.trim($("#id-cliente").val());
    clase = $.trim($("#id-clase").val());
    sesiones = $.trim($("#sesiones").val());
    fecha_ini = $("#fecha_ini").val();
    fecha_fin = $("#fecha_fin").val();
    precio= $("#precio").val();
    $.ajax({
      url:"bd/membresia.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{clase:clase, sesiones:sesiones, fecha_ini:fecha_ini, fecha_fin:fecha_fin, id:id,precio:precio},
      success:function(data){
        // var datos=JSON.parse(data);
        console.log('AGREGO MEMBRESIA');
        console.log('DATOS');
        console.log(id);
        console.log(clase);
        console.log(sesiones);
        console.log(fecha_ini);
        nom_clase= data[0].clase;
        console.log(nom_clase);
        console.log(data[0].nombre);
        console.log(data[0].correo); 
        id_membresia_impresion=data[0].id;
        console.log('EL ID ES '+id_membresia_impresion);
        //tablaPersonas.row.add([data[0].id, data[0].clase], data[0].fecha_inicio, data[0].fecha_membresia, data[0].fecha_end_membresia, data[0].precio, data[0].estado).draw();        
      }
    });
    $("#modalMembresia").modal("hide");    
    document.getElementById('id-membresia').value=id_membresia_impresion;
    
    $("#modalPDF").modal("show");
    // $(".modal-title").text("COMPROBANTE DE INSCRIPCIÓN");
    // document.getElementById('id-cliente-paso').value=id;
    // $("#modalPDF").modal("show");
  });
  // FIN - AGREGAR A LA BASE DE DATOS

  $("#formClases").submit(function(e){  //Agregar membresia
    e.preventDefault();    
    id = $.trim($("#id-cliente").val());
    id_grupo = $('#horario').val();    
    fecha_ini = $("#fecha_ini").val();
    opcion = 1;
    hay_cupos = true;
    $.ajax({
      url:"bd/verificar-cupos.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{ id_grupo },
      success:function(data){
        if (parseInt(data.limitar_cupos) === 1) {
          if (parseInt(data.cupos_disponibles) <= 0) {
            console.log('NO HAY CUPOS');
            hay_cupos = false;
            return
          } else {
            console.log('SI HAY CUPOS');
            hay_cupos = true;
          }
        }
      }
    })
    if (!hay_cupos) {
      swal("No existen cupos Disponibles", "Sin Cupos", "warning");
      return
    }
    $.ajax({
      url:"bd/membresia.php",
      type: "POST",
      dataType: "json",
      async:false,  
      data:{id:id, id_grupo:id_grupo, fecha_ini:fecha_ini, opcion:opcion},
      success:function(data){   
        hora_unida= data[0].hora_inicio.slice(0,5) + " - " + data[0].hora_fin.slice(0,5);
        $('.btnRenovar').css("display","none");
        tablaPersonas.row.add([data[0].id, data[0].clase, hora_unida, data[0].fecha_membresia, data[0].fecha_end_membresia, data[0].precio, data[0].estado]).draw();        
        id_membresia_impresion = data[0].id;
      }
    });
    $("#modalMembresia").modal("hide");    
    document.getElementById('id-membresia').value=id_membresia_impresion;    
    $("#modalPDF").modal("show");
    // $(".modal-title").text("COMPROBANTE DE INSCRIPCIÓN");
    // document.getElementById('id-cliente-paso').value=id;
    // $("#modalPDF").modal("show");
  });
  // FIN - AGREGAR A LA BASE DE DATOS
});