<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
    
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $consulta = "SELECT * FROM cliente WHERE id = '$id'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if ($data1){
        foreach ($data1 as $row) {                                                         
            $return = array ('nombre' =>$row['nombre'], 'apellido'=>$row['apellido'],'carnet_identidad'=>$row['carnet_identidad'], 'sexo'=>$row['sexo'], 'fecha_nacimiento'=>$row['fecha_nacimiento'], 'telefono'=>$row['telefono'], 'correo'=>$row['correo'], 'foto'=>$row['foto']);                                       
        } 
    }
    die(json_encode($return));
    $conexion = NULL;
    