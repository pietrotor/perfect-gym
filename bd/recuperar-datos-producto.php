<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
    
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $consulta = "SELECT * FROM producto WHERE id = '$id'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if ($data1){
        foreach ($data1 as $row) {                                                         
            $return = array ('producto' =>$row['producto'], 'categoria'=>$row['categoria'],'descripcion'=>$row['descripcion'], 'precio'=>$row['precio'], 'stock'=>$row['stock'], 'foto'=>$row['foto']);                                       
        } 
    }
    die(json_encode($return));
    $conexion = NULL;
    