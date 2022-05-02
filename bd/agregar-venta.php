<?php
session_start();
include_once("conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
$id_produ=(isset($_POST['id_produ'])) ? $_POST['id_produ'] : '';
$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_producto_actualizacion=(isset($_POST['id'])) ? $_POST['id'] : '';
$cantidad_inpu=(isset($_POST['cantidad_inpu'])) ? $_POST['cantidad_inpu'] : '';
$id_producto_elimn=(isset($_POST['id'])) ? $_POST['id'] : '';
$id_usuario=$_SESSION['$id_usuario'];
$valor_default='-1';


if($opcion==1){//SELECCIONAR DEL SEARCH BOX

    $consulta = "SELECT * FROM producto WHERE id ='$id_produ'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {              
      $return1 = array ('precio' => $row['precio']);                          
      
    }
    $precio=$return1['precio'];
    $consulta = "INSERT INTO detalle_venta (cantidad, precio_unitario, total, id_producto, id_venta) VALUES ('1', '$precio', '$precio', '$id_produ', '$valor_default')";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    
    $consulta = "SELECT * FROM producto WHERE id ='$id_produ'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

}else if($opcion==2){ //FINALIZAR VENTA
    $hoy= date('Y-m-d');
    $consulta = "INSERT INTO venta (fecha_venta, total_venta, id_usuario) VALUES ('$hoy', '0', '$id_usuario')";//AGREGAR LA VENTA SIN TENER EL DETALLE VENTA
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();

    $consulta = "SELECT id FROM venta ORDER BY id DESC LIMIT 1";//RECUPERO EL ID DE LA VENTA AGREGADA PARA USAR EN EL UPDATE DEL DETALLE VENTA
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {              
      $return2 = array ('id' => $row['id']);                         
    }
    $id_venta=$return2['id'];//ID DE LA VENTA YA AGREGADO

    $consulta = "UPDATE detalle_venta SET id_venta='$id_venta' WHERE id_venta='$valor_default'";//UPDATEMOS EL ID_VENTA DE DETALLE VENTA 
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();    

    $consulta = "SELECT SUM(total) AS total FROM detalle_venta WHERE id_venta = '$id_venta'";//SUMAMOS TODO EL DETALLE VENTA Y GUARDAMOS EN UNA VARIABLE
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {              
      $return3 = array ('total' => $row['total']);                              
    }
    $total_sum_detaVenta = $return3['total'];//TOTAL SUMADO DEL DETALLE VENTA
    $consulta = "UPDATE venta SET total_venta='$total_sum_detaVenta' WHERE id='$id_venta'";//AGREGAMOS EL TOTAL A LA VENTA DE LA SUMA DEL DETALLE VENTA
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();


    //PRUEBA STOCK

    $consulta = "SELECT producto.id, detalle_venta.cantidad FROM producto INNER JOIN detalle_venta ON producto.id=detalle_venta.id_producto WHERE detalle_venta.id_venta ='$id_venta'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $row) {   
      $id_produc_update=$row['id'];
      $venta_cantidad=$row['cantidad'];
      $consulta_interna = "SELECT stock FROM producto WHERE id ='$id_produc_update'";
      $resultado_stock = $conexion->prepare($consulta_interna);
      $resultado_stock->execute();
      $data_stock=$resultado_stock->fetchAll(PDO::FETCH_ASSOC);
      foreach ($data_stock as $row2){
        $stock_inicial = $row2['stock'];
        $nuevo_stock = $stock_inicial - $venta_cantidad;//RESTAMOS EL STOCK INICIAL CON LA NUEVA VENTA
        $consulta_actu_stock = "UPDATE producto SET stock = '$nuevo_stock' WHERE id ='$id_produc_update'";
        $resultado_update_stock = $conexion->prepare($consulta_actu_stock);
        $resultado_update_stock->execute();
      }
    }

    //FIN PRUEBA STOCK

    $consulta = "SELECT * FROM producto WHERE id ='$id_produ'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
    

}
else if($opcion==3){ //MOSTRAR EL TOTAL ACUMULADO DEL DETALLE VENTA
  $consulta = "SELECT SUM(total) as acumulado FROM detalle_venta WHERE id_venta = '$valor_default'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}else if($opcion==4){ // MODIFICAR LA CANTIDAD DE PRODUCTO

  $consulta = "SELECT precio FROM producto WHERE id = '$id_producto_actualizacion'";//SUMAMOS TODO EL DETALLE VENTA Y GUARDAMOS EN UNA VARIABLE
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  foreach ($data as $row) {              
    $return3 = array ('precio' => $row['precio']);                              
  }
  $total_actualizado_producto=$return3['precio'] * $cantidad_inpu;

  $consulta = "UPDATE detalle_venta SET cantidad='$cantidad_inpu', total = '$total_actualizado_producto' WHERE id_producto='$id_producto_actualizacion' AND id_venta = '$valor_default'";      
  $resultado2 = $conexion->prepare($consulta);
  $resultado2->execute();
  
  $consulta = "SELECT SUM(total) as acumulado FROM detalle_venta WHERE id_venta = '$valor_default'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

}else if($opcion==5){ //ELIMINAR DE LA TABLA
  $consulta = "DELETE FROM detalle_venta WHERE id_producto ='$id_producto_elimn' AND id_venta = '$valor_default'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();

  $consulta = "SELECT SUM(total) as total FROM detalle_venta WHERE id_venta = '$valor_default'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}else if($opcion == 6){
  $consulta = "SELECT COUNT(id) as filas FROM detalle_venta WHERE id_venta = '$valor_default'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
