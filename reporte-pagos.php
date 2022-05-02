<?php
  include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  $consulta_suma='';
  $consulta_clientes='';
  function sumar($conexion,$consulta_suma){
    if($consulta_suma=='')
    {
      $consulta_suma="SELECT SUM(monto) as dinero FROM membresia_pago";
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
      $consulta_clientes="SELECT COUNT(id) as num FROM membresia_pago";
    }
    $resultado2=$conexion->prepare($consulta_clientes);
    $resultado2->execute();
    $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
   foreach ($data2 as $dat) {
      $totalclientes=$dat['num'];
   }
   return $totalclientes;
  }

  //RECIBIMOS LOS DATOS
  $date = date("Y-m-d");
  $date_hoy = date('Y-m-d', strtotime($date. '  - 1 month'));
  $disciplina=(isset($_GET['disciplina'])) ? $_GET['disciplina'] : '0'; 
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : ''; 
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
  $date = date("Y-m-d");

  //CASOS DE IF
  
  if(($disciplina != 0) && ( $desde!='') && ( $hasta!='')){  //FILTRADO POR FECHAS Y DISCIPLINAS

  // $consulta="SELECT membresia_pago.id, membresia_pago.fecha_pago, cliente.nombre, cliente.apellido, clase.clase, cliente.carnet_identidad, clase.precio
  // FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  // ON clase.id = membresia.id_clase 
  // WHERE clase.id = '$disciplina' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta="SELECT membresia_pago.id as id_pago, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, membresia_pago.monto
  FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) 
  ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia  
  WHERE clase.id = '$disciplina' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta_suma="SELECT SUM(clase.precio) as dinero FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  ON clase.id = membresia.id_clase WHERE clase.id = '$disciplina' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta_clientes="SELECT COUNT(membresia_pago.id) as num FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  ON clase.id = membresia.id_clase WHERE clase.id = '$disciplina' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta_estadistica="SELECT DAY(membresia_pago.fecha_pago) as dia, sum(membresia_pago.monto) as dinero
  FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia ON grupo.id = membresia.id_grupo) 
  INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia  
  WHERE grupo.id_clase = '$disciplina' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta'  GROUP BY DAY(membresia_pago.fecha_pago) ";


  }else if(($disciplina == 0) && ( $desde!='') && ( $hasta!='')){ //FILTRADO POR FECHAS

    // $consulta="SELECT membresia_pago.id, membresia_pago.fecha_pago, cliente.nombre, cliente.apellido, clase.clase, cliente.carnet_identidad, clase.precio
    // FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
    // ON clase.id = membresia.id_clase WHERE membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

    $consulta="SELECT membresia_pago.id as id_pago, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, membresia_pago.monto
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) 
    ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
    WHERE membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta_suma="SELECT SUM(clase.precio) as dinero FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  ON clase.id = membresia.id_clase WHERE membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta_clientes="SELECT COUNT(membresia_pago.id) as num FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  ON clase.id = membresia.id_clase WHERE membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' ";

  $consulta_estadistica="SELECT DAY(membresia_pago.fecha_pago) AS dia, SUM(membresia_pago.monto) as dinero FROM membresia_pago 
  WHERE membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta' GROUP BY DAY(membresia_pago.fecha_pago) ";

  } else{  // CONSULTA INICIAL

  // $consulta="SELECT membresia_pago.id, membresia_pago.fecha_pago, cliente.nombre, cliente.apellido, clase.clase, cliente.carnet_identidad, clase.precio
  // FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  // ON clase.id = membresia.id_clase ";

  $consulta="SELECT membresia_pago.id as id_pago, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, membresia_pago.monto
             FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) 
             ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia ";
  $consulta_suma='';

  $consulta_estadistica="SELECT DAY(membresia_pago.fecha_pago) AS dia, SUM(clase.precio) as dinero FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
  ON clase.id = membresia.id_clase GROUP BY DAY(membresia_pago.fecha_pago) ";

  $consulta_estadistica="SELECT DAY(membresia_pago.fecha_pago) AS dia, SUM(membresia_pago.monto) as dinero FROM membresia_pago 
  GROUP BY DAY(membresia_pago.fecha_pago) ";

  }

  //EJECUCION CONSULTA TABLA
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

  //EJECUCION ESTADISTICAS
  $resultado_esta=$conexion->prepare($consulta_estadistica);
  $resultado_esta->execute();
  $data_esta=$resultado_esta->fetchAll(PDO::FETCH_ASSOC);
  $chart_data="";
  foreach ($data_esta as $dat) {  
    $chart_data.="{ mes:'".$dat['dia']."', profit:".$dat['dinero']."},";  
  }
  $chart_data = substr($chart_data,0,-1);

 ?>
