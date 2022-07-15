let imagenDefault='imagenes/default-avatar.png'
function mostrar_swat_exitoso(titulo,mensaje){
  swal(titulo, mensaje, "success");
}
function sololetras(e){

  key = e.keyCode || e.wich;
  teclado = String.fromCharCode(key).toLowerCase();
  letras=" abcdefghijklmnñopqrstuvwxyz";
  especiales="8-37-38-46-164";
  teclado_especial=false;
  for(var i in especiales){
    if(key ==especiales[i]){
      teclado_especial  = true;
      break;
    }
  }
  if (letras.indexOf(teclado)==-1 && !teclado_especial){
      return false;
  }

}


function cambiarsrc(id,src){
  var Imagen = document.getElementById(id);
  Imagen.src=src;
}

function foto_nueva_o_actualizada(str){
  let direccion_img = "imagenes/imagenes/"; // string a buscar en la cadena
  if (str.includes(direccion_img)){ //Comprobamos si se repite la direccion de la imagen
    return true; // Si repite la direccion
  }else{
    return false; // No repite la dirección
  }
}

function Registrar(url_foto_del_cliente){          

  var archivo = $("#seleccionararchivo").val();  
  if (archivo != ""){ // Preguntamos si se cargo algun archivo
    var extension = archivo.split('.').pop();
    var nombrearchivo = $.trim($("#carnet_identidad").val())+"."+extension;
  
    var formData= new FormData();
    var foto = $("#seleccionararchivo")[0].files[0];  
    formData.append('f',foto);    
    formData.append('nombrearchivo',nombrearchivo);         
    $.ajax({
        url:'subirimagen.php',
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
  }else{
    nombrearchivo= url_foto_del_cliente;
  }

  return nombrearchivo;
}
$(document).ready(function(){
  var id,opcion,id_membre;
  id_membre='';
  opcion=4;
  foto = "";
  tablaPersonas=$("#tablaPersonas").DataTable({
    "createdRow": function( row, data, dataIndex ) {
      if ( data[8] == "1" ) {        
          $(row).find('td:eq(7)').html("<span class='badge badge-success'>Activo</span>");                             
      }else{         
              $(row).find('td:eq(7)').html("<span class='badge badge-danger'>Vencida</span>");           
      }    
  },
    "aaSorting": [[ 0, "desc" ]],
    // "ajax":{
    //   "url":"../bd/crud.php",
    //   "method":'POST',
    //   "data":{opcion:opcion},
    //   "dataSrc":""
    // },
    // "columns":[
    //   {"data":"id"},
    //   {"data":"nombre"},
    //   {"data":"apellido"},
    //   {"data":"carnet_identidad"},
    //   {"data":"sexo"},
    //   {"data":"telefono"},
    //   {"data":"correo"},
    //   {"defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'><span class='material-icons'>edit</span></button><button class='btn btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button></div></div>"}
    //
    // ],

    "columnDefs":[{
      "targets":-1,
      "data":null,
      // "defaultContent":"<div class='text-center'><button class='btn btn-sm btn-primary btnEditar' ><span class='material-icons'>edit</span></button><button class='btn btn-sm btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button><a href='clientes.php'><button class='btn btn-sm btn-dark  btnClienteDatos' ><span class='material-icons'>visibility</span></button></a></div>",
      "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><span class='material-icons'>edit</span></button><button class='btn btn-danger btn-sm btnBorrar'><span class='material-icons'>delete_forever</span></button><a href='clientes.php'><button class='btn btn-sm btn-dark  btnClienteDatos' ><span class='material-icons'>visibility</span></button></a></div></div>",

    } ,
     {
      "targets":[4],
       "visible":false,
     }
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
  // Clases
  // MEMBRESIA - AGREGAR A LA BASE DE DATOS
  // $("#formClases").submit(function(e) {
  //   e.preventDefault();
  //   // id=$trim($("#id").val());
  //   id = $.trim($("#id-cliente").val());
  //   clase = $.trim($("#id-clase").val());
  //   sesiones = $.trim($("#sesiones").val());
  //   fecha_ini = $("#fecha_ini").val();
  //   fecha_fin = $("#fecha_fin").val();
  //   precio= $("#precio").val();
  //   $.ajax({
  //     url:"bd/membresia.php",
  //     type: "POST",
  //     dataType: "json",
  //     data:{clase:clase, sesiones:sesiones, fecha_ini:fecha_ini, fecha_fin:fecha_fin, id:id,precio:precio},
  //     success:function(data){
  //       // var datos=JSON.parse(data);
  //       console.log('AGREGO MEMBRESIA');
  //       console.log('DATOS');
  //       console.log(id);
  //       console.log(clase);
  //       console.log(sesiones);
  //       console.log(fecha_ini);
  //       nom_clase= data[0].clase;
  //       console.log(nom_clase);
  //       console.log(data[0].nombre);
  //       console.log(data[0].correo);        
  //       tablaPersonas.row.add([data[0].id, data[0].nombre, data[0].apellido, data[0].carnet_identidad, data[0].sexo, data[0].telefono, data[0].correo,  data[0].clase,  data[0].estado]).draw();        
  //     }
  //   });
  //   $("#modalMembresia").modal("hide");
  //   $(".modal-title").text("COMPROBANTE DE INSCRIPCIÓN");
  //   document.getElementById('id-cliente-paso').value=id;
  //   $('#modalPDF').modal({backdrop: 'static', keyboard: false});
  //   $("#modalPDF").modal("show");
  // });
  // FIN - AGREGAR A LA BASE DE DATOS

  // FIN - CLASES

  //MOSTRAR EL MODAL
  $("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color","#28a745");
    $(".modal-title").text("Nuevo Registro");
    $(".modal-title").css("color","#ffffff");
    $("#btnGuardar").css("background-color","#28a745");
    $("#btnGuardar").css("border-color","#28a745");
    $("#btnGuardar").css("font-weight","500");
    $("#btnGuardar").text("Agregar");
    cambiarsrc('mostrarimagen',imagenDefault);
    // $("#btnGuardar").css("border-color","#28a745");
    document.getElementById("btnGuardar").addEventListener("mouseover", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#259A40";
      document.getElementById("btnGuardar").style.borderColor = "#259A40";
    });
    document.getElementById("btnGuardar").addEventListener("mouseout", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#28a745";
      document.getElementById("btnGuardar").style.borderColor = "#28a745";
    });
    $('#modalCRUD').modal({backdrop: 'static', keyboard: false})
    foto = ""; //vaciamos la variable para agregar una nueva foto
    $("#modalCRUD").modal("show");
    id=null;
    opcion=1; //agregar
  });
  //FIN - MOSTRAR EL MODAL
  var filas; //capturar la fila para editar o borrar el registros

  // EDITAR EL REGISTRO
  $(document).on("click",".btnEditar", function(){
    console.log("HOLI");
    fila=$(this).closest("tr");
    var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
    id = parseInt(fila.find('td:eq(0)').text());
    //INICIO RECUPERACIÓN DE DATOS

    $.ajax({
      url:"bd/recuperar-datos.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{  id:id },
      success:function(data){        
        nombre=data.nombre;
        apellido=data.apellido;
        carnet_identidad=data.carnet_identidad;
        sexo=data.sexo;
        fecha_nacimiento=data.fecha_nacimiento;
        telefono=data.telefono;
        correo=data.correo;
        foto=data.foto;
        if(foto===''){
          foto=imagenDefault;
        }
      }
    });

    //FIN RECUPERACÓN DE DATOS    
    /*
    nombre=fila.find('td:eq(1)').text();
    apellido=fila.find('td:eq(2)').text();
    carnet_identidad=parseInt(fila.find('td:eq(3)').text());
    sexo=fila.find('td:eq(4)').text();
    telefono=parseInt(fila.find('td:eq(5)').text());
    correo=fila.find('td:eq(6)').text();*/
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#carnet_identidad").val(carnet_identidad);
    $("#sexo").val(sexo);
    $("#telefono").val(telefono);
    $("#correo").val(correo);
    $("#fecha_naci").val(fecha_nacimiento);
    cambiarsrc('mostrarimagen',foto);
    opcion=2; //editar

    $(".modal-header").css("background-color","#007bff");
    $(".modal-title").text("Editar Registro");
    $(".modal-title").css("color","#ffffff");
    $("#btnGuardar").css("background-color","#007BFF");
    $("#btnGuardar").css("border-color","#007BFF");
    $("#btnGuardar").text("Guardar");
    // $("#btnGuardar").css("border-color","#28a745");
    document.getElementById("btnGuardar").addEventListener("mouseover", function() {
    document.getElementById("btnGuardar").style.backgroundColor = "#006BDD";
    document.getElementById("btnGuardar").style.borderColor = "#006BDD";
    });
    document.getElementById("btnGuardar").addEventListener("mouseout", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#007BFF";
      document.getElementById("btnGuardar").style.borderColor = "#007BFF";
    });
    $('#modalCRUD').modal({backdrop: 'static', keyboard: false});
    $("#modalCRUD").modal("show");
  });
  //FIN - EDITAR EL REGISTRO

  // ELIMINAR REGISTRO
  $(document).on("click",".btnBorrar", function(){
    fila=$(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion=3;
    swal({
      title: "¿Esta seguro?",
      text: "Al eliminar al cliente no podra recuperar toda la información del mismo",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-Danger",
      confirmButtonText: "Si, eliminar ahora!",
      closeOnConfirm: false
    },
    function(){
      $.ajax({
        url:"bd/crud.php",
        type: "POST",
        dataType: "json",
        data:{ opcion:opcion, id:id },
        success:function(data){
          console.log("BORRO");
          // tablaPersonas.row(fila.parents('tr')).remove().draw();
          tablaPersonas.row(fila.parents('tr')).remove().draw();

        }
      });
      swal("Eliminado", "El cliente a sido eliminado del sistema", "success");
    });

    // var respuesta= confirm("¿Estas seguro de elminar este registro?");
    // if (respuesta){
    //   $.ajax({
    //     url:"bd/crud.php",
    //     type: "POST",
    //     dataType: "json",
    //     data:{ opcion:opcion, id:id },
    //     success:function(data){
    //       console.log("BORRO");
    //       // tablaPersonas.row(fila.parents('tr')).remove().draw();
    //       tablaPersonas.row(fila.parents('tr')).remove().draw();

    //     }
    //   });
    // }
  });
  // FIN - ELIMINAR REGISTRO


  // AGREGAR A LA BASE DE DATOS
  $("#formPersonas").submit(function(e){
    e.preventDefault();
    console.log('Empieza el Proceso');
    archivo_nombre=Registrar(foto);  
    archivo_nombre="imagenes/"+archivo_nombre;  
    if (foto_nueva_o_actualizada(archivo_nombre)){
      archivo_nombre = foto;
    }
    alert(archivo_nombre);
    // id=$trim($("#id").val());
    nombre = $.trim($("#nombre").val());
    apellido = $.trim($("#apellido").val());
    carnet_identidad = $.trim($("#carnet_identidad").val());
    sexo = $.trim($("#sexo").val());    
    telefono= $.trim($("#telefono").val());
    correo = $.trim($("#correo").val());
    fecha_nacimiento = $("#fecha_naci").val();
    $.ajax({
      url:"bd/crud.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{ nombre:nombre,apellido:apellido,carnet_identidad:carnet_identidad, sexo:sexo,telefono:telefono, correo:correo, id:id, opcion:opcion,fecha_nacimiento:fecha_nacimiento, archivo_nombre:archivo_nombre },
      success:function(data){
        // var datos=JSON.parse(data);
        id=data[0].id;
        $("#id-cliente").val(id);        
        nombre=data[0].nombre;
        apellido=data[0].apellido;
        carnet_identidad=data[0].carnet_identidad;
        sexo=data[0].sexo;
        telefono=data[0].telefono;
        correo=data[0].correo;                
        if( opcion==2) {
          tablaPersonas.row(fila).data([data[0].id,data[0].nombre,data[0].apellido,data[0].carnet_identidad,data[0].sexo,data[0].telefono,data[0].correo, data[0].clase, data[0].estado]).draw();                
          if (data[0].estado==1){
            fila.find('td:eq(7)').html("<span class='badge badge-success'>Activo</span>");                             
          }else{
            fila.find('td:eq(7)').html("<span class='badge badge-danger'>Vencida</span>");           
          }
          mostrar_swat_exitoso("Edición Exitosa", "Se modifico todos los datos de manera exitosa.");
        }

      }
    });    
    $("#modalCRUD").modal("hide");
    $(".modal-header").css("background-color","#007bff");
    $(".modal-title").text("Clases");
    if (opcion==1) {
      $('#modalMembresia').modal({backdrop: 'static', keyboard: false});
      $("#modalMembresia").modal("show");
    }

  });
  // FIN - AGREGAR A LA BASE DE DATOS 
  // IMPRIMIR PDF
  $("#formPDF").submit(function(e){    
    $("#modalPDF").modal("hide");
    mostrar_swat_exitoso("Inscripción Exitosa", "Se realizo la inscripción del ciente de forma satisfactoria.");    
  });

//ABRIR PAGINA DE DATOS DEL CLIENTE

$(document).on("click",".btnClienteDatos", function(){
  fila=$(this).closest("tr");
  var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
  carnet_identidad=fila.find('td:eq(3)').text();
  nombre=fila.find('td:eq(1)').text();
  apellido=fila.find('td:eq(2)').text();
  sexo=fila.find('td:eq(4)').text();
  id_tabla_cliente=fila.find('td:eq(0)').text();  
  $.ajax({
    url:"bd/clientes-datos.php",
    type: "POST",  
    async:false,        
    data:{carnet_identidad:carnet_identidad,nombre:nombre,apellido:apellido,sexo:sexo,id_tabla_cliente:id_tabla_cliente},
    success:function(data){
      console.log("Paso la Variable");                      
    }
  });
});  


  // MEMBRESIA - AGREGAR A LA BASE DE DATOS
  $("#formClases").submit(function(e){
    e.preventDefault();
    // id=$trim($("#id").val());
    id = $.trim($("#id-cliente").val());
    id_grupo = $('#horario').val();    
    fecha_ini = $("#fecha_ini").val(); 
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
      data:{id:id, id_grupo:id_grupo, fecha_ini:fecha_ini},
      success:function(data){               
        tablaPersonas.row.add([data[0].id, data[0].nombre, data[0].apellido, data[0].carnet_identidad, data[0].sexo, data[0].telefono, data[0].correo,  data[0].clase,  data[0].estado]).draw();        
      }
    });
    $("#modalMembresia").modal("hide");
    $(".modal-title").text("COMPROBANTE DE INSCRIPCIÓN");
    document.getElementById('id-cliente-paso').value=id;
    $('#modalPDF').modal({backdrop: 'static', keyboard: false});
    $("#modalPDF").modal("show");
  });
  // FIN - AGREGAR A LA BASE DE DATOS



});