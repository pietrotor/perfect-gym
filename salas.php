<?php

  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $consulta="SELECT id,sala FROM sala";
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <?php
   include_once("vistas/plantilla.php");
 ?>
  <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >SALAS</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnNuevo"><i class="fas fa-plus-circle"></i> Nueva Sala</button>                
                <a href="disciplinas.php"><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" id="btnNuevo"><i class="fas fa-arrow-circle-left"></i> Volver</button>                </a>
              </div>              
            </div>
          </div>
          <!-- Tabla -->
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table id="tablaDisciplinas" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-centered ">
                      <tr>
                        <th>Id</th>
                        <th>Número de la Sala</th>                        
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($data as $dat) {
                       ?>
                      <tr>
                        <td><?php echo $dat['id']; ?></td>
                        <td><?php echo $dat['sala']; ?></td>                     
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

        <!-- Modal 1 - CRUD salas -->
        <div class="modal fade" id="modalDisciplinas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="formDisciplinas">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="Nombre" class="col-form-label">Nombre de la Sala:</label>
                    <input type="text" class="form-control mr-auto" id="sala">
                  </div>                        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Fin - Modal -->

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
  
  <script type="text/javascript" src="js/main-salas.js"></script>

  </body>
</html>
