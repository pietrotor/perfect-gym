<?php

include_once("bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();

  // Recepcion de los datos del main.js por metodo POST
$producto=(isset($_POST['producto'])) ? $_POST['producto'] : '';
$default_valor='-1';

$consulta="SELECT * FROM producto WHERE producto LIKE '$producto%'";
$resultado=$conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);




$consulta_count="SELECT COUNT(id) as cantidad FROM producto WHERE producto LIKE '$producto%'";
$resultado1=$conexion->prepare($consulta_count);
$resultado1->execute();
$data2=$resultado1->fetchAll(PDO::FETCH_ASSOC);

foreach ($data2 as $row) {                                             
  $return = array ('cantidad' => $row['cantidad']);                                       
} 
if($return['cantidad']!=0){
  foreach ($data as $dat) {
      $stock=$dat['stock'];
      $prod=$dat['id'];    
      $valor="agregarProducto('".$prod."')";
      // PROBAR SOLUCIÓN DUPLICIDAD PRODUCTOS
      $consulta_agregado="SELECT COUNT(id) as agregado FROM detalle_venta WHERE id_venta = '$default_valor' AND id_producto = '$prod'";
      $resultado_agregado=$conexion->prepare($consulta_agregado);
      $resultado_agregado->execute();
      $data_agregado=$resultado_agregado->fetchAll(PDO::FETCH_ASSOC);

      foreach ($data_agregado as $row) {                                             
        $return_agregado = array ('agregado' => $row['agregado']);                                       
      } 
      if($return_agregado['agregado']==0){
        // FIN PRUEBA
        
        if ($stock > 0)
        { 
          echo "<li class='list-group-item link-class'><img src=".$dat['foto']." height='40' width='40' class='img-thumbnail' /> ".$dat['producto']." | <span class='text-muted'>".$dat['categoria']."</span> <button type='button' name='button' class='btn btn-primary mt-3 mb-3 font-weight-bold btnNuevo' id='btnNuevo' onclick=".$valor."><i class='fas fa-cart-plus'></i> Agregar</button></li>";
        }else{
          echo "<li class='list-group-item link-class'><img src=".$dat['foto']." height='40' width='40' class='img-thumbnail' /> ".$dat['producto']." | <span class='text-muted'>".$dat['categoria']." | No existen unidades disponibles en stock</span> </li>";
        }
      }else{
          echo "<li class='list-group-item link-class'><img src=".$dat['foto']." height='40' width='40' class='img-thumbnail' /> ".$dat['producto']." | <span class='text-muted'>".$dat['categoria']."</span> | <span class=''  style='color:red'>Ya se encuentra agregado en la lista</span></li>";
      }
  }
}else{
  echo "<li class='list-group-item link-class'><span class='text-muted'>No se encontro ningun producto relacionado</span></li>";
}
