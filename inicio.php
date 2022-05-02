<?php
include_once("bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
$hoy=date('Y-m-d');
// CONSULTA INICIAL ASISTENCIAS
$consulta="SELECT cliente.*, clase.clase, asistencia.fecha_ingreso, asistencia.hora_ingreso, asistencia.sesiones_restantes, asistencia.id as id_asistencia
FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo) INNER JOIN asistencia ON membresia.id = asistencia.id_membresia
WHERE asistencia.fecha_ingreso='$hoy' ORDER BY asistencia.id DESC";

$resultado=$conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
//CONSULTA INICIAL INSCRITOS HOY

$consulta1="SELECT membresia_pago.id as id_pago, CONCAT(cliente.nombre, ' ', cliente.apellido) as clclient, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, membresia_pago.monto
            FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) 
            ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia
            WHERE membresia_pago.fecha_pago='$hoy' ORDER BY membresia_pago.id DESC";  
  $resultado1=$conexion->prepare($consulta1);
  $resultado1->execute();
  $data1=$resultado1->fetchAll(PDO::FETCH_ASSOC);     
  
//CONSULTA ESTADISTICAS PAGOS
$consulta_esta="SELECT DAY(fecha_pago) as year, SUM(monto) as profit FROM membresia_pago             
                WHERE MONTH(membresia_pago.fecha_pago) = MONTH('$hoy') GROUP by membresia_pago.fecha_pago";
  $resultado_esta=$conexion->prepare($consulta_esta);
  $resultado_esta->execute();
  $data_esta=$resultado_esta->fetchAll(PDO::FETCH_ASSOC);
  $chart_data="";
  foreach ($data_esta as $dat) {  
    $chart_data.="{ year:'".$dat['year']."', profit:".$dat['profit']."},";  
  }
  $chart_data = substr($chart_data,0,-1);

//CONSULTA ESTADISTICAS ASISTENCIAS
$consulta_asist="SELECT  DAY(asistencia.fecha_ingreso) as year, COUNT(asistencia.id) as asistencias
                FROM asistencia 
                WHERE MONTH(asistencia.fecha_ingreso) = MONTH('$hoy') GROUP BY asistencia.fecha_ingreso ORDER BY asistencia.id ASC";
  $resultado_asist=$conexion->prepare($consulta_asist);
  $resultado_asist->execute();
  $data_asist=$resultado_asist->fetchAll(PDO::FETCH_ASSOC);
  $chart_data_asist="";
  foreach ($data_asist as $dat) {  
    $chart_data_asist.="{ year:'".$dat['year']."', profit:".$dat['asistencias']."},";  
  }
  $chart_data_asist = substr($chart_data_asist,0,-1);
 
  include_once("vistas/plantilla.php");
?>

