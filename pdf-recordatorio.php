<?php
//INICIO CREACION PDF

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/vendor/autoload.php';


//GRAB ENQURY DATA
$enquirydata=[
  'razon_social'=>$return_final['razon_social'],
  'link'=>$return_final['link_inscripcion_email'],
  'nombre'=>$return_final['nombre'],
  'apellido'=>$return_final['apellido'],
  'correo'=>$return_final['correo'],
  'id_membresia'=>$return_final['id_membresia'],
  'sesiones'=>$return_final['sesion'],  
  'inicio'=>$return_final['inicio'],  
  'fin'=>$return_final['fin'],
  'asunto_recordatorio'=>$return_final['asunto_recordatorio_email'],
  'cuerpo_recordatorio'=>$return_final['cuerpo_recordatorio_email'],
  'alt_recordatorio'=>$return_final['alt_recordatorio_email'],
  'sesiones_recordatorio'=>$return_final['sesiones_recordatorio_email'],
  'asunto_vencimiento'=>$return_final['asunto_vencimiento_email'],
  'cuerpo_vencimiento'=>$return_final['cuerpo_vencimiento_email'],
  'alt_vencimiento'=>$return_final['alt_vencimiento_email']
];

//LLAMAMOS A LA FUNCION ENVIAR EMAIL

sendEmail($enquirydata);

//Creamos una funcion para enviar el email

function sendEmail($enquirydata){

//CREAMOS EL CUERPO DEL CORREO
$bodycorreo='';
$asunto='';
if($enquirydata['sesiones'] == $enquirydata['sesiones_recordatorio']){
    $asunto = $enquirydata['asunto_recordatorio'];
    $bodycorreo='Te queremos recordar que solo te quedan '.$enquirydata['sesiones'].' antes que concluya tu membresia el '.$enquirydata['fin'].', por 
    ello te aconsejamos que renueves tu membresia lo antes posible para evitar pasar malos ratos.<br><br>
    Sin ningun otro asunto nos despedimos y te desamos un lindo día.<br></p><br>';
    $bodycorreo = $enquirydata['cuerpo_recordatorio'];
}else{
    $asunto = $enquirydata['asunto_vencimiento'];
    $bodycorreo = $enquirydata['cuerpo_vencimiento']; 
}

$cuerpocorreo='<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>holi</title>
</head>
<body style="background-color: transparent ">

<!--Copia desde aquí-->
<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<tr>
		<td style="background-color: #ecf0f1; text-align: left; padding: 0">
			<a href='.$enquirydata['link'].' style="display: flex;justify-content: center;">
                <img width="20%" style="display:block; margin: 0 auto;" src="cid:logo_empresa">
			</a>
		</td>
	</tr>
	
	<tr>
		<td style="background-color: #ecf0f1">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px">Hola '.$enquirydata['nombre'].'</h2>
				<p style="margin: 2px; font-size: 15px">
					'.$bodycorreo.'				
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
    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpocorreo;
    $mail->AltBody = $enquirydata['sesiones'] == $enquirydata['sesiones_recordatorio'] ? $enquirydata['alt_recordatorio'] : $enquirydata['alt_vencimiento'];
    $mail->AddEmbeddedImage('../imagenes-sistema/logo.png', 'logo_empresa');
    $mail->send();
    //header('Location:crear-pdf-get.php?id_membresia='.$enquirydata['id_membresia']);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}