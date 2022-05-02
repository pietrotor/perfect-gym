<?php
include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  $id_pago=(isset($_POST['id_pago'])) ? $_POST['id_pago'] : '';

  $consulta = "SELECT id_membresia FROM membresia_pago WHERE id = '$id_pago'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
  $conexion = NULL;


