<?php

  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $consulta="SELECT * FROM clase";
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <?php
   include_once("vistas/plantilla.php");

   if($_SESSION['accesos_globales']['disciplina_nuevo_acceso'] != $activo) {
    $ver_nueva_disciplina=$_SESSION['$ocultar'];
  }else{$ver_nueva_disciplina="";} 
 ?>
 <link rel="stylesheet" type="text/css" href="clockpicker.css">
 
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >DISCIPLINAS</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">                
                <button type="button" name="button" class="btn btn-success mt-3 mb-3 font-weight-bold " style="display:none;" id="BTNhORA"><i class="fas fa-dumbbell"></i> HORARIOS</button>                
                <button type="button" <?php echo $ver_nueva_disciplina; ?>  name="button" class="btn btn-success mt-3 mb-3 font-weight-bold " id="btnnuevadisci"><i class="fas fa-dumbbell"></i> Nueva Disciplina</button>
                <a href="salas.php"><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" id="btnNuevo"><i class="fas fa-person-booth"></i> Salas</button></a>
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
                        <th>Disciplina</th>                       
                        <th>Descripción</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($data as $dat) {
                       ?>
                      <tr>
                        <td><?php echo $dat['id']; ?></td>
                        <td><?php echo $dat['clase']; ?></td>                                               
                        <td><?php echo $dat['descripcion']; ?></td>                        
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


        <!-- Modal 1 - CRUD disciplina MODIFICADO -->
        <div class="modal fade" id="modalNuevoDisciplinas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="formAgregarDisciplina">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="Nombre" class="col-form-label">Disciplina:</label>
                    <input type="text" class="form-control mr-auto" id="disciplina_input">
                  </div>                      
                  <div class="form-group">
                    <label for="Nombre" class="col-form-label">Descripción:</label>                    
                    <textarea class="form-control mr-auto" rows="3" id="descripcion_input"></textarea>
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
  <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <!-- SMART WIZARD -->
  <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <!-- FIN -->
  <script src="dist/js/scripts.js"></script>
  <script type="text/javascript" src="js/main-disci.js"></script>
  <script src="clockpicker.js"></script>
  <script type="text/javascript">
            $('#smartwizard').smartWizard({
                theme: 'arrows',
                lang: { // Language variables for button
                    next: 'Siguiente',
                    previous: 'Anterior'
                },
                selected:0
            });
    // $('.clockpicker').clockpicker({
    // placement: 'top',
    // align: 'left',
    // donetext: 'Listo'
    // });
    var input = $('#ini_hora1');
      input.clockpicker({
      autoclose: true,
      placement: 'top',
      align: 'left',
      donetext: 'Listo'
    });
    var input = $('#fin_hora');
      input.clockpicker({
      autoclose: true,
      placement: 'top',
      align: 'left',
      donetext: 'Listo'
    });
  </script>

  </body>
</html>
