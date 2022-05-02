let id_produ="valor inicial";
let opcion=1;
var articulos = [];
let total_global=0;
var timerID;
$('#search, #result').focus(function() { //BORRAR SI NO PUEDES AGREGAR A LA TABLA
    clearTimeout(timerID);
    $("#result").show(500);
}).blur(function() {
    timerID = setTimeout(function() {
        $("#result").hide(500);
    }, 10);
}); 

function agregarProducto(id){          
        document.getElementById("search").value = "";
        producto = $("#search").val();          
        id_produ=id;
        opcion=1;         
        $.ajax({ //PARA AGREGAR AL DETALLE VENTA EL PRODUCTO
          url:"bd/agregar-venta.php",
          type: "POST",
          dataType: "json",
          async:false,
          data:{id_produ:id_produ, opcion:opcion},
          success:function(data){      
            console.log('FUNCIONA EL AJAX');
            total_global = parseFloat(total_global) + parseFloat(data[0].precio) ; //SUMAMOS AL TOTAL GLOBAL EL NUEVO PRODUCTO
            articulos.push({id:data[0].id, cantidad:1 });              
            tablaPersonas.row.add([data[0].id, data[0].producto, data[0].categoria, data[0].precio, 1, data[0].foto]).draw();        
          }
        });   
        opcion=3;   
        $.ajax({ //PARA AGREGAR AL DETALLE VENTA EL PRODUCTO
          url:"bd/agregar-venta.php",
          type: "POST",
          dataType: "json",
          async:false,
          data:{opcion:opcion},
          success:function(data){      
            total_global=data[0].acumulado;            
          }
        });      
        console.log(articulos);
        $("#result").empty(); 
        document.getElementById("total").innerHTML = total_global+" Bs";
} 


