<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  // $consulta="SELECT cliente.*, (SELECT clase.clase from membresia INNER JOIN clase ON membresia.id_clase = clase.id
  //            WHERE membresia.id_cliente = cliente.id ORDER BY membresia.id DESC LIMIT 1) as clase ,(SELECT membresia.estado from membresia 
  //            WHERE membresia.id_cliente = cliente.id ORDER BY membresia.id DESC LIMIT 1) AS estado
  //            FROM cliente INNER JOIN ((instructor INNER JOIN clase ON instructor.id = clase.id_instructor)
  //            INNER JOIN membresia ON clase.id = membresia.id_clase) ON cliente.id = membresia.id_cliente 
  //            group by cliente.id order by cliente.id DESC";
  $consulta="SELECT cliente.*, (SELECT clase.clase
  FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia ON grupo.id = membresia.id_grupo WHERE membresia.id_cliente = cliente.id ORDER BY membresia.id DESC LIMIT 1) AS disciplina, (SELECT membresia.estado from membresia 
               WHERE membresia.id_cliente = cliente.id ORDER BY membresia.id DESC LIMIT 1) AS estado
  FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
  ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo GROUP BY cliente.id ORDER BY cliente.id";

  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
 ?>
<?php
  include_once("vistas/plantilla.php");
  $activo=1;
  if($_SESSION['accesos_globales']['cliente_reporte_acceso'] != $activo) {
    $ver_reporte=$_SESSION['$ocultar'];;
  }else{$ver_reporte="";}
