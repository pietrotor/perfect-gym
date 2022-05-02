$(document).ready(function(){
  var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
  triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)
  
    triggerEl.addEventListener('click', function (event) {
      event.preventDefault();
      tabTrigger.show();
    })
  })

    tablaPersonas=$("#tablaPersonas").DataTable({  
      "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><button class='btn btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button></div>",
      
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
      $("#btnNuevo").click(function(){
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color","#28a745");
        $(".modal-title").text("Nuevo Usuario");
        $(".modal-title").css("color","#ffffff");
        $("#btnGuardar").css("background-color","#28a745");
        $("#btnGuardar").css("border-color","#28a745");
        $("#btnGuardar").css("font-weight","500");
        $("#btnGuardar").text("Agregar");
        // $("#btnGuardar").css("border-color","#28a745");
        document.getElementById("btnGuardar").addEventListener("mouseover", function() {
          document.getElementById("btnGuardar").style.backgroundColor = "#259A40";
          document.getElementById("btnGuardar").style.borderColor = "#259A40";
        });
        document.getElementById("btnGuardar").addEventListener("mouseout", function() {
          document.getElementById("btnGuardar").style.backgroundColor = "#28a745";
          document.getElementById("btnGuardar").style.borderColor = "#28a745";
        });

       



        $("#modalCRUD").modal("show");
        id=null;
        opcion=1; //agregar
      });
      // AGREGAR A LA BASE DE DATOS USUARIO
  $("#formPersonas").submit(function(e){
    e.preventDefault();
    // id=$trim($("#id").val());
    nombre = $.trim($("#nombre_input").val());
    apellido = $.trim($("#apellido_input").val());
    carnet_identidad = $.trim($("#carnet_identidad_input").val());        
    telefono = $.trim($("#telefono_input").val());
    usuario = $.trim($("#usuario_input").val());
    contraseña = $.trim($("#contraseña_input").val());
    rol_usuario = $.trim($("#rol_usuario").val());    
    $.ajax({
      url:"bd/crud-usuario.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{ nombre:nombre,apellido:apellido,carnet_identidad:carnet_identidad, telefono:telefono, id:id, usuario:usuario, contraseña:contraseña, rol_usuario:rol_usuario, opcion:opcion },
      success:function(data){
        // var datos=JSON.parse(data);
        id=data[0].id;               
        nombre=data[0].nombre;
        apellido=data[0].apellido;
        carnet_identidad=data[0].carnet_identidad;
        usuario=data[0].usuario;
        telefono=data[0].telefono;
        password=data[0].password;                
        if( opcion==1){
          // tablaPersonas.row.add([id,nombre,apellido,carnet_identidad,telefono,usuario,password]).draw();
        }
        else {
          // tablaPersonas.row(fila).data([id,nombre,apellido,carnet_identidad,telefono,usuario,password]).draw();
        }     
      }
    });    
    var accesos_variables= ['cliente_reporte_acceso','disciplina_acceso', //1-2
    'disciplina_nuevo_acceso', 'instructor_acceso',                       //3-5  
    'instructor_nuevo_acceso', 'lista_asistencia_acceso','asistencia_acceso', //6-8
    'pago_acceso', 'pago_reporte_acceso', 'tienda_acceso',                    //9-11
    'tienda_nueva_venta_acceso', 'tienda_reporte_acceso','tienda_producto_acceso',//12-14
    'producto_acceso', 'producto_nuevo_acceso', 'producto_editar_acceso',      //15-17
    'producto_eliminar_acceso', 'usuario_nuevo_acceso'];                        //18-19
    
    var valores_accesos=new Array();
    if($('#rol_usuario').val()==2){      
      for(var i=0; i< accesos_variables.length;i++){      
        nombre_vari = "#"+accesos_variables[i];        
        if( $(nombre_vari).is(":checked")  ) {
          valores_accesos[i]=1;
        }else{
          valores_accesos[i]=0; 
        }    
      }
    }else{
      
      for(var i=0; i< accesos_variables.length;i++){     
        valores_accesos[i]=1; 
      }
    }
    opcion=6;
    final_val=JSON.stringify(valores_accesos);
    
    console.log("Array: "+valores_accesos);
    
    console.log("JSON Array: "+final_val);
    $.ajax({
      url:"bd/crud-usuario.php",
      type: "POST",      
      dataType: "json",
      async:false,
      data:{ final_val:final_val ,opcion:opcion},
      // data:{ valores_accesos : JSON.stringify(valores_accesos), accesos_variables : JSON.stringify(accesos_variables), opcion:opcion },
      // data:{  opcion:opcion },
      success:function(data){
        swal({
          title:"Se Agrego Correctamente",
          // text: "No existen unidades disponibles registradas en stock",
          text: "El nuevo usuario se agrego al sistema y esta listo para poder trabajar",
          type: "success",        
          footer: "<a href='productos.php'>Ver listado de productos</a>",
          showConfirmButton: true
        });
      }
    });  



    $("#modalCRUD").modal("hide");
    if (opcion==2){
      swal({
        title:"Reinicio de Sesión",
        text: "Para visualizar los datos actualizados debe volver a iniciar sesión",
        type: "warning",
        timer: 3500,
        showConfirmButton: false
      }, function(){
          window.open("perfil.php", "_self");
      }); 
    }else if(opcion==1){
      location.reload();
      return false;    
    }
   
  });
  // FIN - AGREGAR A LA BASE DE DATOS 
    $("#mostrar_array").click(function(){
      let accesos_variables= ['cliente_reporte_acceso','disciplina_acceso', //1-2
      'discplina_nuevo_acceso', 'instructor_acceso','instructor_acceso',    //3-5  
      'instructor_nuevo_acceso', 'lista_asistencia_acceso','asistencia_acceso', //6-8
      'pago_acceso', 'pago_reporte_acceso', 'tienda_acceso',                    //9-11
      'tienda_nueva_venta_acceso', 'tienda_reporte_acceso','tienda_producto_acceso',//12-14
      'producto_acceso', 'producto_nuevo_acceso', 'producto_editar_acceso',      //15-17
      'producto_eliminar_acceso', 'usuario_nuevo_acceso'];                        //18-19
  
      let valores_accesos=new Array();
      for(var i=0; i< accesos_variables.length;i++){
        nombre_vari = "#"+accesos_variables[i];        
        if( $(nombre_vari).is(":checked")  ) {
          valores_accesos[i]=1;
        }else{
          valores_accesos[i]=0; 
        }  
      }     
      
    });




  // EDITAR PERFIL
  $("#btnEditar").click(function(){
    id_rol_u=$.trim($("#id_rol_usuario").val());
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color","#007BFF");
    $(".modal-title").text("Editar Perfil");
    $(".modal-title").css("color","#ffffff");
    $("#btnGuardar").css("background-color","#007BFF");
    $("#btnGuardar").css("border-color","#007BFF");
    $("#btnGuardar").css("font-weight","500");
    $("#btnGuardar").text("Guardar");
    // $("#btnGuardar").css("border-color","#28a745");
    document.getElementById("btnGuardar").addEventListener("mouseover", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#006BDD";
      document.getElementById("btnGuardar").style.borderColor = "#006BDD";
    });
    document.getElementById("btnGuardar").addEventListener("mouseout", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#006BDD";
      document.getElementById("btnGuardar").style.borderColor = "#006BDD";
    });
    $("#modalCRUD").modal("show");
    opcion=5;
    $.ajax({
      url:"bd/recuperar-datos-perfil.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{opcion:opcion},
      success:function(data){        
        nombre=data.nombre;
        apellido=data.apellido;
        carnet_identidad=data.carnet_identidad;                        
        telefono=data.telefono;
        usuario=data.usuario;
        password=data.password;  
        id_rol=data.id_rol;  
        console.log(id_rol);
      }
      
    });
    $('#nombre_input').val(nombre);
    $('#apellido_input').val(apellido);
    $('#carnet_identidad_input').val(carnet_identidad);
    $('#telefono_input').val(telefono);
    $('#usuario_input').val(usuario);
    $('#contraseña_input').val(password);
    $('#contraseña_confirmar').val(password);
    $('#rol_usuario').val(id_rol).change();
    if(id_rol_u==2){      
      let in_rol_usuario= document.getElementById("rol_usuario");    
      in_rol_usuario.disabled=true;
    }    
    id=null;
    opcion=2; //Modificar
  });

  
  $('#estado_usuario').change(function() {
    fila=$(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion=4;
    var respuesta= confirm("¿Estas seguro de desactivar a este usuario?");
    if (respuesta){
      $.ajax({
        url:"bd/crud-usuario.php",
        type: "POST",        
        data:{ opcion:opcion, id:id },
        success:function(data){         

        }
      });
    }              
  });


  


    // ELIMINAR REGISTRO
    $(document).on("click",".btnBorrar", function(){
      fila=$(this);
      id = parseInt($(this).closest("tr").find('td:eq(0)').text());
      opcion=3;
      var respuesta= confirm("¿Estas seguro de elminar este registro?");
      if (respuesta){
        $.ajax({
          url:"bd/crud-usuario.php",
          type: "POST",
          dataType: "json",
          data:{ opcion:opcion, id:id },
          success:function(data){
            console.log("BORRO");
            // tablaPersonas.row(fila.parents('tr')).remove().draw();
            tablaPersonas.row(fila.parents('tr')).remove().draw();
  
          }
        });
      }
    });
    // FIN - ELIMINAR REGISTRO

    $('#rol_usuario').change(function(){
      Id_rol_usuario_select=$('#rol_usuario').val();
      if(Id_rol_usuario_select==1){     
        document.getElementById("checkboxs_de_control_de_accesos").style.display="none";
      }else{
        document.getElementById("checkboxs_de_control_de_accesos").style.display="block";
      }
    });

});