<?php
include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

// session_start();

$id_venta=(isset($_POST['id'])) ? $_POST['id'] : '';

$consulta = "SELECT *
            FROM detalle_venta 
            WHERE id_venta='$id_venta'";
$resultado=$conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $dat) {
    $stock_a_aumentar=$dat['cantidad'];
    $id_producto=$dat['id_producto'];
    $consulta_actu_prodcuto="SELECT stock
                             FROM producto 
                             WHERE id='$id_producto'";
    $resultado_stock=$conexion->prepare($consulta_actu_prodcuto);
    $resultado_stock->execute();
    $data_stock=$resultado_stock->fetchAll(PDO::FETCH_ASSOC);
    if ($data_stock){
        foreach ($data_stock as $row) {                                                         
            $return_stock = array ('stock' =>$row['stock']);                                       
        } 
    }
    $stock_final=$return_stock['stock']+$stock_a_aumentar;
    $consulta_update = "UPDATE producto SET stock='$stock_final'WHERE id='$id_producto'";
    $resultado_update = $conexion->prepare($consulta_update);
    $resultado_update->execute();    
}
$consulta = "DELETE FROM detalle_venta WHERE id_venta='$id_venta'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$consulta = "DELETE FROM venta WHERE id='$id_venta'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
