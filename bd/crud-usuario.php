<?php
require_once('../vistas/start_session.php');

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
    $id_usuario=$_SESSION['$id_usuario'];
    $nombre=(isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido=(isset($_POST['apellido'])) ? $_POST['apellido'] : '';
    $carnet_identidad=(isset($_POST['carnet_identidad'])) ? $_POST['carnet_identidad'] : '';
    $telefono=(isset($_POST['telefono'])) ? $_POST['telefono'] : '';
    $usuario=(isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $contraseña=(isset($_POST['contraseña'])) ? $_POST['contraseña'] : '';
    $rol_usuario=(isset($_POST['rol_usuario'])) ? $_POST['rol_usuario'] : '';
    $id=(isset($_POST['id'])) ? $_POST['id'] : '';
    // $a_nomb_varia= json_decode($_POST['valores_accesos']);
    $val_variab= json_decode($_POST['final_val']); 
    // $a_nomb_varia= $_POST['valores_accesos'];
    // $val_variab= $_POST['accesos_variables']; 
    // $valores_en_array = explode(',', $val_variab);
    $opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';


    switch ($opcion) {
      case 1://REGISTRO
        $consulta = "INSERT INTO usuario (nombre, apellido, carnet_identidad, telefono, usuario, password,estado, id_rol) VALUES('$nombre', '$apellido', '$carnet_identidad', '$telefono', '$usuario', '$contraseña', '1','$rol_usuario') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, apellido,carnet_identidad, telefono, usuario, password FROM usuario ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 2://MODIFCACION
        $consulta = "UPDATE usuario SET nombre='$nombre', apellido='$apellido', carnet_identidad='$carnet_identidad', telefono='$telefono', usuario='$usuario', password='$contraseña', id_rol='$rol_usuario', estado='1' WHERE id='$id_usuario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT id, nombre, apellido,carnet_identidad, telefono, profesion, sexo FROM instructor WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 3://ELIMINACION
        $consulta = "DELETE FROM usuario WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 4:
        $consulta = "SELECT estado FROM usuario WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data1 as $row) {                                             
          $return = array ('estado'=>$row['estado']);                                       
        }   
        $estado_actu=$return['estado'];
        if($estado_actu==1){
          $estado_actu=0;
        }else{
          $estado_actu=1;
        }
        $consulta = "UPDATE usuario SET estado = '$estado_actu' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
      case 5:      
        $consulta = "SELECT * FROM usuario WHERE id = '$id_usuario'";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
        if ($data1){
            foreach ($data1 as $row) {                                                         
                $return = array ('nombre' =>$row['nombre'], 'apellido'=>$row['apellido'],'carnet_identidad'=>$row['carnet_identidad'], 'telefono'=>$row['telefono'], 'usuario'=>$row['usuario'], 'password'=>$row['password']);                                       
            } 
        }
      case 6:
        $consulta = "SELECT id FROM usuario ORDER BY id DESC LIMIT 1";    
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {                
          $return = array ('id' => $row['id']);                                  
        }
        $id_nuevo_usuario=$return['id'];
        $valor_prueba=$val_variab[0];
        $consulta_insert="INSERT INTO `acceso_usuario` (`id_usuario`, `cliente_reporte_acceso`, `disciplina_acceso`, `disciplina_nuevo_acceso`,
         `instructor_acceso`, `instructor_nuevo_acceso`, `lista_asistencia_acceso`, `asistencia_acceso`, `pago_acceso`, `pago_reporte_acceso`, `tienda_acceso`, 
         `tienda_nueva_venta_acceso`, `tienda_reporte_acceso`, `tienda_producto_acceso`, `producto_acceso`, `producto_nuevo_acceso`, `producto_editar_acceso`,
         `producto_eliminar_acceso`, `usuario_nuevo_acceso`) 
         VALUES ( '$id_nuevo_usuario', '".$val_variab[0]."'  , '".$val_variab[1]."', '".$val_variab[2]."', '".$val_variab[3]."', '".$val_variab[4]."', '".$val_variab[5]."', '".$val_variab[6]."', '".$val_variab[7]."', '".$val_variab[8]."', '".$val_variab[9]."', '".$val_variab[10]."',
         '".$val_variab[11]."', '".$val_variab[12]."', '".$val_variab[13]."', '".$val_variab[14]."', '".$val_variab[15]."',
         '".$val_variab[16]."', '".$val_variab[17]."')";
        // $consulta_insert="INSERT INTO `acceso_usuario` (`id_usuario`, `cliente_reporte_acceso`, `disciplina_acceso`, `disciplina_nuevo_acceso`,
        //  `instructor_acceso`, `instructor_nuevo_acceso`, `lista_asistencia_acceso`, `asistencia_acceso`, `pago_acceso`, `pago_reporte_acceso`, `tienda_acceso`, 
        //  `tienda_nueva_venta_acceso`, `tienda_reporte_acceso`, `tienda_producto_acceso`, `producto_acceso`, `producto_nuevo_acceso`, `producto_editar_acceso`,
        //  `producto_eliminar_acceso`, `usuario_nuevo_acceso`) 
        //  VALUES ( '$id_nuevo_usuario', '".$val_variab[0]."', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
        //  '1', '1', '1', '1', '1',
        //  '1', '1')";
         $resultado = $conexion->prepare($consulta_insert);
         $resultado->execute();
         $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
      default:
        // code...
        break;
    }

    print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;




 ?>
