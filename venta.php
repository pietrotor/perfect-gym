<?php
  include_once("vistas/plantilla.php");
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $consulta = "SELECT producto.id, producto.producto, producto.categoria, producto.precio, producto.foto, detalle_venta.cantidad FROM producto INNER JOIN detalle_venta ON producto.id=detalle_venta.id_producto WHERE detalle_venta.id_venta='-1'";
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  // CONSULTA DINERO TOTAL
  $consulta2 = "SELECT SUM(total) as total FROM detalle_venta WHERE id_venta='-1'";
  $resultado_total=$conexion->prepare($consulta2);
  $resultado_total->execute();
  $data_total=$resultado_total->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <style>
 body{
  font-family: 'Roboto', sans-serif;
  font-weight:1000;
 }
  #result {
   position: absolute;
   width: 100%;
   max-width:1080px;
   cursor: pointer;
   overflow-y: auto;
   max-height: 200px;
   box-sizing: border-box;
   z-index: 1001;
  }
  .link-class:hover{   
   background-color:#E5E5E5;
  }
  #tablaPersonas tbody td, #tablaPersonas th{    
    text-align: center;       
  }
  #tablaPersonas tbody th, #tablaPersonas tbody td {
    padding: 6px 0px 6px 0px;  /* e.g. change 8x to 4px here */
}
#tablaPersonas th{
  font-family: 'Roboto', sans-serif;
  color:white;
  background:#03A9F4;
}

  </style>
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
 <br /><br />   
  <div class="container" >
   <h1 align="center">Punto de Venta</h1>   
   <br />
   <div id="cotenedor_doble">
    <div align="center">
      <input type="text" name="search" id="search" placeholder="Buscar productos"  autocomplete="off" class="form-control" />
    </div>
    <ul class="list-group" id="result"></ul>   
  </div>
   <br />
  </div>


  <!-- Tabla -->
  <div class="container">
        <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead class="text-centered">
                    <tr>
                      <th>Id</th>
                      <th>Producto</th>
                      <th>Categoria</th>
                      <th>Precio</th>
                      <th>Unidades</th>                      
                      <th>Imagen</th>                                                             
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>
                      <td><?php echo $dat['producto']; ?></td>
                      <td><?php echo $dat['categoria']; ?></td>                      
                      <td><?php echo $dat['precio']; ?></td>                      
                      <td><?php echo $dat['cantidad']; ?></td>                      
                      <td><?php echo $dat['foto']; ?></td>
                      <td></td>     
                    </tr>
                    <?php
                        }
                     ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Fin - Tabla -->
<div class="container">
  <div class="row d-flex" style="align-items: center;">
    <div class="col-lg-9">                     
      <button class='btn btn-primary btn-md' id="Fin_Venta" style="font-weight:800;font-size:20px"><i class="fas fa-clipboard-check"></i> FINALIZAR VENTA</button>                  
    </div>
    <div class="col-lg-3">
      <div class="text-right " style="display:block;" >    
      <?php
        foreach ($data_total as $dat) { 
          if($dat['total']==null){$dat['total']=0;}
     ?>  
       <span style="font-size:25px; margin-right:15px; margin-top:0;">TOTAL </span><span id="total" style="font-size:25px;"><?php echo $dat['total']; ?> Bs</span>
      <?php
        }
      ?>
      </div>    
    </div>
  </div>
</div>
 </body>
</html>

<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <!-- Botones para los datatables JS -->
  <script type="text/javascript" src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>                      
  <script type="text/javascript" src="datatables/JSZip-2.5.0/jszip.min.js"></script>                      
  <script type="text/javascript" src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>                      
  <script type="text/javascript" src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>                     
  <script type="text/javascript" src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script src="dist/js/scripts.js"></script>
  
  <script type="text/javascript" src="js/main-ventas.js"></script>

<script type="text/javascript">
// let id_produ="valor inicial";
//   function alerta(id){          
//           document.getElementById("search").value = "";
//           producto = $("#search").val();
//             // $.ajax({
//             //     type:'POST',
//             //     url:'search.php',
//             //     data:{producto:producto},
//             //     success:function(data){                    
//             //         $("#result").html(data);                                                                        
//             //     }
//             // });
//           id_produ=id;
//           // alert("VALOR FINAL "+id_produ);
//           // $("#result").css("display", "none");
//           $("#result").empty();
//     }    
//     $(document).ready(function(){          
//         $("#search").keyup(function(){
//           // $("#result").css("display", "block");
//             producto = $("#search").val();
//             $.ajax({
//                 type:'POST',
//                 url:'search.php',
//                 data:{producto:producto},
//                 success:function(data){
//                     console.log('busca');
//                     $("#result").html(data);
//                 }
//             });
//         });       
     
//     });



</script>