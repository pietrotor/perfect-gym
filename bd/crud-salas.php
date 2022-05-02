<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
   
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $sala=(isset($_POST['sala'])) ? $_POST['sala'] : '';    


    switch ($opcion) {
      case 1://REGISTRO
        $consulta = "INSERT INTO sala (sala) VALUES('$sala') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id,sala FROM sala ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE sala SET sala='$sala' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM sala WHERE id = '$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM sala WHERE id='$id'";
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
