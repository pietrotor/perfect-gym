function mostrar_swat_exitoso(titulo,mensaje){
  swal(titulo, mensaje, "success");
}
$(document).ready(function(){
  tablaInstruct=$("#tablaInstructores").DataTable({
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
    $("#modalInstruc").modal("show");
    id=null;
    opcion=1; //agregar
  });
  //FIN - MOSTRAR EL MODAL
  var filas; //capturar la fila para editar o borrar el registros

  // EDITAR EL REGISTRO
  $(document).on("click",".btnEditar", function(){
    fila=$(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombre=fila.find('td:eq(1)').text();
    apellido=fila.find('td:eq(2)').text();
    carnet_identidad=parseInt(fila.find('td:eq(3)').text());
    telefono=parseInt(fila.find('td:eq(4)').text());
    profesion=fila.find('td:eq(5)').text();
    sexo=fila.find('td:eq(6)').text();
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#carnet_identidad").val(carnet_identidad);
    $("#telefono").val(telefono);
    $("#profesion").val(profesion);
    $("#sexo").val(sexo);
    opcion=2; //editar
    $(".modal-header").css("background-color","#007bff");
    $(".modal-title").text("Editar Instructor");
    $(".modal-title").css("color","#ffffff");
    $("#modalInstruc").modal("show");
  });
  //FIN - EDITAR EL REGISTRO

  // ELIMINAR REGISTRO
  $(document).on("click",".btnBorrar", function(){
    fila=$(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion=3;
    swal({
      title: "¿Esta seguro?",
      text: "Al eliminar instructor se perdera la información de las disciplinas donde dictaba",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-Danger",
      confirmButtonText: "Si, eliminar ahora!",
      closeOnConfirm: false
    },
    function(){
      $.ajax({
        url:"bd/crud-instru.php",
        type: "POST",
        dataType: "json",
        data:{ opcion:opcion, id:id },
        success:function(data){
          console.log("BORRO");          
          tablaInstruct.row(fila.parents('tr')).remove().draw();
        }
      });
      swal("Eliminado", "El instructor se elimino de manera correcta", "success");
    });  
  });
  // FIN - ELIMINAR REGISTRO




  // AGREGAR A LA BASE DE DATOS
  $("#formInstructores").submit(function(e){
    e.preventDefault();
    // id=$trim($("#id").val());
    nombre = $.trim($("#nombre").val());
    apellido = $.trim($("#apellido").val());
    carnet_identidad = $.trim($("#carnet_identidad").val());
    sexo= $.trim($("#sexo").val());
    telefono= $.trim($("#telefono").val());
    profesion = $.trim($("#profesion").val());
    $.ajax({
      url:"bd/crud-instru.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{ nombre:nombre,apellido:apellido,carnet_identidad:carnet_identidad,telefono:telefono, profesion:profesion, sexo:sexo, id:id, opcion:opcion },
      success:function(data){
        // var datos=JSON.parse(data);
        console.log('AGREGO');
        console.log(data);
        id=data[0].id;
        nombre=data[0].nombre;
        apellido=data[0].apellido;
        carnet_identidad=data[0].carnet_identidad;
        sexo=data[0].sexo;
        telefono=data[0].telefono;
        profesion=data[0].profesion;
        if( opcion==1){
          tablaInstruct.row.add([id,nombre,apellido,carnet_identidad,telefono,profesion,sexo]).draw();
          mostrar_swat_exitoso("Instrcutor Agregado", "Se agrego correctamente el instructor al sistema");
        }
        else {
          tablaInstruct.row(fila).data([id,nombre,apellido,carnet_identidad,telefono,profesion,sexo]).draw();
          mostrar_swat_exitoso("Instructor Modificado", "Se modifico correctamente los datos del instructor.");
        }

      }
    });
    $("#modalInstruc").modal("hide");
  });
  // FIN - AGREGAR A LA BASE DE DATOS

});
