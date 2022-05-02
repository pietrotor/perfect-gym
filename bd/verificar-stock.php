<?php
session_start();
include_once("conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
$id=(isset($_POST['id'])) ? $_POST['id'] : '';
$cantidad_inpu=(isset($_POST['cantidad_inpu'])) ? $_POST['cantidad_inpu'] : '';
$consulta = "SELECT stock FROM producto WHERE id = '$id'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
foreach ($data as $row) {                
  $return1 = array ('stock' => $row['stock']);                         
}
if ($return1['stock'] >= $cantidad_inpu){
  $return_respuesta = array ('estado' => true, 'stock' => $return1['stock']);
}else{
  $return_respuesta = array ('estado' => false, 'stock' => $return1['stock']);
}
die(json_encode($return_respuesta));
$conexion = NULL;