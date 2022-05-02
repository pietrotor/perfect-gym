$(document).ready(function(){

    tablaPersonas=$("#tablaPersonas").DataTable({  
      "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnImprimir'><span class='material-icons'>print</span></button></div></div>",
      
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
      $(document).on("click",".btnImprimir", function(){//Mostrar modal imprimir
        fila=$(this).closest("tr");        
        id_pago=fila.find('td:eq(0)').text();  
        var id_membresia="";      
        $.ajax({
          url:"bd/pagos-lista.php",
          type: "POST",
          dataType: "json",
          async:false,
          data:{id_pago:id_pago},
          success:function(data){    
            alert(data[0].id_membresia)                    ;
            id_membresia=data[0].id_membresia;
          }
        });  
        document.getElementById('id-membresia').value=id_membresia; 
        $("#modalPDF").modal("show");
      });

});