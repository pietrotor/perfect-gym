<?php

  class Conexion{
    public static function Conectar(){
      define('servidor','us-cdbr-east-06.cleardb.net');
      // define('nombre_bd','perfect-gym2');
      define('nombre_bd','heroku_b9a10f3a12f1d56');
      define('usuario','b5504b2a5ea27e');
      define('password','2683f689');
      $opciones=array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
      try {
          $conexion=new PDO("mysql:host=".servidor."; dbname=".nombre_bd, usuario, password, $opciones);
          return $conexion;
      } catch (Exception $e) {
        die("El error de la conexoin es: ".$e->getMessage());
      }
    }
  }
?>
