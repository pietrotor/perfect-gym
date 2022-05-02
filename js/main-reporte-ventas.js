$(document).ready(function(){   
    tablaPersonas=$("#tablaPersonas").DataTable({
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><div class='btn-group'><a href='detalle-venta.php'><button class='btn btn-primary btnVentaDatos' data-toggle='tooltip' data-placement='top' title='Ver detalle de la venta'><i class='fas fa-info-circle'></i></button></a></div></div>",
      
          }/* ,
          {
            "targets":[-3,-4,-5],
            "visible":false,
          } */
          ],  
      "aaSorting": [[ 0, "desc" ]],      
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
          },
          responsive:"true",
          dom: 'Bfrtilp',
          buttons:[
            {
              extend: 'excelHtml5',
              text: '<i class="fas fa-file-excel"></i>',
              titleAttr: 'Exportar a Excel',
              className: 'btn btn-success'
            },
            {
              extend: 'pdfHtml5',
              text: '<i class="fas fa-file-pdf"></i>',
              titleAttr: 'Exportar a PDF',
              className: 'btn btn-danger'
            },
            {
              extend: 'print',
              text: '<i class="fas fa-print"></i>',
              titleAttr: 'Imprimir',
              className: 'btn btn-info'
            },
          ]
  
    });   
     //BOTON DIARIO
     $( "#btnDiario" ).click(function() {      
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);      
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        $('#fecha_ini').val(today);
        $('#fecha_fin').val(today);     
              
      });
      //BOTON SEMANAL
      $( "#btnSemanal" ).click(function() {      
        function getMonday(d) {
          d = new Date(d);
          const day = d.getDay();
          const diff = d.getDate() - day + (day == 0 ? -6 : 1);
          return new Date(d.setDate(diff));
        }
        
        $('#fecha_ini').val(getMonday(new Date()).toISOString().substring(0, 10));
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);      
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;      
        $('#fecha_fin').val(today);     
              
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