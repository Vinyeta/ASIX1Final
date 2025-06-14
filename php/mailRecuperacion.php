<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/Exception.php';
    require_once("conexionok.php");
    $email = $_POST['email'];
    if(empty($_POST['email'])){
        $error="Debes introducir un correo";
    } else {
        $email=trim($_POST['email']);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $error="El correo debe tener formato correcto (xxxxx@xxxxx.xx)";
        }
    }
    if(isset($error)){
        echo "<div class='errores'><div>$error</div></div>";
    } else {
        $sql = $con->prepare("SELECT id FROM usuarios WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            $token = bin2hex(random_bytes(16));
            $tokenCreatedAt = date('Y-m-d H:i:s');
            $update_sql = $con->prepare("UPDATE usuarios SET token = ?, token_creacion = ? WHERE email = ?");
            $update_sql->bind_param("sss", $token, $tokenCreatedAt, $email);
            if ($update_sql->execute() === FALSE) {
                echo "<div class='errores'><div>Error en el proceso de recuperación de contraseña</div></div>";
            } else {

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
                    $mail->Body = '<div>Si has olvidado tu contraseña clica en el link de abajo para poder actualizarla.</div> 
                        <div>Este enlace <b>solo será válido durante 1 hora.</b></div>
                        <div>Si no estás intentando cambiar de contraseña puedes ignorar este correo</div><br>
                        <a href="https://localhost/ASIX1Final/php/updatePass.php?token=' . $token . '">Recuperar contraseña</a>';
                    $mail->AltBody = '';
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
    }
    $con->close();
}
?>
