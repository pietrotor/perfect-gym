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


$consulta = "SELECT * FROM cliente WHERE carnet_identidad = '$carnet_identidad'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
if ($data){
  foreach ($data as $row) {                    
      $return1 = array (
        'id' => $row['id'],
        'nombre' => $row['nombre'],
        'apellido' => $row['apellido'],
        'sexo' => $row['sexo'],
        'id_cliente' => $row['id'],
        'sexo' => $row['sexo']
      );         
  }
}
$id_tabla_cliente = $return1['id_cliente'];
$nombre = $return1['nombre'];
$apellido = $return1['apellido'];
$sexo = $return1['sexo'];
$id_tabla_cliente = $return1['id'];

$_SESSION['carnet_identidad']=$carnet_identidad;
$_SESSION['nombre']=$nombre;
$_SESSION['apellido']=$apellido;
$_SESSION['sexo']=$sexo;
$_SESSION['id_tabla_cliente']=$id_tabla_cliente;
$conexion = NULL;
