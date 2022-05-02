<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();


$carnet_identidad=(isset($_POST['carnet_identidad'])) ? $_POST['carnet_identidad'] : '';
$id_cliente=(isset($_POST['id_clien'])) ? $_POST['id_clien'] : '';
$paso=(isset($_POST['paso'])) ? $_POST['paso'] : '';

if ($paso==0){
    $consulta = "SELECT id FROM cliente WHERE carnet_identidad = '$carnet_identidad' ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}else{
    if($paso==1){
        $consulta = "SELECT estado  FROM membresia WHERE id_cliente = '$id_cliente' ORDER BY fecha_membresia DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    }
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
