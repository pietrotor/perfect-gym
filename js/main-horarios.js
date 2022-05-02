function mostrar_swat_exitoso(titulo,mensaje){
  swal(titulo, mensaje, "success");
}
$(document).ready(function(){      
    id="";
    tableDisc=$("#tablaPersonas").DataTable({
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
    $( "#btnnuevohorario" ).click(function() {       
        $("#formDisciplinas").trigger("reset");
        $(".modal-header").css("background-color","#28a745");
        $(".modal-title").text("Nuevo Registro");
        $("#btnGuardar").text("Agregar");
        $(".modal-title").css("color","#ffffff"); 
        $(".tab-content").css("height","100%"); 
        $("#btnGuardar").css("background-color","#28a745");
        $("#btnGuardar").css("border-color","#28a745");
        $("#btnGuardar").css("font-weight","500");
        $("#btnGuardar").text("Agregar");
        document.getElementById("btnGuardar").addEventListener("mouseover", function() {
          document.getElementById("btnGuardar").style.backgroundColor = "#259A40";
          document.getElementById("btnGuardar").style.borderColor = "#259A40";
        });
        document.getElementById("btnGuardar").addEventListener("mouseout", function() {
          document.getElementById("btnGuardar").style.backgroundColor = "#28a745";
          document.getElementById("btnGuardar").style.borderColor = "#28a745";
        });
        opcion=1
        $("#Modal_Horarios").modal("show");
    }); 
    // AGREGAR DISCIPLINA    ----->    NUEVA MODALIDAD DE REGISTRO
    $("#Form_Horarios").submit(function(e){
        e.preventDefault();         
        id_clase = $.trim($("#id_clase").val());        
        denominacion = $.trim($("#disciplina").val());        
        instructor = $.trim($("#instructor").val());
        sesiones = $("#num_sesiones").val();
        precio = $("#precio").val();
        sala = $("#id_sala").val();
        hora_inicio = $("#ini_hora").val() + ":00";
        hora_fin = $("#fin_hora").val() + ":00";
        dias_limite = $("#dias_limite").val();               
        $.ajax({
        url:"bd/crud-horario.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{ id:id ,id_clase:id_clase, denominacion:denominacion, instructor:instructor, sesiones:sesiones, precio:precio, sala:sala, hora_inicio:hora_inicio, hora_fin:hora_fin, dias_limite:dias_limite, opcion:opcion},
        success:function(data){           
            data[0].hora_inicio=data[0].hora_inicio.slice(0,-3);
            data[0].hora_fin=data[0].hora_fin.slice(0,-3);
            if( opcion==1){
              tableDisc.row.add([data[0].id, data[0].denominacion, data[0].hora_inicio, data[0].hora_fin, data[0].sesiones, data[0].precio, data[0].instructor, data[0].sala]).draw();
              mostrar_swat_exitoso("Horario Agregado!", "Se agrego correctamente el horario.")
            }
            else {              
              tableDisc.row(fila).data([data[0].id, data[0].denominacion, data[0].hora_inicio, data[0].hora_fin, data[0].sesiones, data[0].precio, data[0].instructor, data[0].sala]).draw();                            
              mostrar_swat_exitoso("Horario Modificado!", "Se modifico exitosamente el horario de la disciplina.")
            }
        }
        });
        $("#Modal_Horarios").modal("hide");
    });
    // FIN - NUEVA FORMA DE AGREGAR DISCIPLINA -  AGREGAR A LA BASE DE DATOS

    // EDITAR HORARIOS
    $(document).on("click",".btnEditar", function(){
      $("#btnGuardar").css("background-color","#007BFF");
      $("#btnGuardar").css("border-color","#007BFF");
      $("#btnGuardar").css("font-weight","500");
      $("#btnGuardar").text("Guardar");
      document.getElementById("btnGuardar").addEventListener("mouseover", function() {
        document.getElementById("btnGuardar").style.backgroundColor = "#0051FF";
        document.getElementById("btnGuardar").style.borderColor = "#0051FF";
      });
      document.getElementById("btnGuardar").addEventListener("mouseout", function() {
        document.getElementById("btnGuardar").style.backgroundColor = "#007BFF";
        document.getElementById("btnGuardar").style.borderColor = "#007BFF";
      });
      fila=$(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());
      opc_recu=2;    
      $.ajax({
        url:"bd/recuperar-datos-disci.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{id:id, opc_recu:opc_recu},
        success:function(data){                        
          $('#disciplina').val(data.denominacion);
          $('#instructor').val(data.id_instructor);
          $('#num_sesiones').val(data.sesiones);
          $('#precio').val(data.precio);
          $('#id_sala').val(data.id_sala);
          var text_hora_ini = data.hora_inicio
          text_hora_ini = text_hora_ini.slice(0,-3);
          $('#ini_hora').val(data.hora_inicio.slice(0,-3));
          $('#fin_hora').val(data.hora_fin.slice(0,-3));
          $('#dias_limite').val(data.sesiones);
        }
      });
      opcion=2; //editar
      $(".modal-header").css("background-color","#007bff");
      $(".modal-title").text("Editar Registro");
      $(".modal-title").css("color","#ffffff");
      $("#Modal_Horarios").modal("show");
    });
    // FIN EDITAR HORARIOS

    // ELIMINAR REGISTRO
    $(document).on("click",".btnBorrar", function(){
      fila=$(this);
      id = parseInt($(this).closest("tr").find('td:eq(0)').text());
      opcion=3;
      swal({
        title: "¿Esta seguro?",
        text: "Al eliminar el horario se pedera toda la información de los clientes inscritos.",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-Danger",
        confirmButtonText: "Si, eliminar ahora!",
        closeOnConfirm: false
      },
      function(){
        $.ajax({
          url:"bd/crud-horario.php",
          type: "POST",
          dataType: "json",
          data:{ opcion:opcion, id:id },
          success:function(data){                      
            tableDisc.row(fila.parents('tr')).remove().draw();  
          }
        });
        swal("Eliminado", "El horario se elimino correctamente", "success");
      });  
    });
    // FIN - ELIMINAR REGISTRO

  });
  