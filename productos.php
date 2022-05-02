<?php
  include_once("vistas/plantilla.php");

  if($_SESSION['accesos_globales']['producto_nuevo_acceso'] != $activo) {
    $ver_nuevo_producto=$_SESSION['$ocultar'];
  }else{$ver_nuevo_producto="";} 

  if($_SESSION['accesos_globales']['producto_editar_acceso'] != $activo) {
    $ver_editar_producto=$_SESSION['accesos_globales']['producto_editar_acceso'];
  }else{$ver_editar_producto="";} 

  if($_SESSION['accesos_globales']['producto_eliminar_acceso'] != $activo) {
    $ver_eliminar_producto=$_SESSION['accesos_globales']['producto_eliminar_acceso'];
  }else{$ver_eliminar_producto="1";} 
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  $consulta="SELECT * FROM producto";
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
 <style>
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
 </style>
<div class="container">
   <div class="row">
        <div class="col text-center mt-5 h1-titulos">
            <h1>PUNTO DE VENTA</h1>
            <input type="text" name="" id="id_rol_usuario" value="<?php echo $_SESSION['$rol']; ?>" style="display:none;">
            <input type="text" name="" id="id_editar_producto" value="<?php echo $ver_editar_producto; ?>" style="display:none;">
            <input type="text" name="" id="id_elminar_producto" value="<?php echo $ver_eliminar_producto; ?>" style="display:none;">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="button" <?php echo $ver_nuevo_producto; ?> name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnNuevo" <?php echo $_SESSION['$ocultar']; ?> ><i class="fas fa-cart-plus"></i> Nuevo Producto</button>                                
            <a href="punto_de_venta.php"><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" ><i class="fas fa-arrow-circle-left"></i> Volver a la Tienda</button></a>                                
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
                      <th>Producto</th>
                      <th>Categoria</th>
                      <th>Precio</th>
                      <th>Stock</th>                      
                      <th>Imagen</th>                      
                      <th>Acciones</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>
                      <td><?php echo $dat['producto']; ?></td>
                      <td><?php echo $dat['categoria']; ?></td>
                      <td><?php echo $dat['precio']; ?></td>
                      <td><?php echo $dat['stock']; ?></td>                      
                      <td><?php echo $dat['foto']; ?></td>                      
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

 <!-- Modal 1 - CRUD Productos -->
 <div class="modal fade" id="modal_productos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="form_Productos" method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Producto:<span style="font-size:13px;color:red;"> *</span></label>
                    <input type="text" class="form-control mr-auto" id="producto" required>                    
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="Nombre" class="col-form-label">Precio:</label><span style="font-size:13px;color:red;"> *</span>
                            <input type="number" class="form-control" id="precio" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="Nombre" class="col-form-label">Stock:</label><span style="font-size:13px;color:red;"> *</span>
                            <input type="number" class="form-control" id="stock" required>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="Nombre" class="col-form-label">Categoria:</label><span style="font-size:13px;color:red;"> *</span>
                            <input type="text" class="form-control" id="categoria" required>
                        </div>
                    </div>                    
                    <label for="Nombre" class="col-form-label">Descripcion:</label><span style="font-size:13px;color:red;"> *</span>
                    <textarea class="form-control mr-auto" rows="3" id="descripcion"></textarea>                                    
                </div>  

                  <div class="form-group col-lg-6 mt-2">                    
                    <div class="card d-flex justify-content-center align-items-center" style="border:none;">
                      <img src="imagenes-productos/producto-default.png" style="width:200px;height:200px;" class="card-img-top" id="mostrarimagen">
                      <div class="card-body">
                          <!-- <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false"> -->
                              <div class="row">                                  
                                  <div class="col-lg-12"><br>
                                          <input type="file" style="font-size:14px;" class="form-control-file" id="seleccionararchivo" accept="image/x-png,image/gif,image/jpeg">
                                  </div>                                  
                              </div>
                          <!-- </form> -->
                      </div>
                    </div>   
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  <script src="dist/js/scripts.js"></script>                  


  <!-- Codigo propio JS -->
  <script type="text/javascript" src="js/main-productos.js"></script>
  <script type="text/javascript">
    document.getElementById("seleccionararchivo").addEventListener("change", () => {
              var archivoseleccionado = document.querySelector("#seleccionararchivo");
              var archivos = archivoseleccionado.files;
              var imagenPrevisualizacion = document.querySelector("#mostrarimagen");
              // Si no hay archivos salimos de la función y quitamos la imagen
              if (!archivos || !archivos.length) {
              imagenPrevisualizacion.src = "";
              return;
              }
              // Ahora tomamos el primer archivo, el cual vamos a previsualizar
              var primerArchivo = archivos[0];
              // Lo convertimos a un objeto de tipo objectURL
              var objectURL = URL.createObjectURL(primerArchivo);
              // Y a la fuente de la imagen le ponemos el objectURL
              imagenPrevisualizacion.src = objectURL;
    });  
</script>