function mostrar_swat_exitoso(titulo,mensaje){
  swal(titulo, mensaje, "success");
}
let imagenDefault='imagenes-productos/producto-default.png'
function cambiarsrc(id,src){
  var Imagen = document.getElementById(id);
  Imagen.src=src;
}
function foto_nueva_o_actualizada(str){
  let direccion_img = "imagenes-productos/imagenes-productos/"; // string a buscar en la cadena
  if (str.includes(direccion_img)){ //Comprobamos si se repite la direccion de la imagen
    return true; // Si repite la direccion
  }else{
    return false; // No repite la dirección
  }
}
function Registrar(url_de_foto){       
  var archivo = $("#seleccionararchivo").val();  
  if(archivo != ""){ // Preguntamos si se cargo un archivo o no
    var extension = archivo.split('.').pop();
    var nombrearchivo = $.trim($("#producto").val())+$.trim($("#categoria").val())+"."+extension;
      nombrearchivo = nombrearchivo.split(' ').join('_');    
    var formData= new FormData();
    var foto_url = $("#seleccionararchivo")[0].files[0];  
    formData.append('f',foto_url);    
    formData.append('nombrearchivo',nombrearchivo);         
    $.ajax({
        url:'subirimagen-producto.php',
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
    nombrearchivo = url_de_foto; // En caso no se cambie la foto se asigna la que ya existia
  }  
  return nombrearchivo;
}


$(document).ready(function(){
    foto="";
    tablaPersonas=$("#tablaPersonas").DataTable({      
        "createdRow": function( row, data, dataIndex ) {
            console.log(data[5]);
             $(row).find('td:eq(5)').html("<img src='"+data[5]+"' style='width:80px;height:80px;' class='card-img-top'>");           
              
        },  
        "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
          "targets":-1,
          "data":null,
          // "defaultContent":"<div class='text-center'><button class='btn btn-sm btn-primary btnEditar' ><span class='material-icons'>edit</span></button><button class='btn btn-sm btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button><a href='clientes.php'><button class='btn btn-sm btn-dark  btnClienteDatos' ><span class='material-icons'>visibility</span></button></a></div>",
          "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><span class='material-icons'>edit</span></button><button class='btn btn-danger btn-sm btnBorrar'><span class='material-icons'>delete_forever</span></button><button class='btn btn-sm btn-dark  btnVerProducto' ><span class='material-icons'>visibility</span></button></div></div>",
    
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
    $("#form_Productos").trigger("reset");
    $(".modal-header").css("background-color","#28a745");
    $(".modal-title").text("Nuevo Registro");
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
    $('#modal_productos').modal({backdrop: 'static', keyboard: false})
    $("#modal_productos").modal("show");
    id=null;
    opcion=1; //agregar
  });
  //FIN - MOSTRAR EL MODAL

  $("#form_Productos").submit(function(e){
    e.preventDefault();
    console.log('Empieza el Proceso');    
    archivo_nombre=Registrar(foto);                
    archivo_nombre="imagenes-productos/"+archivo_nombre;     
    if (foto_nueva_o_actualizada(archivo_nombre)){
      archivo_nombre = foto;
    }
    alert(archivo_nombre);
    producto = $.trim($("#producto").val());
    precio = $.trim($("#precio").val());
    stock = $.trim($("#stock").val());
    categoria = $.trim($("#categoria").val());
    descripcion = $.trim($("#descripcion").val());    
    $.ajax({
      url:"bd/crud-producto.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{ id:id, producto:producto, precio:precio ,stock:stock, descripcion:descripcion, archivo_nombre:archivo_nombre, categoria:categoria, opcion:opcion},
      success:function(data){                       
        console.log("SE agrego");
        if(opcion==1){
          tablaPersonas.row.add([data[0].id, data[0].producto, data[0].categoria, data[0].precio, data[0].stock, data[0].foto]).draw();        
          mostrar_swat_exitoso("Producto Agregado", "Se agrego el producto de manera exitosa al sistema");
        }else if( opcion==2)         {          
          tablaPersonas.row(fila).data([data[0].id, data[0].producto, data[0].categoria, data[0].precio, data[0].stock, data[0].foto]).draw();
          fila.find('td:eq(5)').html("<img src='"+data[0].foto+"' style='width:80px;height:80px;' class='card-img-top'>");          
          mostrar_swat_exitoso("Producto Modificado", "Se modifico los datos del producto de manera exitosa");
        }
      }
    });    
    $("#modal_productos").modal("hide");
    $(".modal-header").css("background-color","#007bff");
    $(".modal-title").text("Clases");   

  });
  // FIN - AGREGAR A LA BASE DE DATOS 

// --EDITAR--
$(document).on("click",".btnEditar", function(){
  id_acceso_editar=$.trim($("#id_editar_producto").val());
  id_rol=$.trim($("#id_rol_usuario").val());
  if(id_acceso_editar==0 && id_rol == 2)  {
    swal({
      title:"Sin Acceso",
      // text: "No existen unidades disponibles registradas en stock",
      text: "Su cuenta no tiene accesos para realizar estas acciones",
      type: "error",        
      footer: "<a href='productos.php'>Ver listado de productos</a>",
      showConfirmButton: true
    });
  }else{
    fila=$(this).closest("tr");
    var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
    id = parseInt(fila.find('td:eq(0)').text());
    //INICIO RECUPERACIÓN DE DATOS
  
    $.ajax({
      url:"bd/recuperar-datos-producto.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{  id:id },
      success:function(data){        
        producto=data.producto;
        categoria=data.categoria;
        precio=data.precio;
        stock=data.stock;
        descripcion=data.descripcion;     
        foto=data.foto;     
        if(foto===''){
          foto=imagenDefault;
        }
      }
    });
    let in_producto= document.getElementById("producto");
    let in_precio= document.getElementById("precio");
    let in_stock= document.getElementById("stock");
    let in_categoria= document.getElementById("categoria");
    let in_descripcion= document.getElementById("descripcion");    
    in_producto.disabled=false;
    in_precio.disabled=false;
    in_stock.disabled=false;
    in_categoria.disabled=false;
    in_descripcion.disabled=false;
    $("#producto").val(producto);
    $("#precio").val(precio);
    $("#stock").val(stock);
    $("#categoria").val(categoria);
    $("#descripcion").val(descripcion); 
    cambiarsrc('mostrarimagen',foto);
    opcion=2; //editar    
    // $("#form_Productos").trigger("reset");
    $(".modal-header").css("background-color","#007bff");
    $(".modal-title").text("Editar Registro");
    $(".modal-title").css("color","#ffffff");
    $("#btnGuardar").css("background-color","#007bff");
    $("#btnGuardar").css("border-color","#007bff");
    $("#btnGuardar").css("font-weight","500");
    $("#btnGuardar").css("display","block");    
    $("#btnGuardar").text("Guardar");    
    // $("#btnGuardar").css("border-color","#007bff");
    $("#seleccionararchivo").css("display","block");
    document.getElementById("btnGuardar").addEventListener("mouseover", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#0665CB";
      document.getElementById("btnGuardar").style.borderColor = "#0665CB";
    });
    document.getElementById("btnGuardar").addEventListener("mouseout", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#007bff";
      document.getElementById("btnGuardar").style.borderColor = "#007bff";
    });
    $('#modal_productos').modal({backdrop: 'static', keyboard: false})
    $("#modal_productos").modal("show");
  }
});

// ELIMINAR PRODUCTO

$(document).on("click",".btnBorrar", function(){
  id_rol_u=$.trim($("#id_rol_usuario").val());
  if(id_rol_u==2)  {
    swal({
      title:"Sin Acceso",
      // text: "No existen unidades disponibles registradas en stock",
      text: "Su cuenta no tiene accesos para realizar estas acciones",
      type: "error",        
      footer: "<a href='productos.php'>Ver listado de productos</a>",
      showConfirmButton: true
    });
  }else{
    
  }
});

 // ELIMINAR REGISTRO
 $(document).on("click",".btnBorrar", function(){
  id_rol_u=$.trim($("#id_rol_usuario").val());
  id_acceso_eliminar=$.trim($("#id_elminar_producto").val());
  if( id_acceso_eliminar==0 && id_rol_u==2)  {
    swal({
      title:"Sin Acceso",
      // text: "No existen unidades disponibles registradas en stock",
      text: "Su cuenta no tiene accesos para realizar estas acciones",
      type: "error",        
      footer: "<a href='productos.php'>Ver listado de productos</a>",
      showConfirmButton: true
    });
  }else{
    fila=$(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion=3;
    //var respuesta= confirm("¿Estas seguro de elminar este registro?");
    swal({
     title: "Esta Seguro de Eliminar?",
     text: "Una vez eleminado el producto no sera capaz de poder recuperarlo!",
     type: "warning",
     showCancelButton: true,
     confirmButtonClass: "btn-danger",
     confirmButtonText: "Si, adelante!",
     cancelButtonText: "No, cancelar!",
     closeOnConfirm: false,
     closeOnCancel: false
   },
   function(isConfirm) {
     if (isConfirm) {
       $.ajax({
         url:"bd/crud-producto.php",
         type: "POST",
         dataType: "json",
         data:{ opcion:opcion, id:id },
         success:function(data){
           console.log("BORRO");
           // tablaPersonas.row(fila.parents('tr')).remove().draw();
           tablaPersonas.row(fila.parents('tr')).remove().draw();
         }
       });
       swal("Eliminado!", "Se elimino correctamente el producto seleccionado", "success");
     } else {
       swal("Cancelado", "Se cancelo la operación", "error");
     }
   });    
  }
 });
 // FIN - ELIMINAR REGISTRO

// VER PRODUCTO

$(document).on("click",".btnVerProducto", function(){
  fila=$(this).closest("tr");
    var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
    id = parseInt(fila.find('td:eq(0)').text());
    //INICIO RECUPERACIÓN DE DATOS
  
    $.ajax({
      url:"bd/recuperar-datos-producto.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{  id:id },
      success:function(data){        
        producto=data.producto;
        categoria=data.categoria;
        precio=data.precio;
        stock=data.stock;
        descripcion=data.descripcion;     
        foto=data.foto;     
        if(foto===''){
          foto=imagenDefault;
        }
      }
    });
    let in_producto= document.getElementById("producto");
    let in_precio= document.getElementById("precio");
    let in_stock= document.getElementById("stock");
    let in_categoria= document.getElementById("categoria");
    let in_descripcion= document.getElementById("descripcion");    
    in_producto.disabled=true;
    in_precio.disabled=true;
    in_stock.disabled=true;
    in_categoria.disabled=true;
    in_descripcion.disabled=true;
    $("#producto").val(producto);    
    $("#precio").val(precio);
    $("#stock").val(stock);
    $("#categoria").val(categoria);
    $("#descripcion").val(descripcion); 
    cambiarsrc('mostrarimagen',foto);    
    opcion=2; //editar    
    // $("#form_Productos").trigger("reset");
    $(".modal-header").css("background-color","#28a745");
    $(".modal-title").text("Ver Producto");
    $(".modal-title").css("color","#ffffff");
    $("#btnGuardar").css("background-color","#28a745");
    $("#btnGuardar").css("border-color","#28a745");
    $("#btnGuardar").css("font-weight","500");
    $("#btnGuardar").css("display","none");    
    $("#btnGuardar").text("Guardar");    
    // $("#btnGuardar").css("border-color","#28a745");
    $("#seleccionararchivo").css("display","none");
    document.getElementById("btnGuardar").addEventListener("mouseover", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#259A40";
      document.getElementById("btnGuardar").style.borderColor = "#259A40";
    });
    document.getElementById("btnGuardar").addEventListener("mouseout", function() {
      document.getElementById("btnGuardar").style.backgroundColor = "#28a745";
      document.getElementById("btnGuardar").style.borderColor = "#28a745";
    });
    $('#modal_productos').modal({backdrop: 'static', keyboard: false})
    $("#modal_productos").modal("show");
});
});