<?php
  $desde = (isset($_GET['desde'])) ? $_GET['desde'] : ''; 
  $hasta = (isset($_GET['hasta'])) ? $_GET['hasta'] : ''; 
  $opcion=(isset($_GET['opcion'])) ? $_GET['opcion'] : ''; 


// SACAR EL LISTADO Y CANTIDAD DE DISCIPLINAS
if($desde !="" && $hasta !=""){
//   include_once("bd/conexion.php");
// $objeto = new Conexion();
// $conexion=$objeto->Conectar();
}
if($opcion==''){

  $html="";
  $consulta="SELECT * FROM clase";
    $resultado_disci=$conexion->prepare($consulta);
    $resultado_disci->execute();
    $data_disci=$resultado_disci->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data_disci as $dat) {
      $id_clase = $dat["id"];
        $html .= "<div class='row mt-4'>
                    <div class='col'>
                     <h3><u>".$dat["clase"]."</u></h3>        
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
                        <th>Sexo</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>";
                    if($desde !="" && $hasta !=""){
                      $consulta_datos="SELECT cliente.*
                      FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase)
                      INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo  
                      WHERE clase.id='$id_clase' AND membresia.fecha_membresia <= '$hasta' AND membresia.fecha_end_membresia >= '$desde'";      
                    }else{
                      $consulta_datos="SELECT cliente.*
                      FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) 
                      INNER JOIN (cliente INNER JOIN membresia ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo 
                      WHERE clase.id='$id_clase' AND membresia.estado ='1'";      
                    }
                      $resultado=$conexion->prepare($consulta_datos);
                      $resultado->execute();
                      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                
                      foreach ($data as $dati) { 
  
                      $html.="<tr>
                        <td>".$dati['id']."</td>
                        <td>".$dati['nombre']."</td>
                        <td>".$dati['apellido']."</td>
                        <td>".$dati['carnet_identidad']."</td>
                        <td>".$dati['sexo']."</td>
                        <td>".$dati['telefono']."</td>
                        <td>".$dati['correo']."</td>                       
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

}else{
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
  $return_final = array('data'=>$chart_data_disciplinas_inscritos);
  die(json_encode($return_final));
  $conexion = NULL;
}

//SACAR EL LISTADO DE LOS REGISTRADOS EN UNA DISCIPLINA ESPECIFICA
