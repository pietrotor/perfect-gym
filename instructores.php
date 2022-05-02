<?php

  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $consulta="SELECT id, nombre, apellido, carnet_identidad, telefono, profesion, sexo FROM instructor";
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>



 <?php
   include_once("vistas/plantilla.php");

  if($_SESSION['accesos_globales']['instructor_nuevo_acceso'] != $activo) {
    $ver_nuevo_instructor=$_SESSION['$ocultar'];
  }else{$ver_nuevo_instructor="";} 
 ?>
          <!-- INCIO CONTENIDO -->
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >INSTRUCTORES</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" <?php echo $ver_nuevo_instructor; ?> name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnNuevo"><i class="fas fa-user-plus"></i> Nuevo Instuctor</button>
              </div>

            </div>

          </div>
          <!-- Tabla -->
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaInstructores" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead class="text-centered ">
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Carnet de Identidad</th>
                      <th>Telefono</th>
                      <th>Profesion</th>
                      <th>Sexo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>
                      <td><?php echo $dat['nombre']; ?></td>
                      <td><?php echo $dat['apellido']; ?></td>
                      <td><?php echo $dat['carnet_identidad']; ?></td>
                      <td><?php echo $dat['telefono']; ?></td>
                      <td><?php echo $dat['profesion']; ?></td>
                      <td><?php echo $dat['sexo']; ?></td>
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
        <!-- Modal 1 - CRUD datos cliente -->
        <div class="modal fade" id="modalInstruc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="formInstructores">
                <div class="modal-body">
                <div class="row">
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Nombre: <span style="font-size:13px;color:red;"> *</span></label>
                    <input type="text" class="form-control mr-auto" id="nombre">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Apellido: <span style="font-size:13px;color:red;"> *</span></label>
                    <input type="text" class="form-control" id="apellido">
                  </div>                
                </div>
                <div class="row">
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Carnet de Identidad: <span style="font-size:13px;color:red;"> *</span></label>
                    <input type="number" class="form-control" id="carnet_identidad">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Telefono: <span style="font-size:13px;color:red;"> *</span></label>
                    <input type="number" class="form-control" id="telefono">
                  </div>                
                </div>
                <div class="row">
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Profesión: <span style="font-size:13px;color:red;"> *</span></label>
                    <input type="text" class="form-control" id="profesion">
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Sexo: <span style="font-size:13px;color:red;"> *</span></label>
                    <input type="text" class="form-control" id="sexo">
                  </div>
                </div>
                </div>
                  <span style="font-size:13px;color:#343A40;margin-left:20px;">Todos los campos con <span style="font-size:13px;color:red;"> *</span> son obligatorios</span>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Fin - Modal -->


      <!-- FIN DEL CONTENIDO -->
        </main>
      </div>
    </div>


  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">                        
  <script src="dist/js/scripts.js"></script>
  <script type="text/javascript" src="js/main-instru.js"></script>

  </body>
</html>
