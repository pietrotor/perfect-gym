<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
require_once('../vistas/start_session.php');


  // Recepcion de los datos del main.js por metodo POST
    
    $id_usuario=$_SESSION['$id_usuario'];
    $consulta = "SELECT * FROM usuario WHERE id = '$id_usuario'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if ($data1){
        foreach ($data1 as $row) {                                                         
            $return = array ('nombre' =>$row['nombre'], 'apellido'=>$row['apellido'],'carnet_identidad'=>$row['carnet_identidad'], 'telefono'=>$row['telefono'], 'usuario'=>$row['usuario'], 'password'=>$row['password'], 'id_rol'=>$row['id_rol']);                                       
        } 
    }    
    die(json_encode($return));
    $conexion = NULL;