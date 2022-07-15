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
  
   if($_SESSION['accesos_globales']['usuario_nuevo_acceso'] != $activo) {
     $ver_nuevo_usuario=$_SESSION['$ocultar'];
   }else{$ver_nuevo_usuario="";} 



   $usuario_id=$_SESSION['$id_usuario'];
   $nombre_completo=$_SESSION['$nombre'].' '.$_SESSION['$apellido'];
  $consulta = "SELECT rol.rol,usuario.id, usuario.nombre, usuario.apellido, usuario.carnet_identidad,usuario.telefono,usuario.usuario,usuario.password
               FROM rol INNER JOIN usuario ON rol.id = usuario.id_rol where usuario.id='$usuario_id'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC); 
  

  if ($data){
    foreach ($data as $row) {              
        $return = array ('id' => $row['id'],'nombre' => $row['nombre'],'apellido' => $row['apellido'],'carnet_identidad' => $row['carnet_identidad'],'telefono' => $row['telefono'],'usuario' => $row['usuario'],'password' => $row['password'],'rol' => $row['rol']);                           
    }
  }
  $consulta = "SELECT id,nombre,apellido,carnet_identidad,telefono,usuario,password, estado FROM usuario ";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <style>  
  .toggle.ios .toggle-handle { border-radius: 20px; background:#fafafa;}
</style>
  <div class="container">
  <div class="row">
            <div class="col text-center mt-5 h1-titulos">
              <h1 >PERFIL DE USUARIO</h1>     
              <div class="row" id="probar_array">

              </div>         
            </div>
        </div> 
        <div class="row">
            <h3>Datos Personales</h3>
            <input type="text" name="" id="id_rol_usuario" value="<?php echo $_SESSION['$rol'] ?>" style="display:none;">
        </div>
        <div class="row">                    
          <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control mr-auto " id="nombre" disabled value=<?php echo $return['nombre']; ?>>
            </div>                   
          <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Apelldo:</label>
                <input type="text" class="form-control mr-auto" id="apellido" disabled value=<?php echo $return['apellido']; ?>>
            </div>                   
          <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Carnet de Identidad:</label>
                <input type="text" class="form-control mr-auto" id="carnet_identidad" disabled value=<?php echo $return['carnet_identidad']; ?>>
            </div>                   
          <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Telefono:</label>
                <input type="text" class="form-control mr-auto" id="sexo" disabled value=<?php echo $return['telefono']; ?>>
            </div>                   
        </div>  
        <div class="row">
            <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control mr-auto" id="usuario" disabled value=<?php echo $return['usuario']; ?>>
            </div>   
            <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Contraseña:</label>
                <input type="password" class="form-control mr-auto" id="password" disabled value=<?php echo $return['password']; ?>>
            </div>   
            <div class="form-group col-1 align-self-end">                
                <button class="btn btn-primary "  style="display:flex;align-items:flex-end;" onclick="mostrarContrasena()" ><span class='material-icons'>remove_red_eye</span></button>                
            </div>  
            <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Rol:</label>
                <input type="text" class="form-control mr-auto" id="rol" disabled value=<?php echo $return['rol']; ?>>
            </div>                
        </div>        
        <div class="row">
          <h2 class="mt-4" <?php echo $ver_nuevo_usuario; ?> >Usuarios Registrados</h2>
        </div>
        <div class="row">
              <div class="col-lg-12">
                <button type="button" name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnNuevo" <?php echo $ver_nuevo_usuario; ?> ><i class="fas fa-user-plus"></i> Nuevo Usuario</button>
                <button type="button" name="button" class="btn btn-primary mt-3 mb-3 font-weight-bold" id="btnEditar"><i class="fas fa-user-edit"></i> Editar Perfil</button>
                
              </div>

            </div>  
        <!-- Tabla -->
        <div class="container" <?php echo $ver_nuevo_usuario; ?> >
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
                      <th>Telefono</th>
                      <th>Usuario</th>
                      <th>Contraseña</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data1 as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>
                      <td><?php echo $dat['nombre']; ?></td>
                      <td><?php echo $dat['apellido']; ?></td>
                      <td><?php echo $dat['carnet_identidad']; ?></td>                      
                      <td><?php echo $dat['telefono']; ?></td>
                      <td><?php echo $dat['usuario']; ?></td>
                      <td style="-webkit-text-security: disc;"><?php echo $dat['password']; ?></td>
                      <?php 
                        if($dat['estado']==1){
                          $estado_usu="checked";
                        }else{
                          $estado_usu="";
                        }
                        
                      ?>
                      <td><input type='checkbox' <?php echo $estado_usu;?> data-toggle='toggle' data-on='Activo' data-off='Inactivo' data-onstyle='primary' data-offstyle='danger' data-style='ios' id='estado_usuario'></td>
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
        <!-- Modal 1 - USUARIOS -->
      <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>  
            <!--INICIO DE TABS-->
            <form id="formPersonas">
              <div class="modal-body">
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="font-weight:600;">Datos Personales</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="font-weight:600;" >Control de Accesos</a>
                  </li>              
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row ml-2 mt-1">
                      <div class="form-group col-5">
                        <label for="Nombre" class="col-form-label">Nombre:<span style="font-size:13px;color:red;"> *</span></label>
                        <input type="text" class="form-control mr-auto" id="nombre_input" required >
                      </div>
                      <div class="form-group col-7">
                        <label for="Nombre" class="col-form-label">Apellido:</label><span style="font-size:13px;color:red;"> *</span>
                        <input type="text" class="form-control" id="apellido_input"required>
                      </div>
                    </div>
                    <div class="row ml-2 mt-1">
                      <div class="form-group col-lg-6">
                        <label for="Nombre" class="col-form-label">Carnet de Identidad:</label><span style="font-size:13px;color:red;"> *</span>
                        <input type="number" class="form-control" id="carnet_identidad_input" required>
                      </div>                
                      <div class="form-group col-lg-6">
                        <label for="Nombre" class="col-form-label">Telefono:</label><span style="font-size:13px;color:red;"> *</span>
                        <input type="number" class="form-control" id="telefono_input" required>
                      </div>                
                    </div>
                    <div class="form-group">
                      <label for="Nombre" class="col-form-label">Usuario:</label><span style="font-size:13px;color:red;"> *</span>
                      <input type="text" class="form-control" id="usuario_input" required>
                    </div>                
                    <div class="row ml-2 mt-1">
                      <div class="form-group col-6">
                        <label for="Nombre" class="col-form-label">Contraseña:<span style="font-size:13px;color:red;"> *</span></label>
                        <input type="password" class="form-control mr-auto" id="contraseña_input" required>
                      </div>
                      <div class="form-group col-6">
                        <label for="Nombre" class="col-form-label">Confirme su contraseña:</label><span style="font-size:13px;color:red;"> *</span>
                        <input type="password" class="form-control" id="contraseña_confirmar" required>
                      </div>
                    </div>                                    
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row ml-2 mt-1">
                      <div class="form-group col-12">
                          <label for="Nombre" class="col-form-label">Rol de usuario</label><span style="font-size:13px;color:red;"> *</span>    
                          <select class="form-control" name="sexo" id="rol_usuario" required>
                              <option value="1">Administrador</option>
                              <option value="2">Vendedor</option>                      
                          </select>
                      </div>
                    </div>
                    <div class="container" id="checkboxs_de_control_de_accesos" style="display:none;">
                      <div class="row ml-2 mt-1">                      
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="cliente_reporte_acceso">
                          <label class="form-check-label" for="cliente_reporte_acceso">Reporte de clientes</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="disciplina_acceso">
                          <label class="form-check-label" for="disciplina_acceso">Disciplinas</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="disciplina_nuevo_acceso">
                          <label class="form-check-label" for="disciplina_nuevo_acceso">Agregar Disciplinas</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="instructor_acceso">
                          <label class="form-check-label" for="instructor_acceso">Instructores</label>
                        </div>
                      </div>                    
                      <div class="row ml-2 mt-1">                      
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="instructor_nuevo_acceso">
                          <label class="form-check-label" for="instructor_nuevo_acceso">Agregar Instructor</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="lista_asistencia_acceso">
                          <label class="form-check-label" for="lista_asistencia_acceso">Lista de Asistencia</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="asistencia_acceso">
                          <label class="form-check-label" for="asistencia_acceso">Control de Asistencia</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="pago_acceso">
                          <label class="form-check-label" for="pago_acceso">Control de Pagos</label>
                        </div>
                      </div>                    
                      <div class="row ml-2 mt-1">                      
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="pago_reporte_acceso">
                          <label class="form-check-label" for="pago_reporte_acceso">Reporte de Pagos</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="tienda_acceso">
                          <label class="form-check-label" for="tienda_acceso">Tienda</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="tienda_nueva_venta_acceso">
                          <label class="form-check-label" for="tienda_nueva_venta_acceso">Realizar Ventas</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="tienda_reporte_acceso">
                          <label class="form-check-label" for="tienda_reporte_acceso">Reporte de Tienda</label>
                        </div>
                      </div>                    
                      <div class="row ml-2 mt-1">                      
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="tienda_producto_acceso">
                          <label class="form-check-label" for="tienda_producto_acceso">Ver Productos</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="producto_acceso">
                          <label class="form-check-label" for="producto_acceso">Productos</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="producto_nuevo_acceso">
                          <label class="form-check-label" for="producto_nuevo_acceso">Agregar Productos</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="producto_editar_acceso">
                          <label class="form-check-label" for="producto_editar_acceso">Editar Productos</label>
                        </div>
                      </div>                    
                      <div class="row ml-2 mt-1">                      
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="producto_eliminar_acceso">
                          <label class="form-check-label" for="producto_eliminar_acceso">Eliminar Productos</label>
                        </div>
                        <div class="form-check form-switch col-3">
                          <input class="form-check-input" type="checkbox" id="usuario_nuevo_acceso">
                          <label class="form-check-label" for="usuario_nuevo_acceso">Usuarios</label>
                        </div>              
                      </div>   
                      <div class="row">
                        <button id="mostrar_array" style ="display:none;">MOSTRAR ARRAY</button>
                      </div>               
                    </div>
                  </div>             
                </div>       

              </div>
              <span style="font-size:13px;color:#343A40;margin-left:20px;">Todos los campos con * son obligatorios</span>
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
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>                      
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.6.0/jquery.json.min.js"></script>                      
  <script src="dist/js/scripts.js"></script>
  
  <script type="text/javascript" src="js/main-perfil.js"></script>
  <script>
  function mostrarContrasena(){
      var tipo = document.getElementById("password");
      if(tipo.type == "password"){
          tipo.type = "text";
      }else{
          tipo.type = "password";
      }
  }
</script>

  </body>
</html>
