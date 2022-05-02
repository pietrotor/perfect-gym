<?php

 include_once("bd/conexion.php");
 $objeto = new Conexion();
 $conexion=$objeto->Conectar();
 include_once("vistas/plantilla.php");
 // CONSULTA INICIAL
 $id_clase_var=$_SESSION['id_disciplina_tabla'];
 $consulta="SELECT grupo.id,grupo.denominacion, grupo.hora_inicio, grupo.hora_fin, grupo.precio, grupo.sesiones,CONCAT(instructor.nombre, ' ',instructor.apellido) AS instructor , sala.sala
 FROM sala INNER JOIN (instructor INNER JOIN grupo ON instructor.id = grupo.id_instructor) ON sala.id = grupo.id_sala
 WHERE grupo.id_clase = '$id_clase_var'";
 $resultado=$conexion->prepare($consulta);
 $resultado->execute();
 $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" type="text/css" href="clockpicker.css">
    <div class="container">   
        <div class="row">
            <div class="col text-center mt-5 h1-titulos">
                <h1 >HORARIOS</h1>
                <input type="text" class="form-control mr-auto" id="id_clase" value="<?php echo $_SESSION['id_disciplina_tabla'] ?>" style="display:none;">
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-12">
                <button type="button" name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnnuevohorario"><i class="fas fa-plus-circle"></i> Nuevo Horario</button>                                
            </div>              
        </div>
    </div>
    <!-- Tabla -->    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-centered ">
                            <tr>
                            <th>Id</th>
                            <th>Grupo</th>                       
                            <th>Hora de Inicio</th>
                            <th>Hora de Salida</th>                            
                            <th>Sesiones</th>                            
                            <th>Precio</th>
                            <th>Instructor</th>                            
                            <th>Sala</th>
                            <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $dat) {
                            ?>
                            <tr>
                            <td><?php echo $dat['id']; ?></td>
                            <td><?php echo $dat['denominacion']; ?></td>                                               
                            <td><?php $hor_f=substr($dat['hora_inicio'],0,5); echo $hor_f; ?></td>                        
                            <td><?php $hor_i=substr($dat['hora_fin'],0,5); echo $hor_i; ?></td>                                                     
                            <td><?php echo $dat['sesiones']; ?></td>                                                   
                            <td><?php echo $dat['precio']; ?></td>                                              
                            <td><?php echo $dat['instructor']; ?></td>                        
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
    <!-- Modal 1 - CRUD disciplina -->
    <div class="modal fade" id="Modal_Horarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="Form_Horarios">
                    <div class="modal-body" style="max-height:450px; overflow-y: auto;">   
                        <div class="container" style="border: 1.5px solid #C2C2C2;border-radius:4px; background-color:#ECECEC;">
                            <div class="row">
                                <div class="form-group col-lg-5">
                                    <label for="Nombre" class="col-form-label">Denominación:</label>
                                    <input type="text" class="form-control mr-auto" id="disciplina">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="Nombre" class="col-form-label">Instructor:</label>
                                    <select class="form-control" name="cliente" id="instructor">
                                        <?php
                                            $consulta="SELECT id, nombre,apellido FROM instructor";
                                            $resultado=$conexion->prepare($consulta);
                                            $resultado->execute();
                                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <?php
                                            foreach ($data as $dat) {
                                        ?>
                                        <option value="<?php echo $dat['id']; ?>"><?php echo $dat['nombre']." ".$dat['apellido']; ?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>                       
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="Nombre" class="col-form-label">Sesiones:</label>
                                    <input type="number" class="form-control" id="num_sesiones" required>
                                </div> 
                            </div>                          
                            <div class="row">
                                <div class="form-group col-lg-2">
                                    <label for="Nombre" class="col-form-label">Precio:</label>
                                    <input type="number" class="form-control" id="precio">
                                </div>                    
                                <div class="form-group col-lg-3">
                                    <label for="Nombre" class="col-form-label">Sala:</label>
                                    <select class="form-control" name="cliente" id="id_sala">
                                    <?php
                                    $consulta="SELECT id, sala FROM sala";
                                    $resultado=$conexion->prepare($consulta);
                                    $resultado->execute();
                                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                                    ?>
                                    <?php
                                    foreach ($data as $dat) {
                                    ?>
                                    <option value="<?php echo $dat['id']; ?>"><?php echo $dat['sala']; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>                   
                                <div class="form-group col-lg-2 col-sm-4">
                                    <label for="Nombre" class="col-form-label">Inicio:</label>                    
                                    <div class="input-group clockpicker">
                                        <input id="ini_hora" type="text" class="form-control" value="09:30">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>                 
                                </div>
                                <div class="form-group col-lg-2 col-sm-4">
                                    <label for="Nombre" class="col-form-label">Fin:</label>                    
                                    <div class="input-group clockpicker">
                                        <input id="fin_hora" type="text" class="form-control" value="09:30">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-time"></span>
                                        </span>
                                    </div>                 
                                </div>                                
                                <div class="form-group col-lg-3 col-sm-4">
                                    <label for="Nombre" class="col-form-label">Días Limite:</label>    
                                    <input type="number" class="form-control" id="dias_limite" required>                                                    
                                </div>                                
                            </div>                                                       
                        </div>                          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-primary">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Fin - Modal -->
<!-- FIN MODAL WITH STEPS -->              
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="dist/js/scripts.js"></script>
    <script type="text/javascript" src="js/main-horarios.js"></script>
    <script src="clockpicker.js"></script>
    <script type="text/javascript">       
        var input = $('#ini_hora');
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