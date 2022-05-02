<?php
  include_once("vistas/plantilla.php");
?>
<div id="loading-screen" style="display:none">
    <img src="img/spinning-circles.svg">
</div>
          <!-- INCIO CONTENIDO -->
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >CONTROL DE ASISTENCIA</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 mt-5">
              <div class="alert alert-success alert-dismissible fade show" role="alert" id="estado">                
              
              </div>
              <div id = "alert_placeholder"></div>
              <form id="formAsistencia" class="mb-5">
                <div class="row">
              <div class="form-group col-lg-7">
                  <label for="Nombre" class="col-form-label font-weight-bold">Código de acceso: </label>
                  <input type="text" class="form-control cod-text" id="codigo_acceso" required>
               </div>  
               <div class="form-group col-lg-2 align-self-end">
                    <button class="btn btn-success botn-verificar" type="submit"><i class="fas fa-door-open "></i> INGRESAR</button>
               </div>
               <div class="form-group col-lg-3  align-self-end">
                    <a href="lista-asistencia.php" class="btn btn-dark botn-verificar" <?php echo $_SESSION['$ocultar']; ?> > <i class="fas fa-clipboard-list"></i> Lista de Asistentes</a>
               </div>
               </div>
                <fieldset disabled>
                <div class="row">
                  <div class="form-group col-lg-8">
                    <label for="Nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control mr-auto" id="nombre" >                    

                    <label for="Nombre" class="col-form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellido">

                    <label for="Nombre" class="col-form-label">Disciplina:</label>
                    <input type="text" class="form-control" id="discipli">

                  </div>
                  <div class="form-group col-lg-3 ml-lg-5">
                    <img src="imagenes/default-avatar.png" style="width:250px;height:250px;" id="foto-persona">
                  </div>
                </div>              
                  <div class="row">
                  <div class="form-group col-lg-4">
                    <label for="Nombre" class="col-form-label">Sesiones restantes:</label>
                    <input type="email" class="form-control" id="sesiones">
                  </div> 
                    <div class="form-group col-lg-4">
                      <label for="Nombre" class="col-form-label">Fecha de inscripcion:</label>                  
                      <input type="date" class="form-control" id="fecha_in">
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="Nombre" class="col-form-label">Fecha de caducidad:</label>
                      <input type="date" class="form-control" id="fecha_fin">
                    </div>                
                  </div>
                  
                </fieldset>               
            </form>
              </div>
            </div>
            
          </div>
  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <script src="dist/js/scripts.js"></script>
  <script type="text/javascript" src="js/asistencia.js"></script>
  
  <link href="estilos.css" rel="stylesheet">

  </body>
</html>