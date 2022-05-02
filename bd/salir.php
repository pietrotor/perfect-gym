<?php
  session_start();
  session_destroy();
  header("location:../ini-sesion.php");
  exit();
 ?>
