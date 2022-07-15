<?php
include_once("bd/conexion.php");
  $objeto = new Conexion();
  $conexion=$objeto->Conectar();

$id_cliente = (isset($_POST['id-cliente'])) ? $_POST['id-cliente'] : '';

$consulta = "SELECT nombre,apellido,carnet_identidad,correo FROM cliente WHERE id = '$id_cliente'";
  $resultado = $conexion->prepare($consulta);
  $resultado->execute();
  $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
  if ($data){
    foreach ($data as $row) {                   
        $datos_personales = array ('nombre' => $row['nombre'],'apellido' => $row['apellido'],'carnet_identidad' => $row['carnet_identidad'],'correo' => $row['correo']);                          
        
    }
}
$id_clase='';
$hoy= date('Y-m-d');
$consulta = "SELECT  num_clases,fecha_membresia,fecha_end_membresia,id_grupo,id  FROM membresia WHERE id_cliente = '$id_cliente' AND estado = '1'  AND fecha_end_membresia >='$hoy' AND num_clases > '0' ";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    if ($data1){
        foreach ($data1 as $row) {                                       
            $id_grupo= $row['id_grupo'];           
            $datos_membresia = array ('sesion' => $row['num_clases'], 'inicio' =>$row['fecha_membresia'], 'fin'=>$row['fecha_end_membresia'],'id_membresia'=>$row['id']);                                       
        }     
    }  

    $consulta = "SELECT  id_clase  FROM grupo WHERE id = '$id_grupo'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $array_id_clase=array('id_clase'=>$row['id_clase']);
        }
    }
    $id_clase=$array_id_clase['id_clase'];
    $consulta = "SELECT  clase  FROM clase WHERE id = '$id_clase'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $datos_clase=array('clase'=>$row['clase']);
        }
    }

    $id_membresia=$datos_membresia['id_membresia'];
    $consulta = "SELECT  monto  FROM membresia_pago WHERE id_membresia = '$id_membresia'";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $precio_clase=array('precio'=>$row['monto']);
        }
    }

    $consulta = "SELECT  *  FROM datos_empresa";      
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC); 
    if($data2){
        foreach($data2 as $row){
          $datos_empresa=array('direccion'=>$row['direccion'], 'ciudad'=>$row['ciudad'], 'pais'=>$row['pais'], 'razon_social'=>$row['razon_social'],
                               'asunto'=>$row['asunto_inscripcion_email'], 'cuerpo'=>$row['cuerpo_inscripcion_email'], 'alt'=>$row['alt_inscripcion_email'],
                               'link'=>$row['link_inscripcion_email'], 'texto'=>$row['texto_boton_email']);
        }
    }
    
    $datos_finales=array_merge($datos_personales,$datos_membresia,$datos_clase,$precio_clase, $datos_empresa);
    $conexion = NULL;
   


// Convertir fechas
function obtenerFechaEnLetra($fecha){
  $dia= conocerDiaSemanaFecha($fecha);
  $num = date("j", strtotime($fecha));
  $anno = date("Y", strtotime($fecha));
  $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
  $mes = $mes[(date('m', strtotime($fecha))*1)-1];
  return $dia.', '.$num.' de '.$mes.' del '.$anno;
}

function conocerDiaSemanaFecha($fecha) {
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $dia = $dias[date('w', strtotime($fecha))];
    return $dia;
}

$hoy_escrito = obtenerFechaEnLetra($hoy);
$datos_finales['inicio'] = date("d/m/Y", strtotime($datos_finales['inicio'])); //Cambia de yyyy/mm/dd a dd/mm/yyyy
$datos_finales['fin'] = date("d/m/Y", strtotime($datos_finales['fin']));  //Cambia de yyyy/mm/dd a dd/mm/yyyy



//INICIO CREACION PDF

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/vendor/autoload.php';


//PASAR LAS VARIABLES


$mpdf = new \Mpdf\Mpdf();




//PLATINLLA USO