<?php
  include_once("vistas/plantilla.php");
?>

          <!-- INCIO CONTENIDO -->
          <div class="container">
            <div class="row">
              <div class="col text-center mt-5 h1-titulos">
                <h1 >Reporte de Pagos</h1>
              </div>
            </div>            
          </div>
          <form id="form_filtrar" action="reporte-pagos.php" class="ml-4 mr-4">
          <div class="row">
            <div class="btn-group btn-group" role="group" aria-label="Large button group">
              <button type="button" class="btn btn-dark" style="font-weight:600;"id="btnSemanal">Semanal</button>
              <button type="button" class="btn btn-dark" style="font-weight:600;"id="btnDiario">Diario</button>             
              
            </div>
          
          </div>
          <div class="row">                          
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Desde:</label>
                  <input type="date" class="form-control" name="desde" id="fecha_ini" value="<?php echo $desde ?>">
                </div>  
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Hasta:</label>
                  <input type="date" class="form-control" name="hasta" id="fecha_fin" value="<?php echo $hasta ?>">
                </div>  
                <div class="form-group col-lg-3">
                  <label for="Nombre" class="col-form-label">Disciplinas:</label>
                  <select class="form-control" name="disciplina" id="id-clase">
                    <option value="0">Todas las disciplinas</option>
                      <?php
                        $consulta2="SELECT id, clase FROM clase";
                        $resultado2=$conexion->prepare($consulta2);
                        $resultado2->execute();
                        $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                      <?php
                        foreach ($data2 as $dat) {
                      ?>
                      <option value="<?php echo $dat['id'];?>" <?php if($disciplina==$dat['id']){ echo 'selected';  }  ?> > <?php echo $dat['clase']; ?></option>
                      <?php
                        }
                      ?>
                  </select>
                </div>   
                <div class="form-group col-lg-3  align-self-end">
                  <!-- <button type="submit" id="btnMembresia" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar Registros</button>                   -->
                  <button  id="btnMembresia" class="btn btn-primary"><i class="fas fa-search"></i> Filtrar Registros</button>                  
                </div>                
          </div>             
          
          
          </form>
                     

          <br>
          <!-- <div class="container">
            <div class="row d-flex justify-content-center " >
              <div class="col-lg-4">
                  <div class="card text-center">
                      <div class="card-header bg-primary text-white">
                        <div class="row align-items-center">
                          <div class="col">
                            <i class="fas fa-cash-register fa-4x"></i>
                          </div>
                          <div class="col">
                            <h3 class="display-4"><?php //echo clientes($conexion,$consulta_clientes); ?></h3>
                            <h6>Pagos</h6>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <h5>
                          <a href="#" class="text-primary">Total Transacciones</a>
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
                            <h3 class="display-4"><?php //echo sumar($conexion,$consulta_suma); ?></h3>
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
          <br> -->


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
                      <th>Disciplina</th>
                      <th>Fecha de Pago</th>
                      <th>Monto</th>                      
                    </tr>
                  </thead>
                  <tbody> -->
                    <?php
                      // foreach ($data as $dat) {
                     ?>
                    <!-- <tr>
                      <td><?php // echo $dat['id']; ?></td>
                      <td><?php // echo $dat['nombre']; ?></td>
                      <td><?php // echo $dat['apellido']; ?></td>
                      <td><?php // echo $dat['carnet_identidad']; ?></td>
                      <td><?php // echo $dat['clase']; ?></td>
                      <td><?php // echo $dat['fecha_pago']; ?></td>
                      <td><?php // echo $dat['precio']; ?></td>                      
                  
                    </tr> -->
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
           <?php include ("agrupar_pagos.php") ?>                              
        </div>
                        
      <div class="container">
        <div class="row ">
          <div class="col-lg-12 text-center">
            <h1>Estadisticas</h1>                      
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-12 ">
             <h2 class="ml-4">INGRESOS </h2>            
              <div id="chart" style="overflow-x:auto;"  class="mt-lg-3" >                                    
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
  <script type="text/javascript" src="js/main-reporte-pagos.js"></script>
  <script>
      //PAGOS
      Morris.Bar({
        element: 'chart',
        data:[<?php echo $chart_data ?>],
        xkey:'mes',
        ykeys:['profit'],
        labels:['Ingreso'],
        hideHover:'auto'
      });
      //ASISTENCIAS
      // Morris.Bar({
      //   element: 'chart_2',
      
      //   xkey:'year',
      //   ykeys:['profit'],
      //   labels:['Asistentes'],
      //   //barColors: ["#1DCD9F", "#0B62A4", "#0B62A4", "#0B62A4"],
      //   barColors:['#1DCD9F', '#5e2590'],
      //   gridTextColor: '#000000',
      //   hideHover:'auto'
      // });
     
    </script>

  </body>
</html>
