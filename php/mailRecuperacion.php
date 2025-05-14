<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if($_SERVER['REQUEST_METHOD']=='POST'){
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/Exception.php';
    require_once("conexionok.php");
    $email=$_POST['email'];
    $sql="SELECT id FROM usuarios WHERE email='$email';";
    $result=$con->query($sql);
    if($result->num_rows>0){
        $token = bin2hex(random_bytes(16));
        $sql="UPDATE usuarios SET token='$token' WHERE email='$email'";
        $result=$con->query($sql);
        if($result===FALSE){
            echo "<div class='errores'><div>Error en el proceso de recuperación de contraseña</div></div>";
        }  else {

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
                $mail->addAddress($email, 'Usuario');
                // Contenido del correo
                $mail->isHTML(true);
                $mail->Subject = 'Recuperación de contraseña';
                $mail->CharSet = 'UTF-8';
                $mail->Body = '<div>Si has olvidado tu contraseña clica el siguiente link para poder cambiar a una nueva. 
                    Si no estás intentando cambiar de contraseña puedes ignorar este correo</div><br>
                    <a href="http://127.0.0.1:8000/php/updatePass.php?token='.$token.'">Recuperar contraseña</a>';
                $mail->AltBody = 'Tu email no es compatible con nuestro sistema de recuperaciíón de contraseña, por favor usa un 
                    sistema de correo compatible con HTML';
                $mail->addEmbeddedImage('img/logofastconnect.jpg', 'logo');
                $mail->send();
                echo 'El mensaje ha sido enviado';
            } catch (Exception $e) {
                echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    } else {
        echo "<div class='errores'><div>El email no existe, por favor introduce un email de un usuario existente</div></div>";
    }
    $con->close();
}
?>
