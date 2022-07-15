<?php
  include_once("vistas/plantilla.php");
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  $carnet_identidad=$_SESSION['carnet_identidad'];
  $nombre=$_SESSION['nombre'];
  $apellido=$_SESSION['apellido'];
  $sexo=$_SESSION['sexo'];
  $id_del_cliente=$_SESSION['id_tabla_cliente'];
  // CONSULTA INICIAL
  // $consulta="SELECT membresia.id, clase.clase, membresia.fecha_membresia, membresia.fecha_end_membresia, clase.precio, membresia.estado
  //            FROM cliente INNER JOIN (instructor INNER JOIN (clase INNER JOIN membresia ON clase.id = membresia.id_clase) ON instructor.id = clase.id_instructor) ON cliente.id = membresia.id_cliente
  //            where cliente.carnet_identidad='$carnet_identidad' ORDER BY membresia.id  DESC ";
  $consulta="SELECT membresia.*, membresia_pago.monto as precio, clase.clase, grupo.hora_inicio, grupo.hora_fin
             FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia 
             ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia
             where membresia.id_cliente='$id_del_cliente' ORDER BY membresia.id  DESC ";

  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

  $consulta_foto="SELECT foto FROM cliente WHERE carnet_identidad = '$carnet_identidad'";
  $resultado_foto = $conexion->prepare($consulta_foto);
  $resultado_foto->execute();
  $data_foto=$resultado_foto->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data_foto as $row) {                
    $return_foto = array ('foto' => $row['foto']);                             
  }
  if($return_foto['foto']==""){$return_foto['foto']="imagenes/default-avatar.png";}
 ?>

<div class="container">
        
        <div class="row mt-lg-4">
          <div class="col-lg-12">
            <h2>Datos Personales</h2>          
          </div>
        </div>
        <div class="row">                    
            <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control mr-auto" id="nombre" disabled value="<?php echo $nombre;?>">

                <label for="Nombre" class="col-form-label mt-3">Carnet de Identidad:</label>
                <input type="text" class="form-control mr-auto" id="carnet_identidad" disabled value=<?php echo $carnet_identidad;?>>
            </div>                   
            <div class="form-group col-lg-4">
                <label for="Nombre" class="col-form-label">Apelldo:</label>
                <input type="text" class="form-control mr-auto" id="apellido" disabled value=<?php echo $apellido;?>>
                <label for="Nombre" class="col-form-label mt-3">Sexo:</label>
                <input type="text" class="form-control mr-auto" id="sexo" disabled value=<?php echo $sexo;?>>
            </div>                   
         <!-- <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Carnet de Identidad:</label>
                <input type="text" class="form-control mr-auto" id="carnet_identidad" disabled value=<?php //echo $carnet_identidad;?>>
            </div>                   
          <div class="form-group col-lg-3">
                <label for="Nombre" class="col-form-label">Sexo:</label>
                <input type="text" class="form-control mr-auto" id="sexo" disabled value=<?php //echo $sexo;?>>
            </div>                   -->  
            <div class="form-group col-lg-4 ml-auto d-flex justify-content-center align-items-center">
              <img src="<?php echo $return_foto['foto'];?>" style="max-width:300px;max-height:200px; border:2px solid black;" id="foto-persona" >
            </div> 
        </div> 
        <!--INICIO DE TABS-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" style="font-weight:600;">Historial de Membresias</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="font-weight:600;" >Registro de Asistencia</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="pagos-tab" data-bs-toggle="tab" href="#pagos" role="tab" aria-controls="pagos" aria-selected="false" style="font-weight:600;" >Registro de Pagos</a>
          </li>         
        </ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
       <!-- Tabla -->
       <div class="container">
          <div class="row mt-4">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead class="text-centered">
                    <tr>
                      <th>Id</th>
                      <th>Disciplina</th>
                      <th>Horario</th>                      
                      <th>Fecha Inicio</th>
                      <th>Fecha de Finalización</th>
                      <th>Pago</th>
                      <th>Membresia</th>  
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
                      <td><?php $hora_ini=substr($dat['hora_inicio'],0,5); $hora_fin=substr($dat['hora_fin'],0,5); echo $hora_ini." - ".$hora_fin; ?></td>
                      <td><?php echo $dat['fecha_membresia']; ?></td>
                      <td><?php echo $dat['fecha_end_membresia']; ?></td>
                      <td><?php echo $dat['precio']; ?></td>
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
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <!-- TAB 2 -->
    <div class="row">      
        <!-- Tabla -->
        <?php
        // $consulta1="SELECT asistencia.Id, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restante
        // FROM (cliente INNER JOIN ((instructor INNER JOIN clase ON instructor.id = clase.id_instructor) INNER JOIN membresia ON clase.id = membresia.id_clase) 
        // ON cliente.id = membresia.id_cliente) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia 
        // where cliente.carnet_identidad='$carnet_identidad' ORDER BY asistencia.id DESC";
        $consulta1="SELECT asistencia.id, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restantes
        FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (membresia INNER JOIN asistencia 
        ON membresia.id = asistencia.id_membresia) ON grupo.id = membresia.id_grupo        
        WHERE membresia.id_cliente='$id_del_cliente' ORDER BY asistencia.id DESC";

        $resultado1=$conexion->prepare($consulta1);
        $resultado1->execute();
        $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
        
        ?>
        <!-- <style>          
          #tablaAsistencia th, #tablaPagos th{
          font-family: 'Roboto', sans-serif;
          color:white;
          background:#048DF1;
          text-align:center;
          }
          #tablaAsistencia tbody td{
              text-align:center;
          }
        </style> -->
        <div class="container">
          <div class="row mt-4">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaAsistencia" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-centered">
                    <tr>
                      <th>Id</th>                      
                      <th>Clase</th>
                      <th>Fecha</th>
                      <th>Hora de ingreso</th>
                      <th>Sesiones Restantaes</th>                                                             
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data1 as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>                     
                      <td><?php echo $dat['clase']; ?></td>
                      <td><?php $dat['fecha_ingreso']=date("d/m/Y", strtotime($dat['fecha_ingreso'])); echo $dat['fecha_ingreso']; ?></td>
                      <td><?php $dat['hora_ingreso'] = substr($dat['hora_ingreso'],0,5); echo $dat['hora_ingreso']; ?></td>
                      <td><?php echo $dat['sesiones_restantes']; ?></td>                          
                      
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
    </div>           
  </div>
  <div class="tab-pane fade" id="pagos" role="tabpanel" aria-labelledby="contact-tab">    
  <div class="row">      
        <!-- Tabla -->
        <?php
        // $consulta1="SELECT membresia_pago.id, membresia_pago.fecha_pago, cliente.nombre, cliente.apellido, clase.clase, cliente.carnet_identidad, clase.precio
        // FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
        // ON clase.id = membresia.id_clase where cliente.carnet_identidad='$carnet_identidad'";
        $consulta1="SELECT membresia_pago.*, clase.clase
        FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia 
        ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago 
        ON membresia.id = membresia_pago.id_membresia        
        WHERE membresia.id_cliente='$id_del_cliente'";

        $resultado1=$conexion->prepare($consulta1);
        $resultado1->execute();
        $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);
        
        ?>

        <div class="container">
          <div class="row mt-4">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaPagos" class="table table-striped table-bordered table-condensed" style="width:100%">
                <thead class="text-centered">
                    <tr>
                      <th>Id</th>                      
                      <th>Disciplina</th>
                      <th>Fecha de Pago</th>
                      <th>Monto</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data1 as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id']; ?></td>                     
                      <td><?php echo $dat['clase']; ?></td>
                      <td><?php $dat['fecha_pago']=date("d/m/Y", strtotime($dat['fecha_pago'])); echo $dat['fecha_pago']; ?></td>
                      <td><?php echo $dat['monto']; ?></td>                                       
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
    </div>               
  </div>        
  
  
  </div>
