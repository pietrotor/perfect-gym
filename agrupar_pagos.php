<?php
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : ''; 
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
  $disciplina=(isset($_GET['disciplina'])) ? $_GET['disciplina'] : '0'; 

// $desde=(isset($_POST['desde'])) ? $_POST['desde'] : '';
// $hasta=(isset($_POST['hasta'])) ? $_POST['hasta'] : '';
// include_once("bd/conexion.php");
// $objeto = new Conexion();
// $conexion=$objeto->Conectar();

// SACAR EL LISTADO Y CANTIDAD DE DISCIPLINAS
// if($desde !="" && $hasta !=""){
//   include_once("bd/conexion.php");
// $objeto = new Conexion();
// $conexion=$objeto->Conectar();
// }


// ------------------------







// ---------  FUNCIONES  --------------

function sumar_en_tablas($conexion,$tabla_id_clase, $fec_desd, $fec_hasta){
  if ($fec_desd == "" && $fec_hasta == ""){
    $consulta_suma1="SELECT SUM(membresia_pago.monto) as ingreso
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase)
    INNER JOIN membresia ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
    WHERE clase.id = '$tabla_id_clase'";  
  }else{
    $consulta_suma1="SELECT SUM(membresia_pago.monto) as ingreso
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase)
    INNER JOIN membresia ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
    WHERE clase.id = '$tabla_id_clase' AND membresia_pago.fecha_pago BETWEEN '$fec_desd' AND '$fec_hasta'";  
  }
  $resultado2=$conexion->prepare($consulta_suma1);
  $resultado2->execute();
  $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
 foreach ($data2 as $dat) {
    $totalsuma=$dat['ingreso'];
 }
 if($totalsuma==NULL){$totalsuma=0;}
 return $totalsuma;
}

function clientes_en_tabla($conexion, $tabla_id_clase, $fec_desd, $fec_hasta){
  if ($fec_desd == "" && $fec_hasta == ""){
    $consulta_clientes1="SELECT COUNT(membresia_pago.id) as num
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase)
    INNER JOIN membresia ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
    WHERE clase.id = '$tabla_id_clase'";
  }else{
    $consulta_clientes1="SELECT COUNT(membresia_pago.id) as num
    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase)
    INNER JOIN membresia ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
    WHERE clase.id = '$tabla_id_clase' AND membresia_pago.fecha_pago BETWEEN '$fec_desd' AND '$fec_hasta'";  
  }
  
  
  $resultado2=$conexion->prepare($consulta_clientes1);
  $resultado2->execute();
  $data2=$resultado2->fetchAll(PDO::FETCH_ASSOC);
 foreach ($data2 as $dat) {
    $totalclientes=$dat['num'];
 }
 return $totalclientes;
}

// ----------  FIN FUNCIONES  ---------------


$html="";
if($disciplina != '0'){
  $consulta="SELECT * FROM clase WHERE id = '$disciplina'";
}else{
  $consulta="SELECT * FROM clase";
}

  $resultado_disci=$conexion->prepare($consulta);
  $resultado_disci->execute();
  $data_disci=$resultado_disci->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data_disci as $dat) {
    $id_clase = $dat["id"];
    $suma_final = sumar_en_tablas($conexion, $id_clase, $desde, $hasta);
    $clientes_finales = clientes_en_tabla($conexion,$id_clase, $desde, $hasta);
      $html .= "<div class='row mt-4'>
                  <div class='col'>
                   <h3><u>".$dat["clase"]."</u></h3>        
                  </div>
               </div>       
                <div class='container'>
                  <div class='row d-flex justify-content-center ' >
                    <div class='col-lg-4'>
                        <div class='card text-center'>
                            <div class='card-header bg-primary text-white'>
                              <div class='row align-items-center'>
                                <div class='col'>
                                  <i class='fas fa-cash-register fa-4x'></i>
                                </div>
                                <div class='col'>
                                  <h3 class='display-4'>".$clientes_finales."</h3>
                                  <h6>Pagos</h6>
                                </div>
                              </div>
                            </div>
                            <div class='card-footer'>
                              <h5>
                                <a href='#' class='text-primary'>Total Transacciones</a>
                              </h5>
                            </div>
                        </div>      
                    </div>              
                    <div class='col-lg-4'>
                        <div class='card text-center'>
                            <div class='card-header bg-primary text-white'>
                              <div class='row align-items-center'>
                                <div class='col'>
                                <i class='fas fa-hand-holding-usd fa-4x'></i>
                                </div>
                                <div class='col'>
                                  <h3 class='display-4'>".$suma_final."</h3>
                                  <h6>Bs</h6>
                                </div>
                              </div>
                            </div>
                            <div class='card-footer'>
                              <h5>
                                <a href='#' class='text-primary'>Total Recaudado</a>
                              </h5>
                            </div>
                        </div>      
                    </div>
                  </div>
                </div>
               


          <div class='row mt-2'>
            <div class='col-lg-12'>
              <div class='table-responsive'>
                <table id='tablaPersonas' class='table table-striped table-bordered table-condensed tablaPersonas' style='width:100%'>
                  <thead class='text-centered'>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Carnet de Identidad</th>
                        <th>Grupo</th>
                        <th>Fecha de Pago</th>
                        <th>Monto</th>                       
                      
                    </tr>
                  </thead>
                  <tbody>";
                  if($desde !="" && $hasta !=""){

                    // $consulta_datos="SELECT membresia_pago.id, membresia_pago.fecha_pago, cliente.nombre, cliente.apellido, clase.clase, cliente.carnet_identidad, clase.precio
                    // FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
                    // ON clase.id = membresia.id_clase 
                    // WHERE  membresia.id_clase = '$id_clase' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta'";

                    $consulta_datos="SELECT membresia_pago.id as id_pago, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, membresia_pago.monto, grupo.denominacion
                    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo) 
                    INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
                    WHERE  grupo.id_clase = '$id_clase' AND membresia_pago.fecha_pago BETWEEN '$desde' AND '$hasta'";

                  }else{

                    // $consulta_datos="SELECT membresia_pago.id, membresia_pago.fecha_pago, cliente.nombre, cliente.apellido, clase.clase, cliente.carnet_identidad, clase.precio
                    // FROM clase INNER JOIN (cliente INNER JOIN (membresia INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia) ON cliente.id = membresia.id_cliente) 
                    // ON clase.id = membresia.id_clase WHERE membresia.id_clase = '$id_clase'";  

                    $consulta_datos="SELECT membresia_pago.id as id_pago, cliente.nombre, cliente.apellido, cliente.carnet_identidad, clase.clase, membresia_pago.fecha_pago, membresia_pago.monto, grupo.denominacion
                    FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) 
                    ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia 
                     WHERE grupo.id_clase = '$id_clase'";     

                  }

                  
                    $resultado=$conexion->prepare($consulta_datos);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                
                    foreach ($data as $dati) { 

                    $html.="<tr>
                      <td>".$dati['id_pago']."</td>
                      <td>".$dati['nombre']."</td>
                      <td>".$dati['apellido']."</td>
                      <td>".$dati['carnet_identidad']."</td>
                      <td>".$dati['denominacion']."</td>
                      <td>".$dati['fecha_pago']."</td>
                      <td>".$dati['monto']."</td>                       
                    </tr>";
                    }
                  $html .="</tbody>
                </table>

              </div>

            </div>

          </div>         
          
          ";      
  }





  echo $html;
?>
