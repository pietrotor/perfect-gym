<?php

include_once("conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

session_start();

$id=(isset($_POST['id'])) ? $_POST['id'] : '';
$_SESSION['id_venta'] = $id;
$conexion = NULL;