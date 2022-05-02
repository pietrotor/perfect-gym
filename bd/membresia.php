<?php
session_start();
include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

$id=(isset($_POST['id'])) ? $_POST['id'] : '';
$fecha_ini=(isset($_POST['fecha_ini'])) ? $_POST['fecha_ini'] : '';
$id_grupo=(isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
$id_usuario=$_SESSION['$id_usuario'];
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$consulta = "SELECT sesiones, tiempo_limite, precio FROM grupo WHERE id= '$id_grupo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
if ($data){
  foreach ($data as $row) {                    
      $return_datos = array ('sesiones' => $row['sesiones'], 'tiempo_limite' => $row['tiempo_limite'], 'precio' => $row['precio']);    //GUARDAMOS LOS VALORES DEL GRUPO SELECCIONADO                          
  }
}
$fecha_de_caducidad=date('Y-m-d', strtotime($fecha_ini.' + '.$return_datos['tiempo_limite'].' days'));
$sesiones = $return_datos['sesiones'];
$hoy=date('Y-m-d');
$consulta = "INSERT INTO membresia (id_cliente, fecha_membresia, fecha_end_membresia, id_grupo, num_clases, num_clases_inicial) 
            VALUES('$id', '$fecha_ini', '$fecha_de_caducidad', '$id_grupo','$sesiones','$sesiones') ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$consulta = "SELECT id FROM membresia ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return1 = array ('id_membr' => $row['id']);                        
        
    }
  }
$id_n=$return1['id_membr'];
$monto=$return_datos['precio'];
$consulta = "INSERT INTO membresia_pago (fecha_pago, monto, id_membresia,id_usuario) VALUES('$hoy', '$monto', '$id_n','$id_usuario')";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

// $consulta="SELECT cliente.*, clase.*, membresia.*
if ($opcion != 1){
  $consulta="SELECT cliente.*, clase.clase, membresia.estado
  FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
  ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo ORDER BY cliente.id DESC LIMIT 1";
}else{
  $consulta="SELECT membresia.*, membresia_pago.monto as precio, clase.clase, grupo.hora_inicio, grupo.hora_fin
  FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia 
  ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago ON membresia.id = membresia_pago.id_membresia
  where membresia.id_cliente='$id' ORDER BY membresia.id  DESC LIMIT 1";
}
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);






print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;




