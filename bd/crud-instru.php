<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST

    $nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido=(isset($_POST['apellido'])) ? $_POST['apellido'] : '';
    $carnet_identidad=(isset($_POST['carnet_identidad'])) ? $_POST['carnet_identidad'] : '';
    $sexo=(isset($_POST['sexo'])) ? $_POST['sexo'] : '';
    $telefono=(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
    $profesion=(isset($_POST['profesion'])) ? $_POST['profesion'] : '';
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';


    switch ($opcion) {
      case 1://REGISTRO
        $consulta = "INSERT INTO instructor (nombre, apellido, carnet_identidad, telefono, profesion, sexo) VALUES('$nombre', '$apellido', '$carnet_identidad', '$telefono', '$profesion', '$sexo') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, apellido,carnet_identidad, telefono, profesion, sexo FROM instructor ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE instructor SET nombre='$nombre', apellido='$apellido', carnet_identidad='$carnet_identidad', sexo='$sexo', telefono='$telefono', profesion='$profesion' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, apellido,carnet_identidad, telefono, profesion, sexo FROM instructor WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM instructor WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      default:
        // code...
        break;
    }

    print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;




 ?>
