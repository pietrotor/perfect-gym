<?php


include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

$id_cliente = (isset($_POST['id-cliente'])) ? $_POST['id-cliente'] : '';

$consulta = "SELECT nombre,apellido,carnet_identidad FROM cliente WHERE id = '$id_cliente'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                   
        $datos_personales = array ('nombre' => $row['nombre'],'apellido' => $row['apellido'],'carnet_identidad' => $row['carnet_identidad']);                          
        
    }
}
$id_clase='';
$hoy= date('Y-m-d');
$consulta = "SELECT  num_clases,fecha_membresia,fecha_end_membresia,id_clase,id  FROM membresia WHERE id_cliente = '$id_cliente' AND estado = '1'  AND fecha_end_membresia >='$hoy' AND num_clases > '0' ";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if ($data1){
        foreach ($data1 as $row) {                                       
            $id_clase= $row['id_clase'];            
            $datos_membresia = array ('sesion' => $row['num_clases'], 'inicio' =>$row['fecha_membresia'], 'fin'=>$row['fecha_end_membresia'],'id_membresia'=>$row['id']);                                       
        }     
    }  
    $consulta = "SELECT  clase  FROM clase WHERE id = '$id_clase'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $datos_clase=array('clase'=>$row['clase']);
        }
      }
    
    $datos_finales=array_merge($datos_personales,$datos_membresia,$datos_clase);
    $conexion = NULL;
   





//INICIO CREACION PDF

require_once __DIR__ . 'vendor/autoload.php';


//PASAR LAS VARIABLES


$mpdf = new \Mpdf\Mpdf();




//PLATINLLA USO

$conteHTML='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="../platilla/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img style="width:200px;" src="https://assets.website-files.com/5e39634c9e322569a23b267b/5e6265e15e2b260e4ce57bc8_fitco.png">
      </div>
      <h1>COMPROBANTE DE INSCRIPCIÓN</h1>      
      <div id="project">        
        <div><span>NOMBRE: </span> '.$datos_finales['nombre'].' </div>
        <div><span>APELLIDO: </span> '.$datos_finales['apellido'].'</div>
        <div><span>CARNET DE IDENTIDAD : </span> '.$datos_finales['carnet_identidad'].' </div>
        <div><span>FECHA : </span> '.$hoy.'</div>        
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">ID</th>
            <th class="desc">FECHA DE INSCRIPCION</th>
            <th>FECHA DE CADUCACIÓN</th>
            <th>NÚMERO DE SESIONES</th>
            <th>PRECIO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service">'.$datos_finales['id_membresia'].'</td>
            <td class="desc">'.$datos_finales['inicio'].'</td>
            <td class="unit">'.$datos_finales['fin'].'</td>
            <td class="qty">'.$datos_finales['sesion'].'</td>
            <td class="total">$1,040.00</td>
          </tr>        
          <tr>
            <td colspan="4" class="grand total">GRAND TOTAL</td>
            <td class="grand total">$6,500.00</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Este es un comprobante de inscripcion, no tiene ningun valor fiscal
    </footer>
  </body>
</html>';


//ESCRIBIR EL PDF

$mpdf->WriteHTML($conteHTML);

//output al navegador

$mpdf->Output('comprobante.pdf','I');