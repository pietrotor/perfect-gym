

<?php 
include_once("bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
// CONSULTA INICIAL
// $consulta="SELECT asistencia.Id, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restante
// FROM (cliente INNER JOIN ((instructor INNER JOIN clase ON instructor.id = clase.id_instructor) INNER JOIN membresia ON clase.id = membresia.id_clase) 
// ON cliente.id = membresia.id_cliente) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia ORDER BY asistencia.id DESC";
$consulta="SELECT cliente.*, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restantes, asistencia.id as id_asis
FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente)
ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia ORDER BY asistencia.id DESC";

$resultado=$conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

include_once("vistas/plantilla.php");
?>

<div class="container">
    <div class="row">
        <div class="col text-center mt-5 h1-titulos">
            <h1 >LISTA DE ASISTENTES</h1>
        </div>
        <div class="col-lg-12">
                
                <a href="reporte-asistencias.php"><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" id="btnReportes"><i class="fas fa-file-signature"></i> Reportes</button></a>
              </div>
    </div>
</div>
<!-- TABLA -->
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
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Sesiones Restantaes</th>                      
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id_asis']; ?></td>
                      <td><?php echo $dat['nombre']; ?></td>
                      <td><?php echo $dat['apellido']; ?></td>
                      <td><?php echo $dat['carnet_identidad']; ?></td>
                      <td><?php echo $dat['clase']; ?></td>
                      <td><?php echo $dat['fecha_ingreso']; ?></td>
                      <td><?php echo $dat['hora_ingreso']; ?></td>
                      <td><?php echo $dat['sesiones_restantes']; ?></td>    
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
<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <script src="dist/js/scripts.js"></script>
  <script type="text/javascript" src="js/lista-asistencia.js"></script>

  </body>
</html>