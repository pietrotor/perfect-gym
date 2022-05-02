$(document).ready(function(){
    var id,opcion,id_membre;
    id_membre='';
    opcion=4;
    tablaPersonas=$(".tablaPersonas").DataTable({
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
      // ]
      
  
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
  //   $( "#btnFiltrar" ).click(function() {  
  //     desde = $("#fecha_ini").val();
  //     hasta = $("#fecha_fin").val();
  //     opcion=1;
  //     if(desde != "" && hasta!=""){
  //       // $.ajax({
  //       //     type:'POST',
  //       //     url:'agrupado_reporte.php',
  //       //     data:{desde:desde, hasta:hasta},
  //       //     success:function(data){
  //       //         console.log('busca');
  //       //         $("#reportes_html").html(data);
  //       //     }
  //       // });        
  //     }
  //     else{
  //       alert("ELEGIA LA FECHA DE INICIO Y DE FINALIZACIÓN")
  //     }
  // }); 
   
});
