<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : ''; 
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
  // CONSULTA INICIAL
  $consulta="SELECT cliente.*
            FROM cliente INNER JOIN ((instructor INNER JOIN clase ON instructor.id = clase.id_instructor)
            INNER JOIN membresia ON clase.id = membresia.id_clase) ON cliente.id = membresia.id_cliente";

  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  // CONSULTA CHART LLENADO CANTIDAD DE INSCRITOS POR DISCIPLINA
  if($desde !="" && $hasta !=""){
    $consulta_chart="SELECT clase.clase, COUNT( membresia.id) as INSCRITOS
                    FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) LEFT JOIN membresia ON grupo.id = membresia.id_grupo
                    WHERE membresia.fecha_membresia <= '$hasta' AND membresia.fecha_end_membresia >= '$desde' GROUP by clase.id";
  }else{
    $consulta_chart="SELECT clase.clase, COUNT( membresia.id) as INSCRITOS
                    FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) LEFT JOIN membresia ON grupo.id = membresia.id_grupo
                    GROUP by clase.id";
  }

  $resultado_chart=$conexion->prepare($consulta_chart);
  $resultado_chart->execute();
  $data_chart=$resultado_chart->fetchAll(PDO::FETCH_ASSOC);
  $chart_data_disciplinas_inscritos="";
  foreach ($data_chart as $dat) {  

    $chart_data_disciplinas_inscritos.="{ name:'".$dat['clase']."', y:".$dat['INSCRITOS']."},";      
  }
  $chart_data_disciplinas_inscritos = substr($chart_data_disciplinas_inscritos,0,-1);
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : ''; 
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
 ?>
<?php
  include_once("vistas/plantilla.php");
?>

          <!-- INCIO CONTENIDO -->
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >Reporte de Clientes</h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">                
              </div>

            </div>
            <form id="form_filtrar" action="reporte-clientes.php" class="ml-4 mr-4">
              <div class="row">                                      
                  <div class="form-group col-lg-3">
                    <label for="Nombre" class="col-form-label">Desde:</label>
                    <input type="date" class="form-control" name="desde" id="fecha_ini" value="<?php echo $desde; ?>">
                  </div>  
                  <div class="form-group col-lg-3">
                    <label for="Nombre" class="col-form-label">Hasta:</label>
                    <input type="date" class="form-control" name="hasta" id="fecha_fin" value="<?php echo $hasta; ?>">
                  </div>    
                  <div class="form-group col-lg-3">
                  </div>            
                  <div class="form-group col-lg-3  align-self-end">
                    <button type="submit" id="btnFiltrar" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar Registros</button>                  
                  </div>                
              </div>
            </form>
          </div>
          <!-- Tabla -->
        <!-- <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table id="tablaPersonas" class="table table-striped table-bordered table-condensed tablaPersonas" style="width:100%">
                  <thead class="text-centered">
                    <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Carnet de Identidad</th>
                      <th>Sexo</th>
                      <th>Telefono</th>
                      <th>Correo</th>
                      
                      
                    </tr>
                  </thead>
                  <tbody> -->
                    <?php
                      // foreach ($data as $dat) {
                     ?>
                    <tr>
                      <!-- <td><?php // echo $dat['id']; ?></td>
                      <td><?php // echo $dat['nombre']; ?></td>
                      <td><?php // echo $dat['apellido']; ?></td>
                      <td><?php // echo $dat['carnet_identidad']; ?></td>
                      <td><?php // echo $dat['sexo']; ?></td>
                      <td><?php // echo $dat['telefono']; ?></td>
                      <td><?php // echo $dat['correo']; ?></td> -->
                      
                     
                    </tr>
                    <?php
                        // }
                     ?>
                  <!-- </tbody>
                </table>

              </div>

            </div>

          </div>

        </div>
 -->


        <!-- Fin - Tabla -->
        <div class="container" id="reportes_html">
           <?php include ("agrupado_reporte.php") ?>                              
        </div>

        <figure class="highcharts-figure">
          <div id="container"></div>
          
        </figure>     
     


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
       
<!-- HIG CHART -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="dist/js/scripts.js"></script>

  <!-- Codigo propio JS -->
  <script type="text/javascript" src="js/main-reporte-clientes.js"></script>
  <script type ="text/javascript">
  Highcharts.chart('container', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: 'Inscritos por Disciplinas'
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  accessibility: {
    point: {
      valueSuffix: '%'
    }
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        // format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>Inscritos: {point.y}'
      }
    }
  },  
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: [<?php echo $chart_data_disciplinas_inscritos; ?>]
    // data: [{
    //   name: 'Chrome',
    //   y: 61.41,
    //   sliced: true,
    //   selected: true
    // }, {
    //   name: 'Internet Explorer',
    //   y: 51.84
    // }, {
    //   name: 'Firefox',
    //   y: 10.85
    // }, {
    //   name: 'Edge',
    //   y: 4.67
    // }, {
    //   name: 'Safari',
    //   y: 4.18
    // }, {
    //   name: 'Sogou Explorer',
    //   y: 1.64
    // }, {
    //   name: 'Opera',
    //   y: 1.6
    // }, {
    //   name: 'QQ',
    //   y: 1.2
    // }, {
    //   name: 'Other',
    //   y: 2.61
    // }]
  }]
});
  
  </script>

  </body>
</html>
