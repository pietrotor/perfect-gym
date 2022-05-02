$(document).ready(function(){

    tablaPersonas=$("#tablaPersonas").DataTable({  
        "createdRow": function( row, data, dataIndex ) {            
            $(row).find('td:eq(6)').html("<div class='d-flex justify-content-center'><img src='"+data[6]+"' style='width:40px;height:40px;' class='card-img-top'></div>");
              
        },
      "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><div class='btn-group'><a href='productos.php'><button class='btn btn-primary btnVentaDatos' data-toggle='tooltip' data-placement='top' title='Ver detalle de la venta'><i class='fas fa-box-open'></i></button></div></a></div>",
      
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
      
      $(document).on("click",".btnVentaDatos", function(){
        fila=$(this).closest("tr");
        var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
        id=fila.find('td:eq(0)').text();            
        $.ajax({
          url:"bd/venta-datos.php",
          type: "POST",  
          async:false,        
          data:{id:id},
          success:function(data){
            console.log("Paso la Variable");                      
          }
        });
      });

});