<?php
  include_once("vistas/plantilla.php");

  if($_SESSION['accesos_globales']['tienda_nueva_venta_acceso'] != $activo) {
    $ver_tienda_nueva_venta=$_SESSION['$ocultar'];
  }else{$ver_tienda_nueva_venta="";} 

  if($_SESSION['accesos_globales']['tienda_reporte_acceso'] != $activo) {
    $ver_tienda_reporte=$_SESSION['$ocultar'];
  }else{$ver_tienda_reporte="";} 

  if($_SESSION['accesos_globales']['tienda_producto_acceso'] != $activo) {
    $ver_tienda_producto=$_SESSION['$ocultar'];
  }else{$ver_tienda_producto="";} 
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $usuario=$_SESSION['$id_usuario'];
  $tipo_rol=$_SESSION['$id_rol'];

  $consulta="SELECT venta.id, venta.total_venta, venta.fecha_venta, CONCAT(usuario.nombre,' ',usuario.apellido)as nombre
             FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta GROUP BY venta.id";   
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>


   <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1>PUNTO DE VENTA</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
              <a href="venta.php" <?php echo $ver_tienda_nueva_venta; ?>><button type="button" name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnNuevo"><i class="fas fa-cart-plus"></i> Nueva Venta</button></a>                
                <a href="productos.php" <?php echo $ver_tienda_producto; ?>><button type="button" name="button" class="btn btn-info mt-3 mb-3 font-weight-bold" id="btnReportes"><i class="fas fa-archive"></i> Productos</button></a>                
                <a href="reporte-tienda.php" <?php echo $ver_tienda_reporte; ?> ><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" id="btnReportes"><i class="fas fa-file-signature"></i> Reportes</button></a>
               
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
                      <th>Id</th>
                      <th>Total</th>
                      <th>Fecha</th>
                      <th>Vendedor</th>                      
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>
                      <td><?php echo $dat['total_venta']; ?></td>
                      <td><?php echo $dat['fecha_venta']; ?></td>
                      <td><?php echo $dat['nombre']; ?></td>                      
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script src="dist/js/scripts.js"></script>
  
  <script type="text/javascript" src="js/main-punto-de-venta.js"></script>