<div class="container mt-md-3">
 <div class="row" >
    <div class="col-lg-3">
        <div class="card text-center">
            <div class="card-header text-white" style="background-color:#1DC99C;">
                <div class="row align-items-center">
                    <div class="col">
                       <i class="fas fa-user-friends fa-4x"></i>
                    </div>
                    <div class="col">
                        <h3 class="display-4" id="clientes-asistencia"></h3>
                        <h6>Asistentes</h6>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h5>
                    <a href="#" class="text-primary">Asistentes hoy</a>
                </h5>
        </div>
    </div>      
 </div>
 <div class="col-lg-3">
        <div class="card text-center">
            <div class="card-header text-white" style="background-color:#1DC99C;">
                <div class="row align-items-center">
                    <div class="col">
                        <i class="fas fa-address-card fa-4x"></i>
                    </div>
                    <div class="col">
                        <h3 class="display-4" id="clientes-inscritos"></h3>
                        <h6>Activas</h6>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h5>
                    <a href="#" class="text-primary">Mem. Activas</a>
                </h5>
        </div>
    </div>      
 </div>
 <div class="col-lg-3">
        <div class="card text-center">
            <div class="card-header text-white" style="background-color:#1DC99C;">
                <div class="row align-items-center">
                    <div class="col">
                        <i class="fas fa-user-times fa-4x"></i>
                    </div>
                    <div class="col">
                        <h3 class="display-4" id="clientes-vencidos"></h3>
                        <h6> Vencidas</h6>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h5>
                    <a href="#" class="text-primary" id="clientes-vencidos">Membresias vencidas </a>
                </h5>
        </div>
    </div>      
 </div>
 
 <div class="col-lg-3">
        <div class="card text-center">
            <div class="card-header text-white" style="background-color:#1DC99C;">
              <div class="row align-items-center">
                <div class="col">
                    <i class="fas fa-dollar-sign fa-4x"></i>
                </div>
                <div class="col">
                  <h3 class="display-4" id="clientes-mensuales"></h3>
                  <h6>Bs</h6>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <h5>
                <a href="#" class="text-primary">Ingresos Hoy</a>
              </h5>
            </div>
        </div>      
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <!-- TABLA -->
        <div class="container mt-5">
          <div class="row">
            <div class="col-lg-12 text-centered">
                <h2 style="text-align:center;">Lista de Asistentes Hoy</h2>
              <div class="table-responsive">
                <table id="tablaAsistentesHoy" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead class="text-centered " style="text-align:center;">
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Apellido</th>                     
                      <th>Clase</th>                     
                      <th>Hora</th>
                      <th>Sesiones Libres</th>                                                                  
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id_asistencia']; ?></td>
                      <td><?php echo $dat['nombre']; ?></td>
                      <td><?php echo $dat['apellido']; ?></td>                     
                      <td><?php echo $dat['clase']; ?></td>                     
                      <td><?php echo $dat['hora_ingreso']; ?></td>
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
        </div>
        <div class="col-md-6">
            <!-- TABLA -->
        <div class="container mt-5">
          <div class="row">
            <div class="col-lg-12 text-centered">
                <h2 style="text-align:center;">Lista de Inscritos Hoy</h2>
              <div class="table-responsive">
                <table id="tablasInscritosHoy" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead class="text-centered " style="text-align:center;">
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                    
                      <th>Carnet de Identidad</th>
                      <th>Clase</th>                      
                      <th>Monto</th>                                                                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($data1 as $dat) {
                     ?>
                    <tr>
                      <td><?php echo $dat['id_pago']; ?></td>
                      <td><?php echo $dat['clclient']; ?></td>                     
                      <td><?php echo $dat['carnet_identidad']; ?></td>
                      <td><?php echo $dat['clase']; ?></td>                      
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
        </div>
    </div>
        <div class="row mt-5">
          <div class="col-lg-6  text-center">
             <h1 >INGRESOS DIARIOS</h1>            
              <div id="chart" class="" >                                    
              </div>  
              <a href="#" class="text-centered">VER MAS</a>                                      
          </div>          
          <div class="col-lg-6  text-center">
             <h1 >ASISTENTES DIARIOS</h1>            
              <div id="chart_2" >                                    
              </div>                                        
          </div>          
        </div>                
    </div>                
</div>



  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="jquery/jquery-3.3.1.min.js"></script>
  <script src="popper/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- datatables JS -->
  <script type="text/javascript" src="datatables/datatables.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="dist/js/scripts.js"></script>
  
  <script type="text/javascript" src="js/inicio.js"></script>
  <script>
		window.onload=function() {
		hora=2;
        $.ajax({
            url:"bd/inicio.php",
            type: "POST",
            dataType: "json",
            data:{hora:hora},
            success:function(data){
                if(data.error!==undefined){                    
                    return false;
                 } else {
                    if(data.activos!==undefined){$('#clientes-inscritos').html(''+data.activos);};                    
                    if(data.ingreso!==undefined){$('#clientes-asistencia').html(''+data.ingreso);};                    
                    if(data.vencidos!==undefined){$('#clientes-vencidos').html(''+data.vencidos);};                    
                    if(data.ingresos_diarios!==undefined){$('#clientes-mensuales').html(''+data.ingresos_diarios);};                    
                    return true;
                 }
            }
          });
		}
		</script>
    <script>
      //PAGOS
      Morris.Bar({
        element: 'chart',
        data:[<?php echo $chart_data ?>],
        xkey:'year',
        ykeys:['profit'],
        labels:['Ingreso'],
        hideHover:'auto'
      });
      //ASISTENCIAS
      Morris.Bar({
        element: 'chart_2',
        data:[<?php echo $chart_data_asist ?>],
        xkey:'year',
        ykeys:['profit'],
        labels:['Asistentes'],
        //barColors: ["#1DCD9F", "#0B62A4", "#0B62A4", "#0B62A4"],
        barColors:['#1DCD9F', '#5e2590'],
        gridTextColor: '#000000',
        hideHover:'auto'
      });
     
    </script>

  </body>
</html>