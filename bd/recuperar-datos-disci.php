<?php
include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();


  // Recepcion de los datos del main.js por metodo POST

$id=(isset($_POST['id'])) ? $_POST['id'] : '';
$opc_recu=(isset($_POST['opc_recu'])) ? $_POST['opc_recu'] : '';


 switch ($opc_recu){
    case 1: //INFORMACIÓN DE LA CLASE
      $consulta = "SELECT clase,descripcion FROM clase WHERE id = '$id'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      if ($data){
        foreach ($data as $row) {                    
            $return1 = array ('clase' => $row['clase'], 'descripcion' => $row['descripcion']);                               
        }
      } 
      die(json_encode($return1));     
      break;
    case 2: //INFORMACIÓN DE LOS HORARIOS DE LA CLASE
      $consulta = "SELECT * FROM grupo WHERE id = '$id'";
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      if ($data){
        foreach ($data as $row) {                    
            $return1 = array ('denominacion' => $row['denominacion'],'hora_inicio' => $row['hora_inicio'],
            'hora_fin' => $row['hora_fin'],'precio' => $row['precio'],
            'sesiones' => $row['sesiones'],'tiempo_limite' => $row['tiempo_limite'],
            'id_instructor' => $row['id_instructor'], 'id_sala' => $row['id_sala']);                               
        }
      }  
      die(json_encode($return1));
      break;
 }
// if ($opc_recu == 1){
//   print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
// }else{
//   die(json_encode($return1));
// }
$conexion = NULL;