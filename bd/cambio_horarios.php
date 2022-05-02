<?php
include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  $id_clase=(isset($_POST['id_estado_clase'])) ? $_POST['id_estado_clase'] : '';
 
  $consulta="SELECT id, denominacion, hora_inicio, hora_fin FROM grupo WHERE id_clase = '$id_clase'";
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();  
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  $html=$html."<option value='0'>Seleccione un grupo</option>";
  foreach ($data as $dat) {
    $html=$html."<option value=".$dat['id'].">".$dat['denominacion']." - ".$dat['hora_inicio']." - ".$dat['hora_fin']."</option>";
  }
  echo $html;

$conexion = NULL;