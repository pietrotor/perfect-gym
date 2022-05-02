<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
session_start();

  // Recepcion de los datos del main.js por metodo POST

    $clase=(isset($_POST['clase'])) ? $_POST['clase'] : '';
    $id_instructor=(isset($_POST['id_instructor'])) ? $_POST['id_instructor'] : '';
    $precio=(isset($_POST['precio'])) ? $_POST['precio'] : '';
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $id_sala=(isset($_POST['id_sala'])) ? $_POST['id_sala'] : '';
    $descripcion=(isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
    $sesiones=(isset($_POST['sesiones'])) ? $_POST['sesiones'] : '';
    $hora_ini=(isset($_POST['hora_ini'])) ? $_POST['hora_ini'] : '';
    $hora_fin=(isset($_POST['hora_fin'])) ? $_POST['hora_fin'] : '';
    $id_clase=(isset($_POST['id_clase'])) ? $_POST['id_clase'] : '';
   


    switch ($opcion) {
      case 0:
        $id_clase_post=(isset($_POST['id_clase_tabla'])) ? $_POST['id_clase_tabla'] : '';
        $_SESSION['id_disciplina_tabla']=$id_clase_post;
        $conexion = NULL;
      case 1://REGISTRO
        $consulta = "INSERT INTO clase (clase, descripcion) VALUES('$clase','$descripcion') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM clase ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE clase SET clase='$clase', descripcion='$descripcion' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, clase, descripcion FROM clase WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM clase WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 7://AGREGAR HORARIO
        $consulta = "INSERT INTO horario (hora_inicio, hora_fin, id_clase) VALUES('$hora_ini', '$hora_fin', '$id_clase') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      default:
        // code...
        break;
    }
    if($opcion!=0){
      print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
      $conexion = NULL;
    }





 ?>
