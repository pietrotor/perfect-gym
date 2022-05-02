<?php
// require('database.php');
// session_start();
// $usuario=$_POST['usuario'];
// $clave=$_POST['password'];
// $query="SELECT COUNT(*) as contar FROM usuario WHERE usuario='$usuario' and password ='$clave'";
// $resultado=mysqli_query($conexion,$query);
// $array=mysqli_fetch_array($resultado);
//
// if($array['contar']>0){
//   $_SESSION['$username']=$usuario;
//   header("location:dash_2019/dash.php");
// }else {
//   echo "datos incorrectos";
// }
?>

<?php
  include_once("conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();
  // CONSULTA INICIAL
  session_start();
  $usuario=(isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $password=(isset($_POST['password'])) ? $_POST['password'] : '';
  $hoy= date('Y-m-d');
  $inactivo=0;
  $activo=1;
  $consulta="SELECT COUNT(*) as contar FROM usuario WHERE  usuario ='$usuario' AND password ='$password' AND estado = '1'" ;
  $resultado=$conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                
        $return1 = array ('resultado' => $row['contar']);                        
        
    }  
    $consulta="SELECT usuario.id as Id_Cliente, usuario.*, acceso_usuario.*, rol.*
               FROM (rol INNER JOIN usuario ON rol.id = usuario.id_rol) INNER JOIN acceso_usuario
               ON usuario.id = acceso_usuario.id_usuario
               WHERE  usuario.usuario ='$usuario' AND usuario.password ='$password'" ;
    $resultado=$conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data2 as $row) {                
      $return2 = array ('id' => $row['Id_Cliente'],'nombre' => $row['nombre'],'apellido' => $row['apellido'],
      'rol' => $row['id_rol'],'id_rol' => $row['id_rol']);   
      if($return1['resultado']==1){ 
        $_SESSION['accesos_globales'] = array('cliente_reporte_acceso' => $row['cliente_reporte_acceso'],'disciplina_acceso' => $row['disciplina_acceso'],
        'disciplina_nuevo_acceso' => $row['disciplina_nuevo_acceso'], 'instructor_acceso' => $row['instructor_acceso'],'instructor_acceso' => $row['instructor_acceso'],
        'instructor_nuevo_acceso' => $row['instructor_nuevo_acceso'], 'lista_asistencia_acceso' => $row['lista_asistencia_acceso'],'asistencia_acceso' => $row['asistencia_acceso'],
        'pago_acceso' => $row['pago_acceso'], 'pago_reporte_acceso' => $row['pago_reporte_acceso'], 'tienda_acceso' => $row['tienda_acceso'],
        'tienda_nueva_venta_acceso' => $row['tienda_nueva_venta_acceso'], 'tienda_reporte_acceso' => $row['tienda_reporte_acceso'],'tienda_producto_acceso' => $row['tienda_producto_acceso'],
        'producto_acceso' => $row['producto_acceso'],'producto_nuevo_acceso' => $row['producto_nuevo_acceso'],'producto_editar_acceso' => $row['producto_editar_acceso'],'producto_eliminar_acceso' => $row['producto_eliminar_acceso'], 'usuario_nuevo_acceso' => $row['usuario_nuevo_acceso']
        );     
      }                
    }


    $consulta_update_fecha = "UPDATE membresia SET estado = '$inactivo' WHERE estado = '$activo' AND fecha_end_membresia < '$hoy'";      
    $resultado2 = $conexion->prepare($consulta_update_fecha);
    $resultado2->execute();

    $consulta_logo = "SELECT * FROM datos_empresa";
    $resultado=$conexion->prepare($consulta_logo);
    $resultado->execute();
    $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach($data3 as $row){
      $return_logo =  array ('razon_social' => $row['razon_social']);    
    }

    if($return1['resultado']==1){
      $_SESSION['$id_usuario']=$return2['id'];
      $_SESSION['$nombre']=$return2['nombre'];
      $_SESSION['$apellido']=$return2['apellido'];
      $_SESSION['$rol']=$return2['rol'];
      if ($_SESSION['$rol']==2){
        $_SESSION['$ocultar']="style='display:none;'";
      }else{
        $_SESSION['$ocultar']="";
      }
      $_SESSION['$id_rol']=$return2['id_rol'];
      $_SESSION['$razon_social']=$return_logo['razon_social'];

      
      $return = array('valor' => true);    
      // header("Location:../inicio.php");
      // echo $return1['resultado'];
    }else{
      
      $return = array('valor' => false);  
      // echo $return1['resultado'];
      // header("Location:../ini-sesion.php");
    }    
    die(json_encode($return));
    $conexion = NULL;
  }
  

  
 
