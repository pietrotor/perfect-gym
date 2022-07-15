<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST

    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    $id_clase=(isset($_POST['id_clase'])) ? $_POST['id_clase'] : '';
    $denominacion=(isset($_POST['denominacion'])) ? $_POST['denominacion'] : '';
    $instructor=(isset($_POST['instructor'])) ? $_POST['instructor'] : '';
    $sesiones=(isset($_POST['sesiones'])) ? $_POST['sesiones'] : '';
    $precio=(isset($_POST['precio'])) ? $_POST['precio'] : '';
    $sala=(isset($_POST['sala'])) ? $_POST['sala'] : '';
    $hora_inicio=(isset($_POST['hora_inicio'])) ? $_POST['hora_inicio'] : '';
    $hora_fin=(isset($_POST['hora_fin'])) ? $_POST['hora_fin'] : '';
    $dias_limite=(isset($_POST['dias_limite'])) ? $_POST['dias_limite'] : '';
    $limitar_cupos=(isset($_POST['limitar_cupos'])) ? $_POST['limitar_cupos'] : ''; 
    $maximo_cupo=(isset($_POST['maximo_cupo'])) ? $_POST['maximo_cupo'] : ''; 
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : ''; 


    switch ($opcion) {
      case 1://REGISTRO
        $consulta = "INSERT INTO grupo (denominacion, hora_inicio, hora_fin, precio, sesiones, tiempo_limite, limitar_cupos, maximo_cupo, id_clase, id_instructor, id_sala) 
        VALUES('$denominacion', '$hora_inicio', '$hora_fin','$precio', '$sesiones', '$dias_limite', '$limitar_cupos', '$maximo_cupo', '$id_clase', '$instructor', '$sala') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT grupo.id,grupo.denominacion, grupo.hora_inicio, grupo.hora_fin, grupo.precio, grupo.sesiones,CONCAT(instructor.nombre, ' ',instructor.apellido) AS instructor , sala.sala
        FROM sala INNER JOIN (instructor INNER JOIN grupo ON instructor.id = grupo.id_instructor) ON sala.id = grupo.id_sala
        ORDER BY grupo.id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE grupo SET denominacion='$denominacion', hora_inicio='$hora_inicio', hora_fin='$hora_fin', precio='$precio'
             , sesiones='$sesiones', tiempo_limite='$dias_limite', limitar_cupos='$limitar_cupos', maximo_cupo='$maximo_cupo', id_clase='$id_clase',
             id_instructor='$instructor', id_sala = '$sala'
             WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT grupo.id,grupo.denominacion, grupo.hora_inicio, grupo.hora_fin, grupo.precio, grupo.sesiones,CONCAT(instructor.nombre, ' ',instructor.apellido) AS instructor , sala.sala
        FROM sala INNER JOIN (instructor INNER JOIN grupo ON instructor.id = grupo.id_instructor) ON sala.id = grupo.id_sala
        WHERE grupo.id='$id' ORDER BY grupo.id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM grupo WHERE id='$id'";
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

    print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;





 ?>
