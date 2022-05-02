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
    $correo=(isset($_POST['correo'])) ? $_POST['correo'] : '';
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $fecha_nacimiento=(isset($_POST['fecha_nacimiento'])) ? $_POST['fecha_nacimiento'] : '';
    $archivo_nombre=(isset($_POST['archivo_nombre'])) ? $_POST['archivo_nombre'] : '';


    switch ($opcion) {
      case 1://REGISTRO
        $consulta = "INSERT INTO cliente (nombre, apellido, carnet_identidad, sexo, telefono, correo,fecha_nacimiento,foto) VALUES('$nombre', '$apellido', '$carnet_identidad', '$sexo', '$telefono', '$correo','$fecha_nacimiento','$archivo_nombre') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, apellido,carnet_identidad, sexo, telefono, correo FROM cliente ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE cliente SET nombre='$nombre', apellido='$apellido', carnet_identidad='$carnet_identidad', sexo='$sexo', telefono='$telefono', correo='$correo', foto = '$archivo_nombre' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        // $consulta = "SELECT id, nombre, apellido,carnet_identidad, sexo, telefono, correo FROM cliente WHERE id='$id'";
        $consulta = "SELECT cliente.*, clase.clase, membresia.estado
        FROM (clase INNER JOIN grupo ON clase.id = grupo.id_clase) INNER JOIN (cliente INNER JOIN membresia 
        ON cliente.id = membresia.id_cliente) ON grupo.id = membresia.id_grupo 
        WHERE cliente.id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        $consulta="SELECT cliente.*, clase.clase
           FROM cliente INNER JOIN ((instructor INNER JOIN clase ON instructor.id = clase.id_instructor)
           INNER JOIN membresia ON clase.id = membresia.id_clase) ON cliente.id = membresia.id_cliente WHERE cliente.id='$id'";
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM cliente WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 4://SELECT INICIAL
        $consulta = "SELECT id, nombre, apellido,carnet_identidad, sexo, telefono, correo FROM cliente ";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      default:
        $consulta="SELECT * FROM cliente";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }

    print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;




 ?>