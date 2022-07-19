<?php 

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
session_start();

$id_usuario=$_SESSION['$id_usuario'];
$id_del_cliente=$_SESSION['id_tabla_cliente'];
$id_membresia = (isset($_POST['id_membresia'])) ? $_POST['id_membresia'] : '';
$monto = (isset($_POST['monto'])) ? $_POST['monto'] : 0;

$hoy=date('Y-m-d');

$consulta = "SELECT * FROM membresia_pago WHERE id_membresia = '$id_membresia' ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $row) {
  $last_payment = array ('saldo' => $row['saldo'], 'total_pagado' => $row['total_pagado'], 'total_a_pagar' => $row['total_a_pagar']);
}
if ($last_payment['saldo'] > 0) {
  if ($monto > $last_payment['saldo']) {
    $monto = $last_payment['saldo'];
  }
  $saldo = $last_payment['total_a_pagar'] - ($last_payment['total_pagado'] + $monto);
  $total_pagado = $last_payment['total_pagado'] + $monto;
  $consulta = "INSERT INTO membresia_pago (fecha_pago, id_membresia, id_usuario, total_a_pagar, monto, saldo, total_pagado)
            VALUES('$hoy', '$id_membresia', '$id_usuario', ".$last_payment['total_a_pagar'].", '$monto', '$saldo', '$total_pagado')";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
}

$consulta="SELECT membresia_pago.*, clase.clase
FROM ((clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN membresia 
ON grupo.id = membresia.id_grupo) INNER JOIN membresia_pago 
ON membresia.id = membresia_pago.id_membresia        
WHERE membresia.id_cliente=".$id_del_cliente."";

$resultado=$conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;