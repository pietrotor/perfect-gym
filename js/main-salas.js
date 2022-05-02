function mostrar_swat_exitoso(titulo,mensaje){
  swal(titulo, mensaje, "success");
}
$(document).ready(function(){
    tablaInstruct=$("#tablaDisciplinas").DataTable({
      "columnDefs":[{
        "targets":-1,
        "data":null,
        "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'><span class='material-icons'>edit</span></button><button class='btn btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button></div></div>"
  
      }],
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
    //MOSTRAR EL MODAL
    $("#btnNuevo").click(function(){
      $("#formPersonas").trigger("reset");
      $(".modal-header").css("background-color","#28a745");
      $(".modal-title").text("Nuevo Registro");
      $(".modal-title").css("color","#ffffff");
      $("#modalDisciplinas").modal("show");
      id=null;
      opcion=1; //agregar
    });
    //FIN - MOSTRAR EL MODAL
    var filas; //capturar la fila para editar o borrar el registros
  
    // EDITAR EL REGISTRO
    $(document).on("click",".btnEditar", function(){
      fila=$(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      sala=fila.find('td:eq(1)').text();           
      $("#sala").val(sala);
      opcion=2; //editar
      $(".modal-header").css("background-color","#007bff");
      $(".modal-title").text("Editar Instructor");
      $(".modal-title").css("color","#ffffff");
      $("#modalDisciplinas").modal("show");
    });
    //FIN - EDITAR EL REGISTRO
  
    // ELIMINAR REGISTRO
    $(document).on("click",".btnBorrar", function(){
      fila=$(this);
      id = parseInt($(this).closest("tr").find('td:eq(0)').text());
      opcion=3;
      swal({
        title: "¿Esta seguro?",
        text: "Al eliminar la disciplina perdera toda la información de sus clientes inscritos",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-Danger",
        confirmButtonText: "Si, eliminar ahora!",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
          url:"bd/crud-salas.php",
          type: "POST",
          dataType: "json",
          data:{ opcion:opcion, id:id },
          success:function(data){
            console.log("BORRO");
            // tablaInstruct.row(fila.parents('tr')).remove().draw();
            tablaInstruct.row(fila.parents('tr')).remove().draw();
  
          }
        });
        swal("Eliminado", "El cliente a sido eliminado del sistema", "success");
      }); 
    });
    // FIN - ELIMINAR REGISTRO
  
  
  
  
    // AGREGAR A LA BASE DE DATOS
    $("#formDisciplinas").submit(function(e){
      e.preventDefault();
      // id=parseInt(fila.find('td:eq(0)').text());
      sala = $.trim($("#sala").val());       
      $.ajax({
        url:"bd/crud-salas.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{ sala:sala, id:id, opcion:opcion },
        success:function(data){                  
          id=data[0].id;
          sala=data[0].sala;         
          if( opcion==1){
            tablaInstruct.row.add([id,sala]).draw();
            mostrar_swat_exitoso("Sala Agregada", "Se agrego correctamente la sala")
          }
          else {
            tablaInstruct.row(fila).data([id,sala]).draw();
            mostrar_swat_exitoso("Sala Modificada", "Se modifico exitosamente la información de la sala")
          }  
        }
      });
      $("#modalDisciplinas").modal("hide");
    });
    // FIN - AGREGAR A LA BASE DE DATOS
  
  });
  