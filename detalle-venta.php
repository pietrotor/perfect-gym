<?php
  include_once("vistas/plantilla.php");
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $usuario=$_SESSION['$id_usuario'];
  $tipo_rol=$_SESSION['$id_rol'];
  $id_venta_pasado = $_SESSION['id_venta'];

  $consulta="SELECT producto.id, producto.producto, producto.categoria, producto.precio, producto.foto, detalle_venta.cantidad, detalle_venta.total FROM producto INNER JOIN detalle_venta ON producto.id=detalle_venta.id_producto WHERE detalle_venta.id_venta='$id_venta_pasado'";   
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
 
<div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1>DETALLE VENTA</h1>                
              </div>
            </div>            

    </div>
            <!-- Tabla -->
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead class="text-centered">
                    <tr>
                      <th>Código</th>
                      <th>Producto</th>
                      <th>Categoria</th>
                      <th>Precio</th>                      
                      <th>Unidades</th>
                      <th>Total</th>
                      <th>Imagen</th>                      
                      <th>Ver</th>                      
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
                      <td><?php echo $dat['total']; ?></td>                      
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
        <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="dist/js/scripts.js"></script>
  <script type="text/javascript" src="js/detalle-venta.js"></script>
