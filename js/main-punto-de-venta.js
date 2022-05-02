$(document).ready(function(){

    tablaPersonas=$("#tablaPersonas").DataTable({  
       
      "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><div class='btn-group'><a href='detalle-venta.php'><button class='btn btn-primary btnVentaDatos' data-toggle='tooltip' data-placement='top' title='Ver detalle de la venta'><i class='fas fa-info-circle'></i></button></a><button class='btn btn-danger btnAnularVenta' data-toggle='tooltip' data-placement='top' title='Anular Venta'><i class='fas fa-ban'></i></button></div></div>",
      
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
      $(document).on("click",".btnAnularVenta", function(){
        fila=$(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());   
        swal({
          title: "Esta Seguro de Anular la venta?",
          text: "Una vez anulada la venta no podra recuperar la información de la misma!",
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
              url:"bd/anular-venta.php",
              type: "POST",              
              dataType: "json",    
              async:false,  
              data:{id:id},
              success:function(data){                
                tablaPersonas.row(fila.parents('tr')).remove().draw();               
              }
            });
            swal("Anulado!", "Se anulo correctamente la venta", "success");
          } else {
            swal("Cancelado", "Se cancelo la operación", "error");
          }
        }); 
        
      });
     

});