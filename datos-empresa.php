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
    'sitio_web' => $row['sitio_web'],'ciudad' => $row['ciudad'],'pais' => $row['pais'],'nit' => $row['nit'], 'asunto_inscripcion_email' => $row['asunto_inscripcion_email'],
    'cuerpo_inscripcion_email' => $row['cuerpo_inscripcion_email'],'alt_inscripcion_email' => $row['alt_inscripcion_email'],'link_inscripcion_email' => $row['link_inscripcion_email'],
    'texto_boton_email' => $row['texto_boton_email'], 'asunto_recordatorio_email' => $row['asunto_recordatorio_email'], 'cuerpo_recordatorio_email' => $row['cuerpo_recordatorio_email'], 'alt_recordatorio_email' => $row['alt_recordatorio_email'],
    'sesiones_recordatorio_email' => $row['sesiones_recordatorio_email'], 'asunto_vencimiento_email' => $row['asunto_vencimiento_email'], 'cuerpo_vencimiento_email' => $row['cuerpo_vencimiento_email'], 'alt_vencimiento_email' => $row['alt_vencimiento_email'],
    'contenido_texto_pdf' => $row['contenido_texto_pdf']);
  }
 
?>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/richtext.min.css">
<script src="jquery/jquery-3.3.1.min.js"></script>

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
        <div style="display:flex; gap: 15px; flex-wrap: wrap;">
            <div>
                <button type="button" name="button" class="btn btn-primary mt-3 mb-3 font-weight-bold" id="btnEditar"><i class="fas fa-edit"></i>Editar Empresa</button>
            </div>
            <div>
                <button type="button" name="button" class="btn btn-primary mt-3 mb-3 font-weight-bold" id="configuraciones"><i class="fas fa-edit"></i>Editar Configuraciones</button>
            </div>
            <div>
                <a href="./bd/crear-backup.php"><button type="button" name="button" class="btn btn-primary mt-3 mb-3 font-weight-bold" id="backup"><i class="fas fa-edit"></i>Crear Backup</button></a>
            </div>
        </div>
    </div>
    <!-- Modal 1 - CRUD Datos Empresa -->
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
    <div class="modal fade" id="modalConfiguraciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>  
            <!--INICIO DE TABS-->
            <form id="formConfiguraciones">
                <div class="modal-body">                
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="email_inscripcion-tab" data-bs-toggle="tab" href="#email_inscripcion" role="tab" aria-controls="email_inscripcion" aria-selected="true" style="font-weight:600;">Email Inscripcion</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="email_recordatorio-tab" data-bs-toggle="tab" href="#email_recordatorio" role="tab" aria-controls="email_recordatorio" aria-selected="false" style="font-weight:600;" >Email Recordatorio</a>
                    </li>              
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="email_vencimiento-tab" data-bs-toggle="tab" href="#email_vencimiento" role="tab" aria-controls="email_vencimiento" aria-selected="false" style="font-weight:600;" >Email Vencimiento</a>
                    </li>              
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="comprobante_pdf-tab" data-bs-toggle="tab" href="#comprobante_pdf" role="tab" aria-controls="comprobante_pdf" aria-selected="false" style="font-weight:600;" >Comprobante PDF</a>
                    </li>              
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <!-- TAB 1 - EMAIL INSCRIPCION -->
                        <div class="tab-pane fade show active" id="email_inscripcion" role="tabpanel" aria-labelledby="pills-email_inscripcion-tab">
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Asunto del Correo:<span style="font-size:13px;color:red;"> *</span></label>
                                    <input type="text" class="form-control mr-auto" id="email_inscripcion_asunto" value="<?php echo $return['asunto_inscripcion_email'];?>" required >
                                </div>
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Cuerpo del Correo:</label><span style="font-size:13px;color:red;"> *</span>
                                    <textarea type="text" class="form-control" id="email_inscripcion_cuerpo" required></textarea>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#email_inscripcion_cuerpo').html('<?php echo $return['cuerpo_inscripcion_email'];?>')
                                            $('#email_inscripcion_cuerpo').richText({
                                                imageUpload: false,
                                                fileUpload: false
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-lg-12">
                                    <label for="Nombre" class="col-form-label">Texto Alternativo:</label><span style="font-size:13px;color:red;"> *</span>
                                    <input type="text" class="form-control" id="email_inscripcion_alt" value="<?php echo $return['alt_inscripcion_email'];?>" required>
                                </div>                                                            
                            </div>
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-md-6">
                                    <label for="Nombre" class="col-form-label">Texto del Boton:</label><span style="font-size:13px;color:red;"> *</span>
                                    <input type="text" class="form-control" id="email_inscripcion_texto_boton" value="<?php echo $return['texto_boton_email'];?>" required>
                                </div>                                                            
                                <div class="form-group col-md-6">
                                    <label for="Nombre" class="col-form-label">Link de Redirección:</label><span style="font-size:13px;color:red;"> *</span>
                                    <input type="text" class="form-control" id="email_inscripcion_link_boton" value="<?php echo $return['link_inscripcion_email'];?>" required>
                                </div>                                                            
                            </div>
                        </div>
                        <!-- TAB 2 - EMAIL RECORDATORIO -->
                        <div class="tab-pane fade" id="email_recordatorio" role="tabpanel" aria-labelledby="pills-email_recordatorio-tab">
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Asunto del Correo:<span style="font-size:13px;color:red;"> *</span></label>
                                    <input type="text" class="form-control mr-auto" id="email_recordatorio_asunto" value="<?php echo $return['asunto_recordatorio_email'];?>" required >
                                </div>
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Cuerpo del Correo:</label><span style="font-size:13px;color:red;"> *</span>
                                    <textarea type="text" class="form-control" id="email_recordatorio_cuerpo" required></textarea>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#email_recordatorio_cuerpo').html('<?php echo $return['cuerpo_recordatorio_email'];?>')
                                            $('#email_recordatorio_cuerpo').richText({
                                                imageUpload: false,
                                                fileUpload: false
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-lg-9">
                                    <label for="Nombre" class="col-form-label">Texto Alternativo:</label><span style="font-size:13px;color:red;"> *</span>
                                    <input type="text" class="form-control" id="email_recordatorio_alt" value="<?php echo $return['alt_recordatorio_email'];?>" required>
                                </div>                                                            
                                <div class="form-group col-lg-3">
                                    <label for="Nombre" class="col-form-label">Sesiones Restantes:</label><span style="font-size:13px;color:red;"> *</span>
                                    <input type="number" class="form-control" id="email_recordatorio_sesiones" value="<?php echo $return['sesiones_recordatorio_email'];?>" required>
                                </div>                                                            
                            </div>
                        </div>
                        <!-- TAB 3 - EMAIL VENCIMIENTO -->
                        <div class="tab-pane fade" id="email_vencimiento" role="tabpanel" aria-labelledby="pills-email_vencimiento-tab">
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Asunto del Correo:<span style="font-size:13px;color:red;"> *</span></label>
                                    <input type="text" class="form-control mr-auto" id="email_vencimiento_asunto" value="<?php echo $return['asunto_vencimiento_email'];?>" required >
                                </div>
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Cuerpo del Correo:</label><span style="font-size:13px;color:red;"> *</span>
                                    <textarea type="text" class="form-control" id="email_vencimiento_cuerpo" required></textarea>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#email_vencimiento_cuerpo').html('<?php echo $return['cuerpo_vencimiento_email'];?>')
                                            $('#email_vencimiento_cuerpo').richText({
                                                imageUpload: false,
                                                fileUpload: false
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-lg-12">
                                    <label for="Nombre" class="col-form-label">Texto Alternativo:</label><span style="font-size:13px;color:red;"> *</span>
                                    <input type="text" class="form-control" id="email_vencimiento_alt" value="<?php echo $return['alt_vencimiento_email'];?>" required>
                                </div>                                                            
                            </div>
                        </div>
                        <!-- TAB 4 - PDF COMPROBANTE -->
                        <div class="tab-pane fade" id="comprobante_pdf" role="tabpanel" aria-labelledby="pills-comprobante_pdf-tab">
                            <div class="row ml-2 mt-1">
                                <div class="form-group col-12">
                                    <label for="Nombre" class="col-form-label">Cuerpo del Comprobante:</label><span style="font-size:13px;color:red;"> *</span>
                                    <textarea type="text" class="form-control" id="comprobante_pdf_cuerpo" required></textarea>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#comprobante_pdf_cuerpo').html('<?php echo $return['contenido_texto_pdf'];?>')
                                            $('#comprobante_pdf_cuerpo').richText({
                                                imageUpload: false,
                                                fileUpload: false
                                            });
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- 2 -->
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

<!-- Rich Text  -->
<script src="assets/js/jquery.richtext.min.js"></script>

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