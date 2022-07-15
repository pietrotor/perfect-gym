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

$asunto_inscripcion_email=(isset($_POST['email_inscripcion_asunto'])) ? $_POST['email_inscripcion_asunto'] : '';
$cuerpo_inscripcion_email=(isset($_POST['email_inscripcion_cuerpo'])) ? $_POST['email_inscripcion_cuerpo'] : '';
$alt_inscripcion_email=(isset($_POST['email_inscripcion_alt'])) ? $_POST['email_inscripcion_alt'] : '';
$texto_boton_email=(isset($_POST['email_inscripcion_texto_boton'])) ? $_POST['email_inscripcion_texto_boton'] : '';
$link_inscripcion_email=(isset($_POST['email_inscripcion_link_boton'])) ? $_POST['email_inscripcion_link_boton'] : '';
$asunto_recordatorio_email=(isset($_POST['email_recordatorio_asunto'])) ? $_POST['email_recordatorio_asunto'] : '';
$cuerpo_recordatorio_email=(isset($_POST['email_recordatorio_cuerpo'])) ? $_POST['email_recordatorio_cuerpo'] : '';
$alt_recordatorio_email=(isset($_POST['email_recordatorio_alt'])) ? $_POST['email_recordatorio_alt'] : '';
$sesiones_recordatorio_email=(isset($_POST['email_recordatorio_sesiones'])) ? $_POST['email_recordatorio_sesiones'] : '';
$asunto_vencimiento_email=(isset($_POST['email_vencimiento_asunto'])) ? $_POST['email_vencimiento_asunto'] : '';
$cuerpo_vencimiento_email=(isset($_POST['email_vencimiento_cuerpo'])) ? $_POST['email_vencimiento_cuerpo'] : '';
$alt_vencimiento_email=(isset($_POST['email_vencimiento_alt'])) ? $_POST['email_vencimiento_alt'] : '';
$contenido_texto_pdf=(isset($_POST['comprobante_pdf_cuerpo'])) ? $_POST['comprobante_pdf_cuerpo'] : '';


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
    case 3:
        $consulta="UPDATE datos_empresa SET 
                   asunto_inscripcion_email = '$asunto_inscripcion_email', 
                   cuerpo_inscripcion_email = '$cuerpo_inscripcion_email', 
                   alt_inscripcion_email = '$alt_inscripcion_email', 
                   texto_boton_email = '$texto_boton_email', 
                   link_inscripcion_email = '$link_inscripcion_email', 
                   asunto_recordatorio_email = '$asunto_recordatorio_email', 
                   cuerpo_recordatorio_email = '$cuerpo_recordatorio_email', 
                   alt_recordatorio_email = '$alt_recordatorio_email', 
                   sesiones_recordatorio_email = '$sesiones_recordatorio_email', 
                   asunto_vencimiento_email = '$asunto_vencimiento_email', 
                   cuerpo_vencimiento_email = '$cuerpo_vencimiento_email', 
                   alt_vencimiento_email = '$alt_vencimiento_email', 
                   contenido_texto_pdf = '$contenido_texto_pdf'
                   WHERE id ='1'";
        $resultado=$conexion->prepare($consulta);
        $resultado->execute();
        break;
    default:        
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
