<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST

    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $producto=(isset($_POST['producto'])) ? $_POST['producto'] : '';
    $categoria=(isset($_POST['categoria'])) ? $_POST['categoria'] : '';
    $precio=(isset($_POST['precio'])) ? $_POST['precio'] : '';
    $stock=(isset($_POST['stock'])) ? $_POST['stock'] : '';
    $descripcion=(isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
    $foto=(isset($_POST['archivo_nombre'])) ? $_POST['archivo_nombre'] : '';   
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';   

    switch ($opcion) {
      case 1://REGISTRO
        $consulta = "INSERT INTO producto (producto, categoria, precio, stock, descripcion, foto) VALUES('$producto', '$categoria', '$precio', '$stock', '$descripcion', '$foto') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM producto ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE producto SET producto='$producto', categoria='$categoria', precio='$precio', stock='$stock', descripcion='$descripcion', foto = '$foto' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, producto, categoria,precio, stock, descripcion, foto FROM producto WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM producto WHERE id='$id'";
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