</div>
<!--FIN DE TABS-->
<!-- INICIO MODAL  CREAR PDF -->
<div class="modal fade" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title" id="exampleModalLongTitle" style="color:white;">IMPRIMIR COMPROBANTE DE INSCRIPCION</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formPDF" method="post" action="crear-pdf-general.php" target="_blank">
              <div class="modal-body">             
                <div class="form-group">
                  <input type="text" class="d-none" name="id-membresia" id="id-membresia"><!-- GUARDAR EL ID del cliente -->
                </div>
                   <p>¿Esta seguro de imprimir el comprobante de inscripción?</p>   
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnImprimir" class="btn btn-primary" >Impirmir</button>
              </div>        

            </form>
           </div>           
        </div>
      </div>

      <!-- FIN MODAL  -->
            <!-- Modal 2 - Membreisa -->
            <div class="modal fade" id="modalMembresia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Renovar Membresia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formClases">
              <div class="modal-body">                
                  <input type="text" class="d-none" id="id-cliente" value="<?php echo $id_del_cliente;?>"><!-- GUARDAR EL ID del cliente -->      
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
      <!-- Fin - Modal 2 - Membreisa -->                  

        
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
  <script type="text/javascript" src="js/clientes.js"></script>
  <script type="text/javascript">
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
      // $('#id-clase').change(function(){//llenar las disciplinas
      //   id_clase_precio=$('#id-clase').val();
      //   console.log(id_clase_precio);    
      //   $.ajax({
      //     url:"bd/precios-membre.php",
      //     type: "POST",
      //     dataType: "json",
      //     data:{id_clase_precio:id_clase_precio},
      //     success:function(data){
      //         if(data.error!==undefined){                    
      //             return false;
      //          } else {
      //             if(data.precio!==undefined){$('#precio').val(data.precio);};                                        
      //             if(data.sesiones!==undefined){$('#sesiones').val(data.sesiones);};                                        
      //             return true;
      //          }
      //     }
      //   })
      // });
      // $('#id-clase').change(function(){//llenar los horarios
        
      //   $("#id-clase").each(function(){
      //    id_estado_clase=id_clase_precio;
      //    $.post("bd/cambio_horarios.php",{id_estado_clase:id_estado_clase},
      //    function(data){
      //        $("#horario").html(data);
      //    });
      //  });
      // });

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
                      console.log('LIMITADO: ', data.limitar_cupos);
                      console.log('cupos_disponibles: ', data.cupos_disponibles);
                      if (data.limitar_cupos == 1) {
                        $('#cupos_disponibles').val(data.cupos_disponibles);
                      } else {
                        $('#cupos_disponibles').val('Sin Limites');
                      }
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