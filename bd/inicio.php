<?php

include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
    $hora= (isset($_POST['hora'])) ? $_POST['hora'] : '';
  $consulta = "SELECT  COUNT(id) as TOTAL FROM membresia WHERE estado = '1'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return1 = array ('activos' => $row['TOTAL']);                        
        
    }
  }
  $hoy=date('Y-m-d');
  $mes=date("n");
  
  $consulta = "SELECT  COUNT(id) as ASISTIERON FROM asistencia WHERE fecha_ingreso = '$hoy'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);  

  if ($data){
    foreach ($data as $row) {                    
        $return2 = array ('ingreso' => $row['ASISTIERON']);                        
        
    }
  }
  $consulta = "SELECT  COUNT(id) as VENCIDOS FROM membresia WHERE estado = '0'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return3 = array ('vencidos' => $row['VENCIDOS']);                        
        
    }
  }
  $consulta = "SELECT SUM(monto) as ingreso_hoy FROM membresia_pago
               WHERE membresia_pago.fecha_pago = '$hoy'";  
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                    
        $return4 = array ('ingresos_diarios' => $row['ingreso_hoy']);
        if($return4['ingresos_diarios']==NULL){$return4['ingresos_diarios']=0;}                        
        
    }
  }
  $return_final=array_merge($return1,$return2,$return3,$return4);
  die(json_encode($return_final));
$conexion = NULL;