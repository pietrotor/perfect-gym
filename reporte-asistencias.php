<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  function asistentes($conexion,$consulta_asistentes){  
    $resultado2=$conexion->prepare($consulta_asistentes);
    $resultado2->execute();
    $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
   foreach ($data2 as $dat) {
      $totalsuma=$dat['asistentes'];
   }
   if($totalsuma==NULL){$totalsuma=0;}
   return $totalsuma;
  }

  //RECIBIMOS LOS DATOS
  $date = date("Y-m-d");
  $date_hoy = date('Y-m-d', strtotime($date. '  - 1 month'));
  $disciplina=(isset($_GET['disciplina'])) ? $_GET['disciplina'] : '0'; 
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : '';    
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
  $date = date("Y-m-d");

  //CASOS DE IF
  
  if(($disciplina != 0) && ( $desde!='') && ( $hasta!='')){  

    // $consulta="SELECT asistencia.Id, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restante
    // FROM (cliente INNER JOIN ((instructor INNER JOIN clase ON instructor.id = clase.id_instructor) INNER JOIN membresia ON clase.id = membresia.id_clase) 
    // ON cliente.id = membresia.id_cliente) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia 
    // WHERE  asistencia.fecha_ingreso BETWEEN '$desde' AND '$hasta' AND clase.id = $disciplina   ORDER BY asistencia.id DESC";

    $consulta="SELECT cliente.*, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restantes, asistencia.id as id_asistencia
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
    ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia
    WHERE  asistencia.fecha_ingreso BETWEEN '$desde' AND '$hasta' AND clase.id = $disciplina   ORDER BY asistencia.id DESC";

    $consulta_asistentes="SELECT COUNT(asistencia.id) AS asistentes
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia
     ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia 
    WHERE  asistencia.fecha_ingreso BETWEEN '$desde' AND '$hasta' AND clase.id = $disciplina   ORDER BY asistencia.id DESC";
  } else if(($disciplina == 0) && ( $desde!='') && ( $hasta!='')) {

    $consulta="SELECT cliente.*, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restantes, asistencia.id as id_asistencia
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
    ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia
    WHERE  asistencia.fecha_ingreso BETWEEN '$desde' AND '$hasta' ORDER BY asistencia.id DESC";

    $consulta_asistentes="SELECT COUNT(asistencia.id) AS asistentes
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia 
    ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia 
    WHERE  asistencia.fecha_ingreso BETWEEN '$desde' AND '$hasta' ORDER BY asistencia.id DESC";

  }else{
   // CONSULTA INICIAL
    $consulta="SELECT cliente.*, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restantes, asistencia.id as id_asistencia
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
    ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia
    ORDER BY asistencia.id DESC";
    $consulta_asistentes="SELECT COUNT(asistencia.id) AS asistentes
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia 
    ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia  ORDER BY asistencia.id DESC";
  }

  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
<?php
  include_once("vistas/plantilla.php");
?>

          <!-- INCIO CONTENIDO -->
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >Reporte de Asistencias</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">                
              </div>

            </div>
          </div>
          <form action="reporte-asistencias.php" class="ml-4 mr-4">
          <div class="row">
            <div class="btn-group btn-group" role="group" aria-label="Large button group">
              <button type="button" class="btn btn-dark" style="font-weight:600;"id="btnSemanal">Semanal</button>
              <button type="button" class="btn btn-dark" style="font-weight:600;"id="btnDiario">Diario</button>             
              
            </div>
          
          </div>
          <div class="row">                          
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Desde:</label>
                  <input type="date" class="form-control" name="desde" id="fecha_ini" value="<?php echo $desde ?>">
                </div>  
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Hasta:</label>
                  <input type="date" class="form-control" name="hasta" id="fecha_fin" value="<?php echo $hasta ?>">
                </div>  
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Disciplinas:</label>
                  <select class="form-control" name="disciplina" id="id-clase">
                    <option value="0">Todas las disciplinas</option>
                      <?php
                        $consulta2="SELECT id, clase FROM clase";
                        $resultado2=$conexion->prepare($consulta2);
                        $resultado2->execute();
                        $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <?php
                        foreach ($data2 as $dat) {
                      ?>
                      <option value="<?php echo $dat['id'];?>" <?php if($disciplina==$dat['id']){ echo 'selected';  }  ?> > <?php echo $dat['clase']; ?></option>
                      <?php
                        }
                      ?>
                  </select>
                </div>   
                <div class="form-group col-lg-3  align-self-end">
                  <button type="submit" id="btnMembresia" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar Registros</button>                  
                </div>
                  
          
          </div>
          
          </form>
          <div class="container">
            <div class="row d-flex justify-content-center " >
              <div class="col-lg-4">
                  <div class="card text-center">
                      <div class="card-header bg-primary text-white">
                        <div class="row align-items-center">
                          <div class="col">
                            <i class="fas fa-users fa-4x"></i>
                          </div>
                          <div class="col">
                            <h3 class="display-4"><?php echo asistentes($conexion,$consulta_asistentes) ?></h3>
                            <h6>Asistentes</h6>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <h5>
                          <a href="#" class="text-primary">Total Asistentes</a>
                        </h5>
                      </div>
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
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Carnet de Identidad</th>
                      <th>Clase</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Sesiones Restantaes</th>                      
                                       
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id_asistencia']; ?></td>
                      <td><?php echo $dat['nombre']; ?></td>
                      <td><?php echo $dat['apellido']; ?></td>
                      <td><?php echo $dat['carnet_identidad']; ?></td>
                      <td><?php echo $dat['clase']; ?></td>
                      <td><?php $fecha = date("d/m/Y", strtotime($dat['fecha_ingreso'])); echo $fecha ; ?></td>
                      <td><?php echo $dat['hora_ingreso']; ?></td>
                      <td><?php echo $dat['sesiones_restantes']; ?></td>    
                        
                      
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
  <!-- Botones para los datatables JS -->
  <script type="text/javascript" src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>                      
  <script type="text/javascript" src="datatables/JSZip-2.5.0/jszip.min.js"></script>                      
  <script type="text/javascript" src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>                      
  <script type="text/javascript" src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>                     
  <script type="text/javascript" src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>  
  <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>    
  <script src="dist/js/scripts.js"></script>

  <!-- Codigo propio JS -->
  <script type="text/javascript" src="js/main-reporte-asistencias.js"></script>

  </body>
</html>
