<?php
session_start();
include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

$id_grupo=(isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';

$consulta = "SELECT limitar_cupos, maximo_cupo FROM grupo WHERE id= '$id_grupo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
if ($data){
  foreach ($data as $row) {                    
      $return_grupo_limitaciones = array ('limitar_cupos' => $row['limitar_cupos'], 'maximo_cupo' => $row['maximo_cupo']);
  }
}

if ((int)$return_grupo_limitaciones['limitar_cupos'] == 1) {
  $consulta = "SELECT COUNT(id) as inscritos FROM membresia WHERE id_grupo = '$id_grupo' AND estado = 1";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
  if ($data){
    foreach ($data as $row) {                    
        $return_cantidad_de_inscritos = array ('inscritos' => $row['inscritos']);
    }
  }
  $disponibles = (int)$return_grupo_limitaciones['maximo_cupo'] - (int)$return_cantidad_de_inscritos['inscritos'];
  $return_cupos_disponibles = array('cupos_disponibles' => $disponibles);
} else {
  $return_cupos_disponibles = array ('cupos_disponibles' => (int)$return_grupo_limitaciones['maximo_cupo']);
}

$return_final=array_merge($return_grupo_limitaciones, $return_cupos_disponibles);
die(json_encode($return_final));
$conexion = NULL;