?>

          <!-- INCIO CONTENIDO -->
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >CLIENTES</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <button type="button" name="button" class="btn btn-success mt-3 mb-3 font-weight-bold" id="btnNuevo"><i class="fas fa-user-plus"></i> Nuevo Socio</button>
                <a href="reporte-clientes.php" <?php echo $ver_reporte; ?> ><button type="button" name="button" class="btn btn-dark mt-3 mb-3 font-weight-bold" id="btnReportes"><i class="fas fa-file-signature"></i> Reportes</button></a>
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
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Carnet de Identidad</th>
                      <th>Sexo</th>
                      <th>Telefono</th>
                      <th>Correo</th>
                      <th>Disciplina</th>
                      <th>Estado</th>
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
                      <td><?php echo $dat['sexo']; ?></td>
                      <td><?php echo $dat['telefono']; ?></td>
                      <td><?php echo $dat['correo']; ?></td>
                      <td><?php echo $dat['disciplina']; ?></td>
                      <td><?php echo $dat['estado']; ?></td>
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

        <!-- Modal -->
        <!-- Button trigger modal -->

      <!-- Modal 1 - CRUD datos cliente -->
      <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <label for="Nombre" class="col-form-label">Nombre:<span style="font-size:13px;color:red;"> *</span></label>
                    <input type="text" class="form-control mr-auto" id="nombre" autocomplete="autocomplete_off_hack_xfr4!k" spellcheck="false" onkeypress="return sololetras(event)" required>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Apellido:</label><span style="font-size:13px;color:red;"> *</span>
                    <input type="text" class="form-control" id="apellido" autocomplete="autocomplete_off_hack_xfr4!k" spellcheck="false" onkeypress="return sololetras(event)" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Carnet de Identidad:</label><span style="font-size:13px;color:red;"> *</span>
                    <input type="number" class="form-control" id="carnet_identidad" required>
                  </div>                  
                  <div class="form-group col-lg-6">
                    <label for="Nombre" class="col-form-label">Sexo:</label><span style="font-size:13px;color:red;"> *</span>
                    <!-- <div class="row">
                      <label class="radio-inline col"><input type="radio" id="sexo" name="sexo" value="Masculino" checked>Masculino</label>
                      <label class="radio-inline col"><input type="radio" id="sexo" name="sexo" value="Femenino">Femenino</label>
                      <label class="radio-inline col"><input type="radio" id="sexo" name="sexo" value="Otro">Otro</label>
                    </div> -->
                    <select class="form-control" name="sexo" id="sexo" required>
                      <option value="Masculino">Masculino</option>
                      <option value="Femenino">Femenino</option>
                      <option value="Otro">Otro</option>
                    </select>
                  </div>                
                </div>     
                <div class="row">
                  <div class="form-group col-lg-6 align-self-center">
                    <label for="Nombre" class="col-form-label">Fecha de Nacimiento:</label><span style="font-size:13px;color:red;"> *</span>
                    <input type="date" class="form-control" id="fecha_naci" autocomplete="off" required>  
                        
                    <label for="Nombre" class="col-form-label">Telefono:</label><span style="font-size:13px;color:red;"> *</span>
                    <input type="number" class="form-control" id="telefono" autocomplete="off" required>

                    <label for="Nombre" class="col-form-label">Correo Electronico:</label><span style="font-size:13px;color:red;"> *</span>
                    <input type="email" class="form-control" id="correo" autocomplete="off"  required>
                  </div>
                  <div class="form-group col-lg-6 ">                    
                    <div class="card d-flex justify-content-center align-items-center" style="border:none;">
                      <img src="imagenes/default-avatar.png" style="width:200px;height:200px;" class="card-img-top" id="mostrarimagen">
                      <div class="card-body">
                          <!-- <form method="POST" action="#" enctype="multipart/form-data" onsubmit="return false"> -->
                              <div class="row">                                  
                                  <div class="col-lg-12"><br>
                                          <input type="file" class="form-control-file" id="seleccionararchivo" accept="image/x-png,image/gif,image/jpeg">
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

      <!-- Modal 2 - Membreisa -->
      <div class="modal fade" id="modalMembresia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="form-group col-lg-4">
                      <label for="Nombre" class="col-form-label">Sesiones:</label>
                      <input type="text" class="form-control" id="sesiones" disabled>
                    </div>                 
                    <div class="form-group col-lg-6">
                      <label for="Nombre" class="col-form-label">Instructor:</label>
                      <input type="text" class="form-control" id="instructor" disabled>                      
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
      <!-- Fin - Modal 2 - Membreisa -->
      
      <!-- INICIO MODAL 3 CREAR PDF -->
      <div class="modal fade" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">IMPRIMIR COMPROBANTE DE INSCRIPCION</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formPDF" method="post" action="crear-pdf.php" target="_blank">
              <div class="modal-body">             
                <div class="form-group">
                  <input type="text" class="d-none" name="id-cliente" id="id-cliente-paso"><!-- GUARDAR EL ID del cliente -->
                </div>
                   <p>La inscripción se realizo de manera correcta</p>   
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnImprimir" class="btn btn-primary" >Impirmir</button>
              </div>        

            </form>
           </div>           
        </div>
      </div>


      <!-- FIN MODAL 3 -->
      
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
  <script type="text/javascript" src="main.js"></script>
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
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes; //agrega cero si el menor de 10   
    fecha_actual=ano+"-"+mes+"-"+dia;       
    $(document).ready(function(){
    
      
        $('#id-clase').change(function(){
          id_clase_precio=$('#id-clase').val();
          console.log(id_clase_precio);    
          $('#precio').val("");
          $('#sesiones').val("");
          $('#instructor').val("");
          $('#fecha_fin').val("");
          $('#id_sala').val("");           
          $('#fecha_ini').val(fecha_actual);          
                
        });

        $('#id-clase').change(function(){          
          $("#id-clase").each(function(){
           id_estado_clase=id_clase_precio;
           $.post("bd/cambio_horarios.php",{id_estado_clase:id_estado_clase},
           function(data){
               $("#horario").html(data);
           });
         });
        });

        $('#horario').change(function(){
          id_grupo=$('#horario').val();          
          $.ajax({
            url:"bd/cambio-grupo.php",
            type: "POST",
            dataType: "json",
            async:false,
            data:{id_grupo:id_grupo},
            success:function(data){
                if(data.error!==undefined){                    
                    return false;
                 } else {
                    if(data.precio!==undefined){                      
                      $('#precio').val(data.precio);
                      $('#sesiones').val(data.sesiones);                                          
                      $('#instructor').val(data.nombre+" "+data.apellido);                                               
                      $('#fecha_fin').val(data.tiempo_limite);                                        
                      $('#id_sala').val(data.sala);                                        
                    };                                        
                    return true;
                 }
            }
          }); 
        });
        $('#fecha_ini').change(function(){
          let fecha_inicio_membresia = $('#fecha_ini').val();
          id_grupo=$('#horario').val();                    
          $.ajax({
            url:"bd/modificacion-fecha.php",
            type: "POST",
            dataType: "json",
            async:false,
            data:{fecha_inicio_membresia:fecha_inicio_membresia, id_grupo:id_grupo},
            success:function(data){                                  
              $('#fecha_fin').val(data.fecha_de_caducidad);                                        
            }
          });
        });
    });
                      
  </script>
  </body>
</html>