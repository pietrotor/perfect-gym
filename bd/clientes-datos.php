<?php

include_once("conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

session_start();

$carnet_identidad=(isset($_POST['carnet_identidad'])) ? $_POST['carnet_identidad'] : '';
$nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido=(isset($_POST['apellido'])) ? $_POST['apellido'] : '';
$sexo=(isset($_POST['sexo'])) ? $_POST['sexo'] : '';
$id_tabla_cliente=(isset($_POST['id_tabla_cliente'])) ? $_POST['id_tabla_cliente'] : '';


$consulta = "SELECT id, sexo FROM cliente WHERE carnet_identidad = '$carnet_identidad'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
if ($data){
  foreach ($data as $row) {                    
      $return1 = array ('id_cliente' => $row['id'], 'sexo' => $row['sexo']);                               
  }
}
$id_tabla_cliente = $return1['id_cliente'];
$sexo=$return1['sexo'];

$_SESSION['carnet_identidad']=$carnet_identidad;
$_SESSION['nombre']=$nombre;
$_SESSION['apellido']=$apellido;
$_SESSION['sexo']=$sexo;
$_SESSION['id_tabla_cliente']=$id_tabla_cliente;
$conexion = NULL;
