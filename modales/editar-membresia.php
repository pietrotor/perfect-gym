<div class="modal fade" id="modalEditarMembresia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Membresia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formClases">
        <div class="modal-body">                
            <input type="text" class="d-none" id="id-cliente"><!-- GUARDAR EL ID del cliente -->      
            <div class="row">
              <!-- Slect de las clases -->
              <div class="form-group col-lg-5">
                <label for="Nombre" class="col-form-label">Clase:</label>
                <select class="form-control" name="cliente" id="id-clase">
                <option value="0">Seleccione una disciplina</option>
                  <?php
                    $consulta="SELECT id, clase FROM clase";
                    $resultado=$conexion->prepare($consulta);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                  ?>
                  <?php
                    foreach ($data as $dat) {
                  ?>
                  <option value="<?php echo $dat['id']; ?>"><?php echo $dat['clase']; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
              <!-- Fin - Select de las clases -->
              <div class="form-group col-lg-7">
                <label for="Nombre" class="col-form-label">Horarios:</label>
                <select class="form-control" name="horas" id="horario">                                      
                </select>
              </div>                  
            </div>                            
            <div class="row">
              <div class="form-group col-lg-2">
                <label for="Nombre" class="col-form-label">Precio:</label>
                <input type="text" class="form-control" id="precio" disabled>
              </div>                                                        
              <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Sesiones:</label>
                <input type="text" class="form-control" id="sesiones" disabled>
              </div>                 
              <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Instructor:</label>
                <input type="text" class="form-control" id="instructor" disabled>                      
              </div> 
              <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Cupos Disponibles:</label>
                <input type="text" class="form-control" id="cupos_disponibles" disabled>                      
              </div>                               
            </div>   
            <div class="row"> 
              <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Sala:</label>
                <input type="text" class="form-control" id="id_sala" disabled>                      
              </div>               
              <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Fecha de inicio:</label>
                <input type="date" class="form-control" id="fecha_ini" value="<?php echo date("Y-m-d") ?>">
              </div>
              <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Fecha de finalizacion:</label>
                <input type="date" class="form-control" id="fecha_fin" value="<?php
                  $date = date("Y-m-d");
                  echo date('Y-m-d', strtotime($date.' + 1 month'));
                ?>" disabled>
              </div>                 
            </div>  
          

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="submit" id="btnMembresia" class="btn btn-primary">Registrar</button>
        </div>                

      </form>
    </div>
  </div>
</div>
