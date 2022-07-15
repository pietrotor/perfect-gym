<?php

  class Conexion{
    public static function Conectar(){
      define('servidor','us-cdbr-east-06.cleardb.net');
      // define('nombre_bd','perfect-gym2');
      define('nombre_bd','heroku_d3b6dc432a58281');
      define('usuario','baf3a3884f845c');
      define('password','34c0c617');
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
