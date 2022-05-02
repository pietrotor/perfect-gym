<?php
include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  $fecha_inicio_membresia=(isset($_POST['fecha_inicio_membresia'])) ? $_POST['fecha_inicio_membresia'] : '';
  $id_grupo=(isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
  $consulta = "SELECT tiempo_limite FROM grupo WHERE id = '$id_grupo'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return1 = array ('tiempo_limite' => $row['tiempo_limite']);                               
    }
  }
  $fecha_de_finalizacion=date('Y-m-d', strtotime($fecha_inicio_membresia.' + '.$return1['tiempo_limite'].' days'));
  $return_final = array('fecha_de_caducidad' => $fecha_de_finalizacion);  
die(json_encode($return_final));
$conexion = NULL;