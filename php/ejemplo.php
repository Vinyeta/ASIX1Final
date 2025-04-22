<?php
// Esta ruta es relativa, desde tu carpeta de proyecto
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';
/*Aunque no tengas la carpeta PHPMailer la ruta no cambia, ya que dentro de los ficheros internos
de PHPMailer figura dicha ruta*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
try {
// Configuración del servidor
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'fastconnect43@gmail.com';
$mail->Password = 'bhxp bxmn lylx kotj';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
// Opciones de SSL
$mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);
// Remitente y destinatario
$mail->setFrom('fastconnetc@gmail.com', 'Fast Connect');
$mail->addAddress('avinetam@gmail.com', 'Alejo');
// Contenido del correo
$mail->isHTML(true);
$mail->Subject = 'Escribe el título del mensaje';
$mail->Body = '<h1>Atención</h1>Este es el <b style="color:red">cuerpo</b> del
correo en HTML<div>acepta html y css con style</div>';
$mail->AltBody = 'Este es el cuerpo del correo en texto plano para clientes que no
soportan HTML';
$mail->send();
echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}
?>