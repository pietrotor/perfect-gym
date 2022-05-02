<?php
include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  $id_clase=(isset($_POST['id_clase_precio'])) ? $_POST['id_clase_precio'] : '';

  $consulta = "SELECT precio,sesiones FROM clase WHERE id = '$id_clase'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return1 = array ('precio' => $row['precio'],'sesiones' => $row['sesiones']);                       
        
    }
  }
  // $consulta="SELECT id, hora_inicio, hora_fin FROM horario WHERE id = '$id_clase'";
  // $resultado=$conexion->prepare($consulta);
  // $resultado->execute();  
  // $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  // foreach ($data as $dat) {
  //   $html="<option value='".$dat['id']."'>< ".$dat['hora_inicio']."' - '".$dat['hora_fin']."</option>";
  // }
  // if ($data){
  //   foreach ($data as $row) {                    
  //       $return2 = array ('contenido' => $html);                       
        
  //   }
  // }
  // $return_final=array_merge($return1,$return2);

die(json_encode($return1));
$conexion = NULL;