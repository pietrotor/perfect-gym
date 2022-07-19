<?php

include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

  $ci=(isset($_POST['carnet_identidad'])) ? $_POST['carnet_identidad'] : '';
   
  $consulta = "SELECT id,nombre,apellido,correo,foto FROM cliente WHERE carnet_identidad = '$ci'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  $id='';

  if ($data){
    foreach ($data as $row) {
        $id=$row['id'];
        $client_info = array ('id' => $row['id'],'nombre' => $row['nombre'],'apellido' => $row['apellido'],'correo' => $row['correo'],'foto' => $row['foto']);
    }
  }else{
    $return_final = array('error'=>'El carnet de identidad no esta guardado en la base de datos');
  }   
  $id_clase='';
  $sesiones='';
  $id_membresia='';
  $hoy= date('Y-m-d');
  $hora = date("H:i:s");
  if ($id!=''){
      $consulta = "SELECT  num_clases,fecha_membresia,fecha_end_membresia,id_grupo,id 
                  FROM membresia 
                  WHERE id_cliente = '$id'
                  AND estado = '1'
                  AND fecha_end_membresia >='$hoy'
                  AND num_clases > '0' ";      
      $resultado = $conexion->prepare($consulta);
      $resultado->execute();
      $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
      if ($data1){
        foreach ($data1 as $row) {                                             
            $sesiones= $row['num_clases']-1;
            $id_grupo= $row['id_grupo'];
            $id_membresia= $row['id'];
            $return = array ('sesion' => $sesiones, 'inicio' =>$row['fecha_membresia'], 'fin'=>$row['fecha_end_membresia'],'id_membresia'=>$row['id']);                                       
        }        
        if($sesiones > 0){
            $consulta = "UPDATE membresia SET num_clases='$sesiones' WHERE id_cliente='$id'";      
            $resultado2 = $conexion->prepare($consulta);
            $resultado2->execute();
        }else{
            $consulta = "UPDATE membresia SET num_clases='$sesiones', estado = '0' WHERE id_cliente='$id'";      
            $resultado2 = $conexion->prepare($consulta);
            $resultado2->execute();
        }        
        if($id_grupo != ''){
          $consulta = "SELECT  id_clase  FROM grupo WHERE id = '$id_grupo'";      
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
          if($data2){
            foreach($data2 as $row){
              $array_id_clase=array('id_clase'=>$row['id_clase']);
            }
          }
          $id_clase=$array_id_clase['id_clase'];
          $consulta = "SELECT  clase  FROM clase WHERE id = '$id_clase'";      
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();
          $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
          if($data2){
            foreach($data2 as $row){
              $return2=array('clase'=>$row['clase']);
            }
          }
          else{
            $return2=array('clase'=>"NO HAY");
          }
        }
        if($id_membresia!=''){
          $consulta = "INSERT INTO asistencia (id_membresia, fecha_ingreso, hora_ingreso, sesiones_restantes) VALUES ('$id_membresia','$hoy', '$hora','$sesiones')";      
          $resultado = $conexion->prepare($consulta);
          $resultado->execute();          
        }
        $consulta = "SELECT  *  FROM datos_empresa"; 
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {
          $returnDatosEmpresa = array ( 'razon_social' => $row['razon_social'],
                                        'link_inscripcion_email' => $row['link_inscripcion_email'],
                                        'asunto_recordatorio_email' => $row['asunto_recordatorio_email'],
                                        'cuerpo_recordatorio_email' => $row['cuerpo_recordatorio_email'],
                                        'alt_recordatorio_email' => $row['alt_recordatorio_email'],
                                        'sesiones_recordatorio_email' => $row['sesiones_recordatorio_email'],
                                        'asunto_vencimiento_email' => $row['asunto_vencimiento_email'],
                                        'cuerpo_vencimiento_email' => $row['cuerpo_vencimiento_email'],
                                        'alt_vencimiento_email' => $row['alt_vencimiento_email']);
        }

        $consulta = "SELECT * FROM membresia_pago WHERE id_membresia = '$id_membresia' ORDER BY id DESC LIMIT 1"; 
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $row) {
          $return_balance_data = array ('saldo' => $row['saldo']);
        }

        $return_final=array_merge($client_info,$return,$return2, $returnDatosEmpresa, $return_balance_data);
      }else{
        $error = array('error' => 'NO TIENE MEMBRESIA ACTIVA');
        $return_final = array_merge($client_info, $error);
      } 
  } 
  
  if(isset($return_final['sesion'])){
    if ($return_final['sesion'] == $return_final['sesiones_recordatorio_email']){
      include_once('../pdf-recordatorio.php');
    }
    if ($return_final['sesion'] == 0){
      include_once('../pdf-recordatorio.php');
    }
  }
  
  
  

die(json_encode($return_final));
$conexion = NULL;