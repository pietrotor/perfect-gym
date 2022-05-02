<?php


include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

$id_membresia = (isset($_POST['id-membresia'])) ? $_POST['id-membresia'] : '';

$consulta = "SELECT num_clases_inicial,fecha_membresia,fecha_end_membresia,id_cliente,id_grupo,id FROM membresia WHERE id = '$id_membresia'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  $id_cliente="";
  $id_grupo="";
  if ($data){
    foreach ($data as $row) {                           
        $id_cliente= $row['id_cliente']; 
        $id_grupo= $row['id_grupo']; 
        $datos_membresia = array ('sesion' => $row['num_clases_inicial'], 'inicio' =>$row['fecha_membresia'], 'fin'=>$row['fecha_end_membresia'],'id_membresia'=>$row['id']);                                       
        
    }
}
$hoy= date('Y-m-d');
$consulta = "SELECT   nombre,apellido,carnet_identidad   FROM cliente WHERE id = '$id_cliente'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if ($data1){
        foreach ($data1 as $row) {                                                   
            $datos_personales = array ('nombre' => $row['nombre'],'apellido' => $row['apellido'],'carnet_identidad' => $row['carnet_identidad']);                                                
        }     
    }  
    $consulta = "SELECT  precio, id_clase  FROM grupo WHERE id = '$id_grupo'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $datos_grupo=array('precio'=>$row['precio'], 'id_clase'=>$row['id_clase']);
        }
    }
    
    $id_clase=$datos_grupo['id_clase'];
    $consulta = "SELECT  clase  FROM clase WHERE id = '$id_clase'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $datos_clase=array('clase'=>$row['clase']);
        }
    }
    
    $consulta = "SELECT  *  FROM datos_empresa";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $datos_empresa=array('direccion'=>$row['direccion'], 'ciudad'=>$row['ciudad'], 'pais'=>$row['pais'], 'razon_social'=>$row['razon_social']);
        }
    }

    $datos_finales=array_merge($datos_personales,$datos_membresia,$datos_clase, $datos_grupo, $datos_empresa);
    $conexion = NULL;
   





//INICIO CREACION PDF

require_once __DIR__ . '/vendor/autoload.php';


//PASAR LAS VARIABLES


$mpdf = new \Mpdf\Mpdf();




//PLATINLLA USO

$conteHTML='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>COMPROBANTE DE INSCRIPCION</title>
    <link rel="stylesheet" href="platilla/style.css" media="all" />
    
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        
        <img style="width:200px;" src="imagenes-sistema/logo.png">
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
            <th class="service">DISCIPLINA</th>
            <th class="desc">FECHA DE INSCRIPCION</th>
            <th>FECHA DE CADUCACIÓN</th>
            <th>NÚMERO DE SESIONES</th>
            <th>PRECIO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="unit">'.$datos_finales['id_membresia'].'</td>
            <td class="unit">'.strtoupper($datos_finales['clase']).'</td>
            <td class="unit">'.$datos_finales['inicio'].'</td>
            <td class="unit">'.$datos_finales['fin'].'</td>
            <td class="qty">'.$datos_finales['sesion'].'</td>
            <td class="total">'.$datos_finales['precio'].'</td>
          </tr>        
          <tr>
            <td colspan="5" class="grand total">TOTAL</td>
            <td class="grand total">'.$datos_finales['precio'].'</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>BIENVENIDO:</div>
        <div class="notice">Muchas gracias por formar parte de esta familia, juntos lograremos los cambios que te propongas</div>
      </div>
    </main>
    <footer>
      Dirección: '.$datos_finales['direccion'].', '.$datos_finales['ciudad'].', '.$datos_finales['pais'].'. '.$datos_finales['razon_social'].'
    </footer>
  </body>
</html>';


//ESCRIBIR EL PDF

$mpdf->WriteHTML($conteHTML);

//output al navegador

$mpdf->Output('comprobante.pdf','I');