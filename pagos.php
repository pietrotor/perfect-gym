<?php
  include_once("vistas/plantilla.php");
  
  if($_SESSION['accesos_globales']['pago_reporte_acceso'] != $activo) {
    $ver_pago_reporte=$_SESSION['$ocultar'];
  }else{$ver_pago_reporte="";} 

?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $usuario=$_SESSION['$id_usuario'];
  $tipo_rol=$_SESSION['$id_rol'];
  if ($tipo_rol==1){
    // $consulta="SELECT membresia_pago.id, cliente.nombre as clclient, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, clase.precio, usuario.nombre
    //          FROM (rol INNER JOIN usuario ON rol.id = usuario.id_rol) INNER JOIN ((cliente INNER JOIN (clase INNER JOIN membresia ON clase.Id = membresia.id_clase) ON 
    //          cliente.id = membresia.id_cliente) INNER JOIN membresia_pago ON membresia.Id = membresia_pago.id_membresia) ON usuario.id = membresia_pago.id_usuario";  
    $consulta="SELECT cliente.*, clase.clase, membresia_pago.monto, membresia_pago.fecha_pago, cliente.nombre as clclient, CONCAT(usuario.nombre, ' ',usuario.apellido) as nom_operador, membresia_pago.id as id_pago
               FROM cliente INNER JOIN (usuario INNER JOIN (((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia ON grupo.id = membresia.id_grupo) 
               INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON usuario.id = membresia_pago.id_usuario) ON cliente.id = membresia.id_cliente";  
  } else{
    // $consulta="SELECT membresia_pago.id, cliente.nombre as clclient, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, clase.precio, usuario.nombre
    //          FROM (rol INNER JOIN usuario ON rol.id = usuario.id_rol) INNER JOIN ((cliente INNER JOIN (clase INNER JOIN membresia ON clase.Id = membresia.id_clase) ON 
    //          cliente.id = membresia.id_cliente) INNER JOIN membresia_pago ON membresia.Id = membresia_pago.id_membresia) ON usuario.id = membresia_pago.id_usuario WHERE usuario.id='$usuario'";
    $consulta="SELECT cliente.*, clase.clase, membresia_pago.monto, membresia_pago.fecha_pago, cliente.nombre as clclient, CONCAT(usuario.nombre, ' ',usuario.apellido) as nom_operador, membresia_pago.id as id_pago
    FROM cliente INNER JOIN (usuario INNER JOIN (((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia ON grupo.id = membresia.id_grupo) 
    INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON usuario.id = membresia_pago.id_usuario) ON cliente.id = membresia.id_cliente
    WHERE usuario.id='$usuario'";
  }
  

  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>

 <!-- INCIO CONTENIDO -->
 <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >PAGOS MEMBRESIAS</h1>
              </div>
            </div>
            <div class="col-lg-12">
                
                <a href="reporte-pagos.php"<?php echo $ver_pago_reporte;?> ><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" id="btnReportes"><i class="fas fa-file-signature"></i> Reportes</button></a>
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
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Carnet de Identidad</th>
                      <th>Clase</th>
                      <th>Fecha de Pago</th>
                      <th>Monto</th>  
                      <th>Operador</th>  
                      <th>Opciones</th>  

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id_pago']; ?></td>
                      <td><?php echo $dat['clclient']; ?></td>
                      <td><?php echo $dat['apellido']; ?></td>
                      <td><?php echo $dat['carnet_identidad']; ?></td>
                      <td><?php echo $dat['clase']; ?></td>
                      <td><?php echo $dat['fecha_pago']; ?></td>
                      <td><?php echo $dat['monto']; ?></td>                      
                      <td><?php echo $dat['nom_operador']; ?></td>                      
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
      
      <!-- FIN DEL CONTENIDO -->
      <!-- INICIO MODAL  CREAR PDF -->
      <div class="modal fade" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title" id="exampleModalLongTitle" style="color:white;">IMPRIMIR COMPROBANTE DE INSCRIPCION</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formPDF" method="post" action="crear-pdf-general.php" target="_blank">
              <div class="modal-body">             
                <div class="form-group">
                  <input type="text" class="d-none" name="id-membresia" id="id-membresia"><!-- GUARDAR EL ID del cliente -->
                </div>
                   <p>¿Esta seguro de imprimir el comprobante de inscripción?</p>   
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnImprimir" class="btn btn-primary" >Impirmir</button>
              </div>        

            </form>
           </div>           
        </div>
      </div>

      <!-- FIN MODAL  -->
        </main>
      </div>
    </div>


  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <script src="dist/js/scripts.js"></script>
  <script type="text/javascript" src="js/pagos-lista.js"></script>
  
  </body>
</html>
