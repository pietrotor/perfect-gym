<?php
include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  $id_grupo=(isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
  $consulta = "SELECT precio, sesiones, tiempo_limite, id_instructor, id_sala FROM grupo WHERE id = '$id_grupo'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return1 = array ('precio' => $row['precio'],'sesiones' => $row['sesiones'],'tiempo_limite' => $row['tiempo_limite'],'id_instructor' => $row['id_instructor'],'id_sala' => $row['id_sala']);                               
    }
  }
  $id_instructor = $return1['id_instructor'];
  $date = date("Y-m-d");  
  $return1['precio']=$return1['precio']." Bs";
  $return1['sesiones']=$return1['sesiones']." sesiones"." - ".$return1['tiempo_limite']." días";
  $return1['tiempo_limite']= date('Y-m-d', strtotime($date.' + '.$return1['tiempo_limite'].' days'));  
  $consulta = "SELECT nombre,apellido FROM instructor WHERE id = '$id_instructor'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
  if ($data){
    foreach ($data as $row) {                    
        $return2 = array ('nombre' => $row['nombre'],'apellido' => $row['apellido']);                               
    }
  } 
  $id_sala=$return1['id_sala'];
  $consulta = "SELECT sala FROM sala WHERE id = '$id_sala'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
  if ($data){
    foreach ($data as $row) {                    
        $return3 = array ('sala' => $row['sala']);                               
    }
  }
  $consulta = "SELECT limitar_cupos, maximo_cupo FROM grupo WHERE id = '$id_grupo'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
  if ($data){
    foreach ($data as $row) {                    
        $return_limitado = array ('limitar_cupos' => $row['limitar_cupos'], 'maximo_cupo' => $row['maximo_cupo']);                               
    }
  }
  $return_cantidad_de_inscritos = [];
  // Obtenemos la cantidad de Inscritos
  if ((int)$return_limitado['limitar_cupos'] == 1) {
    $consulta = "SELECT COUNT(id) as inscritos FROM membresia WHERE id_grupo = '$id_grupo' AND estado = 1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  
    if ($data){
      foreach ($data as $row) {                    
          $return_cantidad_de_inscritos = array ('inscritos' => $row['inscritos']);
      }
    }
    $dispo = (int)$return_limitado['maximo_cupo'] - (int)$return_cantidad_de_inscritos['inscritos'];
    $return_cupos_disponibles = array('cupos_disponibles' => $dispo);
  } else {
    $return_cupos_disponibles = array ('cupos_disponibles' => (int)$return_limitado['maximo_cupo']);
  }

  $return_final=array_merge($return1, $return2, $return3, $return_limitado, $return_cupos_disponibles, $return_cantidad_de_inscritos);
die(json_encode($return_final));
$conexion = NULL;