$conteHTML='<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>COMPROBANTE DE INSCRIPCION</title>
    <link rel="stylesheet" href="platilla/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        
        <img style="width:200px;" src="imagenes-sistema/logo.png">
      </div>
      <h1>COMPROBANTE DE INSCRIPCIÓN</h1>      
      <div id="project">        
        <div><span>NOMBRE: </span> '.$datos_finales['nombre'].' </div>
        <div><span>APELLIDO: </span> '.$datos_finales['apellido'].'</div>
        <div><span>CARNET DE IDENTIDAD : </span> '.$datos_finales['carnet_identidad'].' </div>
        <div><span>FECHA : </span> '.$hoy_escrito.'</div>        
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">ID</th>
            <th class="service">DISCIPLINA</th>
            <th class="desc">FECHA DE INSCRIPCION</th>
            <th>FECHA DE CADUCACIÓN</th>
            <th>NÚMERO DE SESIONES</th>
            <th>PRECIO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="unit">'.$datos_finales['id_membresia'].'</td>
            <td class="unit">'.strtoupper($datos_finales['clase']).'</td>
            <td class="unit">'.$datos_finales['inicio'].'</td>
            <td class="unit">'.$datos_finales['fin'].'</td>
            <td class="qty">'.$datos_finales['sesion'].'</td>
            <td class="total">'.$datos_finales['precio'].'</td>
          </tr>        
          <tr>
            <td colspan="5" class="grand total">TOTAL</td>
            <td class="grand total">'.$datos_finales['precio'].'</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>BIENVENIDO:</div>
        <div class="notice">Muchas gracias por formar parte de esta familia, juntos lograremos los cambios que te propongas</div>
      </div>
    </main>
    <footer>
      Dirección: '.$datos_finales['direccion'].', '.$datos_finales['ciudad'].', '.$datos_finales['pais'].'
    </footer>
  </body>
</html>';


//ESCRIBIR EL PDF

$mpdf->WriteHTML($conteHTML);

//output al navegador

$pdf=$mpdf->Output('','S');




//GRAB ENQURY DATA
$enquirydata=[
  'razon_social'=>$datos_finales['razon_social'],
  'nombre'=>$datos_finales['nombre'],
  'apellido'=>$datos_finales['apellido'],
  'correo'=>$datos_finales['correo'],
  'id_membresia'=>$datos_finales['id_membresia'],
  'asunto'=>$datos_finales['asunto'],
  'cuerpo'=>$datos_finales['cuerpo'],
  'alt'=>$datos_finales['alt'],
  'link'=>$datos_finales['link'],
  'texto'=>$datos_finales['texto']
];


//LLAMAMOS A LA FUNCION ENVIAR EMAIL

sendEmail($pdf,$enquirydata);

//Creamos una funcion para enviar el email

function sendEmail($pdf,$enquirydata){

//CREAMOS EL CUERPO DEL CORREO

$cuerpocorreo='<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>holi</title>
</head>
<body style="background-color: white; ">

<!--Copia desde aquí-->
<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<tr style="background-color: #147992">
		<td style="background-color: #ecf0f1; text-align: left; padding: 0">
			<a href='.$enquirydata['link'].' style="display: flex; justify-content: center;">
				<img width="20%" style="display:block; margin: 1.5% 3%" src="cid:logo_empresa">
			</a>
		</td>
	</tr>
	
	<tr>
		<td style="background-color: #ecf0f1">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #3498DB; margin: 0 0 7px">Hola '.$enquirydata['nombre'].'!</h2>
				<p style="margin: 2px; font-size: 15px">
            '.$enquirydata['cuerpo'].'
          <br></p><br>				
				<div style="width: 100%; text-align: center">
					<a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href='.$enquirydata['link'].'>'.$enquirydata['texto'].'</a>	
				</div>
				<p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">'.$enquirydata['razon_social'].' '.date("Y").'</p>
			</div>
		</td>
	</tr>
</table>
<!--hasta aquí-->

</body>
</html>';






  $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'rokibalton99@gmail.com';                     // SMTP username
    $mail->Password   = 'pietrogato';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above    

    //Recipients
    $mail->setFrom('torricopietro@gmail.com', $enquirydata['razon_social']);
    $mail->addAddress($enquirydata['correo'], $enquirydata['nombre'].' '.$enquirydata['apellido']);     // Add a recipient 
   
    //attachment
    $mail->addStringAttachment($pdf,'COMPROBANTE DE INSCRIPCION.pdf');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $enquirydata['asunto'];
    $mail->Body    = $cuerpocorreo;
    $mail->AltBody = $enquirydata['alt'];
    $mail->AddEmbeddedImage('imagenes-sistema/logo.png', 'logo_empresa');

    $mail->send();
    header('Location:crear-pdf-get.php?id_membresia='.$enquirydata['id_membresia']);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}