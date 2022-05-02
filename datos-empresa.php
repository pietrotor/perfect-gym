<?php
     
  include_once("vistas/plantilla.php");
  if ($_SESSION['$rol'] == 2){
    //   header("location: inicio.php");
    echo "<a class='ml-2 mt-4' href='inicio.php'> Volver al inicio</a>";
    die();
  } 
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  $consulta="SELECT * FROM datos_empresa" ;
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data as $row) {     
    $return=array('razon_social' => $row['razon_social'],'direccion' => $row['direccion'],'correo_electronico' => $row['correo_electronico'],
    'sitio_web' => $row['sitio_web'],'ciudad' => $row['ciudad'],'pais' => $row['pais'],'nit' => $row['nit']);
  }
 
?>
<div class="container">
    <div class="row">
        <div class="col text-center mt-5 h1-titulos">
          <h1 >DATOS DEL GIMNASIO</h1>
        </div>
    </div>
    <div class="row">                    
        <div class="form-group col-lg-4">
            <label for="Nombre" class="col-form-label">Nombre del Gimansio:</label>
            <input type="text" class="form-control mr-auto" id="nombre" disabled value="<?php echo $return['razon_social'];?>">

            <label for="Nombre" class="col-form-label mt-3">Correo de la empresa:</label>
            <input type="text" class="form-control mr-auto" id="correo" disabled value="<?php echo $return['correo_electronico'];?>">
        </div>                   
        <div class="form-group col-lg-4">
            <label for="Nombre" class="col-form-label">Dirección:</label>
            <input type="text" class="form-control mr-auto" id="direccion" disabled value="<?php echo $return['direccion'];?>">

            <label for="Nombre" class="col-form-label mt-3">Sitio web:</label>
            <input type="text" class="form-control mr-auto" id="sitio_web" disabled value="<?php echo $return['sitio_web'];?>">
        </div>                         
        <div class="form-group col-lg-4 ml-auto d-flex justify-content-center align-items-center">
          <img src="imagenes-sistema/logo.png" style="max-width:300px;max-height:200px; border:2px solid rgba(0,0,0,0.5);" id="foto-persona" >
        </div> 
    </div> 
    <div class="row">
        <div class="form-group col-lg-4">
            <label for="Ciudad" class="col-form-label">Ciudad:</label>
            <input type="text" class="form-control mr-auto" id="ciudad" disabled value="<?php echo $return['ciudad'];?>">
        </div>
        <div class="form-group col-lg-4">
            <label for="País" class="col-form-label">País:</label>
            <input type="text" class="form-control mr-auto" id="pais" disabled value="<?php echo $return['pais'];?>">
        </div>
        <div class="form-group col-lg-4">
            <label for="País" class="col-form-label">NIT:</label>
            <input type="text" class="form-control mr-auto" id="nit" disabled value="<?php echo $return['nit'];?>">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" name="button" class="btn btn-primary mt-3 mb-3 font-weight-bold" id="btnEditar"><i class="fas fa-edit"></i> Editar Información</button>
        </div>
    </div>
    <!-- Modal 1 - CRUD datos cliente -->
    <div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formPersonas" autocomplete="off" method="POST" action="#" enctype="multipart/form-data" onsubmit="return false">
                    <div class="modal-body">
                        <div class="row">
                            <input autocomplete="off" name="hidden" type="text" style="display:none;">
                            <div class="form-group col-lg-6">
                                <label for="Nombre" class="col-form-label">Nombre del Gimansio:<span style="font-size:13px;color:red;"> *</span></label>
                                <input type="text" class="form-control mr-auto" id="nombre_modal" autocomplete="autocomplete_off_hack_xfr4!k" spellcheck="false" onkeypress="return sololetras(event)" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="Nombre" class="col-form-label">Dirección:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="text" class="form-control" id="direccion_modal" autocomplete="autocomplete_off_hack_xfr4!k" spellcheck="false" onkeypress="return sololetras(event)" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="Nombre" class="col-form-label">Correo electronico:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="email" class="form-control" id="correo_modal" required>
                            </div>                  
                            <div class="form-group col-lg-4">
                                <label for="Nombre" class="col-form-label">Password:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="password" class="form-control" id="password_modal" required>
                            </div>                
                            <div class="form-group col-lg-4">
                                <label for="Nombre" class="col-form-label">Sitio Web:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="text" class="form-control" id="sitio_web_modal" autocomplete="off" required>
                            </div>                
                        </div>     
                        <div class="row">
                            <div class="form-group col-lg-6 align-self-center">                     
                                <label for="Nombre" class="col-form-label">Nit:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="text" class="form-control" id="nit_modal" autocomplete="off" required>

                                <label for="Nombre" class="col-form-label">Ciudad:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="text" class="form-control" id="ciudad_modal" autocomplete="off" required>

                                <label for="Nombre" class="col-form-label">Pais:</label><span style="font-size:13px;color:red;"> *</span>
                                <input type="text" class="form-control" id="pais_modal" autocomplete="off"  required>
                            </div>
                            <div class="form-group col-lg-6 ">                    
                                <div class="card d-flex justify-content-center align-items-center" style="border:none;">                                    
                                    <img src="imagenes-sistema/logo.png" style="max-width:300px;max-height:200px" class="card-img-top" id="mostrarimagen">
                                    <div class="card-body">
                                        <!-- <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false"> -->
                                            <div class="row">                                  
                                                <div class="col-lg-12"><br>
                                                    <input type="file" class="form-control-file" id="seleccionararchivo" accept="image/x-png">
                                                </div>                                  
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col text-center">
                                                    <p style="font-size: 11.5px;color:#737373;" >Tamaño recomendado: 300px a 850px <br> Formato: PNG</p>                                                    
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
<script type="text/javascript" src="js/main-datos-empresa.js"></script>
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
</body>
</html>