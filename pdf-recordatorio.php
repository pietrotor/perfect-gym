<?php
//INICIO CREACION PDF

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/vendor/autoload.php';


//GRAB ENQURY DATA
$enquirydata=[
  'nombre'=>$return_final['nombre'],
  'apellido'=>$return_final['apellido'],
  'correo'=>$return_final['correo'],
  'id_membresia'=>$return_final['id_membresia'],
  'sesiones'=>$return_final['sesion'],  
  'inicio'=>$return_final['inicio'],  
  'fin'=>$return_final['fin']
];

//LLAMAMOS A LA FUNCION ENVIAR EMAIL

sendEmail($enquirydata);

//Creamos una funcion para enviar el email

function sendEmail($enquirydata){

//CREAMOS EL CUERPO DEL CORREO
$bodycorreo='';
$asunto='';
if($enquirydata['sesiones'] == 3){
    $asunto='Recordatorio de Renovacion';
    $bodycorreo='Te queremos recordar que solo te quedan '.$enquirydata['sesiones'].' antes que concluya tu membresia el '.$enquirydata['fin'].', por 
    ello te aconsejamos que renueves tu membresia lo antes posible para evitar pasar malos ratos.<br><br>
    Sin ningun otro asunto nos despedimos y te desamos un lindo día.<br></p><br>';
}else{
    $asunto='Renovacion de Membresia';
    $bodycorreo='Lamentablemente tu membresia a concluido, muuchas gracias por la confiza que deposistaste en nostros durante este tiempo.<br><br>
                 Esperamos que renueves tu membresia lo más pronto posible, para ello puedes pasar por nuestras instalaciones para realizar tu pago y 
                 seguir haciendo lo que más te gusta.<br><br>
                 Sin ningun otro asunto nos despedimos y te desamos un lindo día.<br></p><br>'; 
}

$cuerpocorreo='<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>holi</title>
</head>
<body style="background-color: black ">

<!--Copia desde aquí-->
<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<tr>
		<td style="background-color: #ecf0f1; text-align: left; padding: 0">
			<a href="https://www.facebook.com/PokemonTrujillo/">
				<img width="20%" style="display:block; margin: 1.5% 3%" src="https://assets.website-files.com/5e39634c9e322569a23b267b/5e6265e15e2b260e4ce57bc8_fitco.png">
			</a>
		</td>
	</tr>
	
	<tr>
		<td style="background-color: #ecf0f1">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px">Hola '.$enquirydata['nombre'].'</h2>
				<p style="margin: 2px; font-size: 15px">
					'.$bodycorreo.'				
				<div style="width: 100%; text-align: center">
					<a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href="https://www.facebook.com/fitco.community/">Visita nuestra pagina de Facebook</a>	
				</div>
				<p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">FITCO 2021</p>
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
    $mail->setFrom('torricopietro@gmail.com', 'Fitco');
    $mail->addAddress($enquirydata['correo'], $enquirydata['nombre'].' '.$enquirydata['apellido']);     // Add a recipient    
    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpocorreo;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    //header('Location:crear-pdf-get.php?id_membresia='.$enquirydata['id_membresia']);
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}