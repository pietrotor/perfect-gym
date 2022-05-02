$(document).ready(function(){

    tablaPersonas=$("#tablaPersonas").DataTable({  
      "aaSorting": [[ 0, "desc" ]],
        "columnDefs":[{
            "targets":-1,
            "data":null,
            "defaultContent":"<div class='text-center'><div class='btn-group'><a href='clientes.php'><button class='btn btn-primary btn-sm btnClienteDatos'><span class='material-icons'>remove_red_eye</span></button></a></div></div>",
      
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
    $(document).on("click",".btnClienteDatos", function(){
      fila=$(this).closest("tr");
      var data_fila=$("#tablaPersonas").DataTable().row(fila).data();
      carnet_identidad=fila.find('td:eq(3)').text();
      nombre=fila.find('td:eq(1)').text();
      apellido=fila.find('td:eq(2)').text();
      sexo=fila.find('td:eq(4)').text();
      
      $.ajax({
        url:"bd/clientes-datos.php",
        type: "POST", 
        async:false,       
        data:{ carnet_identidad:carnet_identidad,nombre:nombre,apellido:apellido,sexo:sexo},
        success:function(data){
          console.log("Paso la Variable");                   
          
        }
      });
    });    
});