$(document).ready(function(){     
    tablaPersonas=$("#tablaPersonas").DataTable({
        "createdRow": function( row,  data, dataIndex ) {             
             $(row).find('td:eq(4)').html(" <input type='number'  min='1' max='99' style='width:100px;' min='1' class='form-control inpCantidad'  value='"+data[4]+"'>");           
            $(row).find('td:eq(5)').html("<div class='d-flex justify-content-center'><img src='"+data[5]+"' style='width:40px;height:40px;' class='card-img-top'></div>");           
          
      },
        "aaSorting": [[ 0, "desc" ]],       
        "columnDefs":[{
          "targets":-1,
          "data":null,
          // "defaultContent":"<div class='text-center'><button class='btn btn-sm btn-primary btnEditar' ><span class='material-icons'>edit</span></button><button class='btn btn-sm btn-danger btnBorrar'><span class='material-icons'>delete_forever</span></button><a href='clientes.php'><button class='btn btn-sm btn-dark  btnClienteDatos' ><span class='material-icons'>visibility</span></button></a></div>",
          "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-danger btn-sm btnBorrar'><span class='material-icons'>delete_forever</span></button></div></div>",
    
        },
        // {
        //   "targets":-3,
        //   "data":null,          
        //   "defaultContent":"<div class='d-flex justify-content-center'><input type='number' min='1' max='99' style='width:100px;' class='form-control inpCantidad' value='1'></div>",
    
        // }
        ],
    
        //cambiar el idioma a español
        "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No hay productos agregados al carrito",
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
            },
            //PERSONALIZA EL DATATABLE
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "searching": false,        
        "lengthChange": false,
        "info":false
      });     
      



    $("#search").keyup(function(){       
        producto = $("#search").val();
        $.ajax({
            type:'POST',
            url:'search.php',
            data:{producto:producto},
            success:function(data){
                console.log('busca');
                $("#result").html(data);
            }
        });
    });  
    $( "#btnprobar" ).click(function() {
        console.log('EL VALOR DEL ID ES: '+id_produ);
         $.ajax({
            url:"bd/agregar-venta.php",
            type: "POST",
            dataType: "json",
            data:{id_produ:id_produ},
            success:function(data){      
              console.log('FUNCIONA EL AJAX');
              tablaPersonas.row.add([data[0].id, data[0].producto, data[0].categoria, data[0].precio, data[0].stock, data[0].foto]).draw();        
            }
          });
      });     


       // BORRAR EL REGISTRO
  $(document).on("click",".btnBorrar", function(){    
    fila=$(this); 
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion=5;           
    $.ajax({ //BORRAMOS EL PRODUCTO
      url:"bd/agregar-venta.php",
      type: "POST", 
      dataType: "json",   
      async:false,   
      data:{id:id, opcion:opcion},
      success:function(data){            
        tablaPersonas.row(fila.parents('tr')).remove().draw();             
        total_global=data[0].total;
        if (total_global==null){
          total_global = 0;
        }        
      }
      
    });
    document.getElementById("total").innerHTML = total_global+" Bs";
  });
  $(document).on("change",".inpCantidad", function(){ //ACTULIZAR LA CANTIDAD A VENDER 
    estado =false;   
    fila=$(this).closest("tr");
    var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
    id = fila.find('td:eq(0)').text();  //ID DEL PRODUCTO    
    cantidad_inpu=$(this).val();  //CANTIDAD DE PRODUCTOS   
    console.log("EL CODIGO DEL PRODUCTO ES "+id+" Y SU CANTIDAD ES "+cantidad_inpu );
    opcion=4;
    $.ajax({ //VERIFICAMOS SI EXISTE EL STOCK NUEVO QUE QUEREMOS
      url:"bd/verificar-stock.php",
      type: "POST",
      dataType: "json",
      async:false,
      data:{cantidad_inpu:cantidad_inpu, id:id},
      success:function(data){          
        estado = data.estado;
        max_stock = data.stock;        
      }
    });
    if(estado == true){
      $.ajax({ //PARA AGREGAR AL DETALLE VENTA EL PRODUCTO, DESPUES DE VERIFICAR EL STOCK
        url:"bd/agregar-venta.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{opcion:opcion, cantidad_inpu:cantidad_inpu, id:id},
        success:function(data){      
          total_global=data[0].acumulado;             
        }
      });  
      document.getElementById("total").innerHTML = total_global+" Bs";
    }else{
      $(this).val(max_stock);   
      // INICIO DE PRUEBA
      $.ajax({ //ACTUALIZAR CON EL MAXIMO STOCK
        url:"bd/agregar-venta.php",
        type: "POST",
        dataType: "json",
        async:false,
        data:{opcion:opcion, cantidad_inpu:max_stock, id:id},
        success:function(data){      
          total_global=data[0].acumulado;             
        }
      });  
      document.getElementById("total").innerHTML = total_global+" Bs";
      // FIN DE PRUEBA
      swal({
        title:"Oops...Stock Insuficiente",
        // text: "No existen unidades disponibles registradas en stock",
        text: "Solo existen "+$(this).val()+" unidades",
        type: "error",        
        footer: "<a href='productos.php'>Ver listado de productos</a>",
        showConfirmButton: true
      });
    }
  });

  $(document).on("click","#Fin_Venta", function(){    //FINALIZAR VENTA
    opcion=6;
    filas=0;
    $.ajax({
      type:'POST',
      url:'bd/agregar-venta.php',
      dataType: "json",
      async:false,
      data:{opcion:opcion},
      success:function(data){        
        filas=data[0].filas;
      }
    });
    if(filas!=0){
      opcion=2;    
       $.ajax({
              type:'POST',
              url:'bd/agregar-venta.php',
              data:{opcion:opcion},
              success:function(data){  
                // window.open("venta.php", "_self");
                swal({
                  title:"Venta Realizada",
                  text: "Se realizo la venta de manera correcta",
                  type: "success",
                  timer: 2500,
                  showConfirmButton: false
                }, function(){
                    window.open("punto_de_venta.php", "_self");
                });
               
              
              }
        });
    }else{
      swal({
        title:"No se puede realizar la venta",
        text: "No tiene productos agregados en su carrito",
        type: "error",       
        confirmButtonColor: "#F71900",
        confirmButtonText: "Volver",
        showConfirmButton: true,        
      });
    }
  });
  
 
 
});
