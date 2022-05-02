<?php
  include ('database.php');
  $query="SELECT * FROM cliente";
  $result=mysqli_query  ($conexion,$query);
  if(!$result){
    die('Query failed'.mysqli_error($conexion));
  }
  $json=array();
  while ($row=mysqli_fetch_array($result)) {
    $json[]=array(
      'nombre'=>$row['nombre'],
      'apellido'=>$row['apellido'],
      'carnet_identidad'=>$row['carnet_identidad'],
      'edad'=>$row['edad'],
      'id'=>$row['id']
    );
  }
  $jsonstring=json_encode($json);
  echo $jsonstring;


 ?>
