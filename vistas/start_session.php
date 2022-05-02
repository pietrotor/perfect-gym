<?php
session_start();
$usuario=$_SESSION['$id_usuario'];
if(!isset($usuario)){
  header("location: ini-sesion.php");
}

?>