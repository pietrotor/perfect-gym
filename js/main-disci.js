function mostrar_swat_exitoso(titulo,mensaje){
  swal(titulo, mensaje, "success");
}
$(document).ready(function(){

  // $('#stepwizard').smartWizard();

  tableDisc=$("#tablaDisciplinas").DataTable({
    "columnDefs":[{
      "targets":-1,
      "data":null,
      "defaultContent":"<div class='text-center'><div class='btn-group'><a href='horarios.php'><button class='btn btn-dark btnHorarios'><span class='material-icons'>edit_calendar</span></button></a><button class='btn btn-primary btnEditar'><span class='material-icons'>edit</span></button><button class='btn btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button></div></div>"

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
    $("#formDisciplinas").trigger("reset");
    $(".modal-header").css("background-color","#28a745");
    $(".modal-title").text("Nuevo Registro");
    $(".modal-title").css("color","#ffffff");
    $("#modalDisciplinas").modal("show");
    id=null;
    opcion=1; //agregar
  });
  //FIN - MOSTRAR EL MODAL
  var filas; //capturar la fila para editar o borrar el registros


  // AGREGAR DISCIPLINA    ----->    NUEVA MODALIDAD DE REGISTRO
  $("#formAgregarDisciplina").submit(function(e){
    e.preventDefault();  
    // id="";
    clase = $.trim($("#disciplina_input").val());
    descripcion = $("#descripcion_input").val();    
    $.ajax({
      url:"bd/crud-disci.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{ clase:clase, descripcion:descripcion,opcion:opcion },
      success:function(data){                        
        if( opcion==1){
          tableDisc.row.add([data[0].id, data[0].clase, data[0].descripcion]).draw();
          mostrar_swat_exitoso("Disciplina Agregada", "Se agrego exitosamente la nueva disciplina");
        }
        else {
          tableDisc.row(fila).data([data[0].id, data[0].clase, data[0].descripcion]).draw();
          mostrar_swat_exitoso("Disciplina Modificada", "Se modifico exitosamente la disciplina");
        }
      }
    });
    $("#modalNuevoDisciplinas").modal("hide");
  });
  // FIN - NUEVA FORMA DE AGREGAR DISCIPLINA -  AGREGAR A LA BASE DE DATOS

    // EDITAR EL REGISTRO
    $(document).on("click",".btnEditar", function(){
      fila=$(this).closest("tr");
      id = parseInt(fila.find('td:eq(0)').text());   
      opc_recu = 1;       
      $.ajax({
        url:"bd/recuperar-datos-disci.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{id:id, opc_recu:opc_recu},
        success:function(data){           
          $('#disciplina_input').val(data.clase);
          $('#descripcion_input').val(data.descripcion);
        }
      });
      opcion=2; //editar
      $(".modal-header").css("background-color","#007bff");
      $(".modal-title").text("Editar Registro");
      $(".modal-title").css("color","#ffffff");
      $("#modalNuevoDisciplinas").modal("show");
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
          url:"bd/crud-disci.php",
          type: "POST",
          dataType: "json",
          data:{ opcion:opcion, id:id },
          success:function(data){
            console.log("BORRO");
            // tablaPersonas.row(fila.parents('tr')).remove().draw();
            tableDisc.row(fila.parents('tr')).remove().draw();
  
          }
        });
        swal("Eliminado", "El cliente a sido eliminado del sistema", "success");
      });  
    });
    // FIN - ELIMINAR REGISTRO
  
    // ELIMINAR REGISTRO
    $(document).on("click",".btnHorarios", function(){
      fila=$(this);
      id_clase_tabla = parseInt($(this).closest("tr").find('td:eq(0)').text());
      opcion=0;           
      $.ajax({
        url:"bd/crud-disci.php",
        type: "POST",
        dataType: "json",
        data:{ opcion:opcion, id_clase_tabla:id_clase_tabla },
        success:function(data){          
         }
      });
      
    });
    // FIN - ELIMINAR REGISTRO

  //AGREGAR HORARIOS
  total="";
  intermedio="";
  var horas_inicio = [];
  var horas_fin = [];
  $( "#btnnuevadisci" ).click(function(){       
    $("#formAgregarDisciplina").trigger("reset");
    $(".modal-header").css("background-color","#28a745");
    $(".modal-title").text("Nuevo Registro");
    $(".modal-title").css("color","#ffffff"); 
    $(".tab-content").css("height","100%"); 
    opcion = 1;
    $("#modalNuevoDisciplinas").modal("show");
  });
});
