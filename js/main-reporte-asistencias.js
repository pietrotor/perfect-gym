$(document).ready(function(){   
    tablaPersonas=$("#tablaPersonas").DataTable({
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
    //BOTON MENSUAL
    $( "#btnMensual" ).click(function() {     
      var date = new Date(); 
      var fd = new Date(date.getFullYear(), date.getMonth(), 1);
       var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
       var fd = date.today().clearTime().moveToFirstDayOfMonth();
       var firstday = fd.toString("MM/dd/yyyy"); 
       alert(firstday);





      
            
    });
});