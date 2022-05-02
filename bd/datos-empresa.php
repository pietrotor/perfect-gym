<?php

include_once("../bd/conexion.php");
$objeto = new Conexion();
$conexion=$objeto->Conectar();
require_once('../vistas/start_session.php');

$opcion=(isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$nombre=(isset($_POST['nombre_modal'])) ? $_POST['nombre_modal'] : '';
$direccion=(isset($_POST['direccion_modal'])) ? $_POST['direccion_modal'] : '';
$correo=(isset($_POST['correo_modal'])) ? $_POST['correo_modal'] : '';
$password=(isset($_POST['password_modal'])) ? $_POST['password_modal'] : '';
$sitio_web=(isset($_POST['sitio_web_modal'])) ? $_POST['sitio_web_modal'] : '';
$nit=(isset($_POST['nit_modal'])) ? $_POST['nit_modal'] : '';
$ciudad=(isset($_POST['ciudad_modal'])) ? $_POST['ciudad_modal'] : '';
$pais=(isset($_POST['pais_modal'])) ? $_POST['pais_modal'] : '';

switch($opcion){
    case 1:
        $consulta = "SELECT * FROM datos_empresa";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2:        
        $consulta="UPDATE datos_empresa SET razon_social = '$nombre', direccion = '$direccion', correo_electronico = '$correo',
                  password_correo = '$password', sitio_web = '$sitio_web', ciudad = '$ciudad', pais = '$pais', nit = '$nit' WHERE id ='1'";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM datos_empresa";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['$razon_social'] = $nombre;
        break;
    default:        
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
