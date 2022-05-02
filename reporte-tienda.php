<?php
  include_once("vistas/plantilla.php");
?>
<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

function sumar($conexion,$consulta_suma){
  if($consulta_suma=='')
  {
    $consulta_suma="SELECT SUM(venta.total_venta) as dinero
    FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
    WHERE venta.fecha_venta = '$hoy'  GROUP BY venta.id";
  }
  $resultado2=$conexion->prepare($consulta_suma);
  $resultado2->execute();
  $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
 foreach ($data2 as $dat) {
    $totalsuma=$dat['dinero'];
 }
 if($totalsuma==NULL){$totalsuma=0;}
 return $totalsuma;
}

function clientes($conexion,$consulta_clientes){
  if($consulta_clientes=='')
  {
    $consulta_clientes="SELECT COUNT(membresia_pago.id) as num FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
    ON clase.id = membresia.id_clase";
  }
  $resultado2=$conexion->prepare($consulta_clientes);
  $resultado2->execute();
  $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
 foreach ($data2 as $dat) {
    $totalclientes=$dat['ventas'];
 }
 return $totalclientes;
}


  // CONSULTA INICIAL
  $usuario=$_SESSION['$id_usuario'];
  $tipo_rol=$_SESSION['$id_rol'];
  $hoy= date('Y-m-d');
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : ''; 
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
  if ($desde=='' && $hasta == ''){//DATOS DEL DÍA
    $consulta="SELECT venta.id, venta.total_venta, venta.fecha_venta, CONCAT(usuario.nombre,' ',usuario.apellido)as nombre
               FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
               WHERE venta.fecha_venta = '$hoy'  GROUP BY venta.id";   
    $consulta_total_recaudado="SELECT SUM(venta.total_venta) as dinero
               FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
               WHERE venta.fecha_venta = '$hoy'  ";   
    $consulta_total_ventas="SELECT COUNT(venta.id) as ventas
               FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
               WHERE venta.fecha_venta = '$hoy'  ";   
    $consulta_estadistica_productos="SELECT producto.producto, SUM(detalle_venta.cantidad) as cantidad, SUM(venta.total_venta) as dinero  FROM (detalle_venta INNER JOIN producto ON detalle_venta.id_producto = producto.id) INNER JOIN venta ON venta.id = detalle_venta.id_venta      
                           GROUP BY producto.producto";
    $consulta_estadistica_ingresos_diarios="SELECT DAY(venta.fecha_venta) as dia, SUM(venta.total_venta) as ingreso  FROM (detalle_venta INNER JOIN producto ON detalle_venta.id_producto = producto.id) INNER JOIN venta ON venta.id = detalle_venta.id_venta      
                                            GROUP BY DAY(venta.fecha_venta)";
               
  }else if ($desde!='' && $hasta != ''){//DATOS FILTRADOS    
    $consulta="SELECT venta.id, venta.total_venta, venta.fecha_venta, CONCAT(usuario.nombre,' ',usuario.apellido)as nombre
    FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
    WHERE venta.fecha_venta BETWEEN '$desde' AND '$hasta' GROUP BY venta.id";   
    $consulta_total_recaudado="SELECT SUM(venta.total_venta) as dinero
        FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
        WHERE venta.fecha_venta BETWEEN '$desde' AND '$hasta' ";   
    $consulta_total_ventas="SELECT COUNT(venta.id) as ventas
        FROM (usuario INNER JOIN venta ON usuario.id = venta.id_usuario) INNER JOIN detalle_venta ON venta.id = detalle_venta.id_venta
        WHERE venta.fecha_venta BETWEEN '$desde' AND '$hasta' "; 
    $consulta_estadistica_productos="SELECT producto.producto, SUM(detalle_venta.cantidad) as cantidad, SUM(venta.total_venta) as dinero  FROM (detalle_venta INNER JOIN producto ON detalle_venta.id_producto = producto.id) INNER JOIN venta ON venta.id = detalle_venta.id_venta 
                           WHERE venta.fecha_venta BETWEEN '$desde' AND '$hasta'
                           GROUP BY producto.producto ";
    $consulta_estadistica_ingresos_diarios="SELECT DAY(venta.fecha_venta) as dia, SUM(venta.total_venta) as ingreso  FROM (detalle_venta INNER JOIN producto ON detalle_venta.id_producto = producto.id) INNER JOIN venta ON venta.id = detalle_venta.id_venta      
                                            WHERE venta.fecha_venta BETWEEN '$desde' AND '$hasta'
                                            GROUP BY DAY(venta.fecha_venta)";
  }

  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

  //EJECUCION ESTADISTICAS PRODUCTOS
  $resultado_esta=$conexion->prepare($consulta_estadistica_productos);
  $resultado_esta->execute();
  $data_esta=$resultado_esta->fetchAll(PDO::FETCH_ASSOC);
  $chart_data="";
  $chart_data_ingresos="";
  foreach ($data_esta as $dat) {  
    $chart_data.="{ label:'".$dat['producto']."', value:".$dat['cantidad']."},";  
    $chart_data_ingresos.="{ Producto:'".$dat['producto']."', Ingreso:".$dat['dinero']."},";  
  }
  $chart_data = substr($chart_data,0,-1);
  $chart_data_ingresos = substr($chart_data_ingresos,0,-1);

  //EJECUCION ESTADISTICAS INGRESOS DIARIOS
  $resultado_esta=$conexion->prepare($consulta_estadistica_ingresos_diarios);
  $resultado_esta->execute();
  $data_esta=$resultado_esta->fetchAll(PDO::FETCH_ASSOC);
  $chart_data_dia_ingresos="";
 
  foreach ($data_esta as $dat) {     
    $chart_data_dia_ingresos.="{ Dia:'".$dat['dia']."', Ingreso:".$dat['ingreso']."},";  
  }  
  $chart_data_dia_ingresos = substr($chart_data_dia_ingresos,0,-1);
 ?>
    <!-- INCIO CONTENIDO -->
    <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >Reporte de Ventas</h1>
              </div>
            </div>            
    </div>
    
    <form action="reporte-tienda.php" class="ml-4 mr-4">
          <div class="row">
            <div class="btn-group btn-group" role="group" aria-label="Large button group">
              <button type="button" class="btn btn-dark" style="font-weight:600;"id="btnSemanal">Semanal</button>
              <button type="button" class="btn btn-dark" style="font-weight:600;"id="btnDiario">Diario</button>             
              
            </div>
          
          </div>
          <div class="row">                          
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Desde:</label>
                  <input type="date" class="form-control" name="desde" id="fecha_ini" value="<?php echo $desde?>">
                </div>  
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Hasta:</label>
                  <input type="date" class="form-control" name="hasta" id="fecha_fin" value="<?php echo $hasta?>">
                </div>                    
                <div class="form-group col-lg-3  align-self-end">
                  <button type="submit" id="btnMembresia" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar Registros</button>                  
                </div>                
          </div>              
          
          
          </form>
          <div class="container">
            <div class="row d-flex justify-content-center " >
              <div class="col-lg-4">
                  <div class="card text-center">
                      <div class="card-header bg-primary text-white">
                        <div class="row align-items-center">
                          <div class="col">
                            <i class="fas fa-cash-register fa-4x"></i>
                          </div>
                          <div class="col">
                            <h3 class="display-4"><?php echo clientes($conexion,$consulta_total_ventas) ?></h3>
                            <h6>Ventas</h6>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <h5>
                          <a href="#" class="text-primary">Total Ventas</a>
                        </h5>
                      </div>
                  </div>      
              </div>              
              <div class="col-lg-4">
                  <div class="card text-center">
                      <div class="card-header bg-primary text-white">
                        <div class="row align-items-center">
                          <div class="col">
                          <i class="fas fa-hand-holding-usd fa-4x"></i>
                          </div>
                          <div class="col">
                            <h3 class="display-4"><?php echo sumar($conexion,$consulta_total_recaudado) ?></h3>
                            <h6>Bs</h6>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <h5>
                          <a href="#" class="text-primary">Total Recaudado</a>
                        </h5>
                      </div>
                  </div>      
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
                     <th>Código</th>
                     <th>Total</th>
                     <th>Fecha de Venta</th>
                     <th>Vendedor</th>                     
                     <th>Acciones</th>                      
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                     foreach ($data as $dat) {
                    ?>
                   <tr>
                     <td><?php echo $dat['id']; ?></td>
                     <td><?php echo $dat['total_venta']; ?></td>
                     <td><?php $fecha = date("d/m/Y", strtotime($dat['fecha_venta'])); echo $fecha ; ?></td>                 
                     <td><?php echo $dat['nombre']; ?></td>                      
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

       <div class="container">
        <div class="row ">
          <div class="col-lg-12 text-center">
            <h1>Estadisticas</h1>                      
          </div>
        </div>
        </div>
        <div class="container">
          <div class="row mt-5">
            <div class="col-lg-6 ">
              <h2 class="ml-4">Cantidad Productos Vendidos </h2>            
                <div id="chart_cantidad_producto"  class="mt-lg-3" >                                    
                </div>                                        
            </div>  
            <div class="col-lg-6 ">
              <h2 class="ml-4">Ingresos Por Producto </h2>            
                <div id="chart_ingreso_productos"  class="mt-lg-3" >                                    
                </div>                                        
            </div>         
          </div> 
        </div> 
        <div class="container">
          <div class="row mt-lg-5">
            <div class="col-lg-12 text-center">
              <h2 class="">Ingresos Diarios</h2>                      
              <div id="chart_ingreso_diarios"  class="mt-lg-3" >                                    
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
  <!-- Botones para los datatables JS -->
  <script type="text/javascript" src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>                      
  <script type="text/javascript" src="datatables/JSZip-2.5.0/jszip.min.js"></script>                      
  <script type="text/javascript" src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>                      
  <script type="text/javascript" src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>                     
  <script type="text/javascript" src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>  
  <script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>    
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script src="dist/js/scripts.js"></script>

  <!-- Codigo propio JS -->
  <script type="text/javascript" src="js/main-reporte-ventas.js"></script>
  <script>
      //ESTADISTICA POR PRODUCTOS
      Morris.Donut({
        element: 'chart_cantidad_producto',
        data: [<?php echo $chart_data ?>],
        colors: ['#0097A7',
    '#B2EBF2',
    '#80DEEA',
    '#4DD0E1',
    '#26C6DA',
    '#00BCD4',
    '#00ACC1',
    '#0097A7',
    '#00838F',
    '#006064']   
      });
      //INGRESOS POR PRODUCTO
      Morris.Bar({
        element: 'chart_ingreso_productos', 
        data: [<?php echo $chart_data_ingresos ?>],     
        xkey:'Producto',
        ykeys:['Ingreso'],
        labels:['Ingreso'], 
        barColors: ['#007BFF'],        
        gridTextColor: '#000000',
        hideHover:'auto'
      });
      //INGRESOS POR PRODUCTO
      Morris.Bar({
        element: 'chart_ingreso_diarios', 
        data: [<?php echo $chart_data_dia_ingresos ?>],     
        xkey:'Dia',
        ykeys:['Ingreso'],
        labels:['Bs'],      
        barColors: ['#212529'],  
        gridTextColor: '#000000',
        hideHover:'auto'
      });
     
    </script>