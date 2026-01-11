<?php
$errores=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    //VALIDACION USUARIO
    if(empty($_POST['usuario'])){
        $errores[]="El campo usuario es obligatorio";
    } else {
        $usuario=trim($_POST['usuario']);
        if(strlen($usuario)<3) {
            $errores[]="El usuario debe tener al menos 3 caracteres";
        }
    }

    //VALIDACION CONTRASEÑA
    if(empty($_POST['contraseña'])){
        $errores[]="El campo contraseña es obligatorio";
    } else {
        $password=trim($_POST['contraseña']);
        if(strlen($password)<6){
            $errores[]="La contraseña debe tener al menos 6 caracteres";
        }
        if(!preg_match('/[A-Z]/',$password) || !preg_match('/[0-9]/',$password) || !preg_match('/[a-z]/',$password)){
            $errores[]="La contraseña debe incluir almenos una minúscula, una mayúscula y un número";
        }
    }

    //VALIDACION EMAIL
    if(empty($_POST['email'])){
        $errores[]="Debes introducir un correo";
    } else {
        $email=trim($_POST['email']);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errores[]="El correo debe tener formato correcto (xxxxx@xxxxx.xx)";
        }
    }

    //SERVICIOS
    if(isset($_POST['hobby'])){
        $hobby=$_POST['hobby'];
        $hobbyJson=json_encode($hobby);
    } else {
        $hobby=['NS-NC'];
        $hobbyJson=json_encode($hobby);
    }

    //SEXO
    if(isset($_POST['sexos'])){
        $sexo=$_POST['sexos'];
    } else {
        $errores[]="Es obligatorio completar el campo sexo";
    }

    //VALIDACION TERMINOS
    if(isset($_POST['suscribir'])){
        $suscrito=true;
    } else {
        $errores[]="Debes aceptar los términos y condiciones";
    }

    //RECOPILACION DE ERRORES Y ENVIO A BASE DE DATOS
    /*JAVIER, SEGÚN COMENTADO, UNA VEZ HECHO EL REGISTRO SE
    REDIRIGE AUTOMATICAMENTE A LA PÁGINA DE LOGIN */
    echo "<div class='errores'>";
    if (empty($errores)) {
    require_once("conexionok.php");
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    // antes de insert, comprobar si existe email
    $sqlCheck = "SELECT email FROM usuarios WHERE email=?";
    $stmtCheck = $con->prepare($sqlCheck); 
    $stmtCheck->bind_param('s', $email); 
    $stmtCheck->execute();
    $resultado = $stmtCheck->get_result();

    if ($resultado->num_rows > 0) {
        // update para introducir datos nuevos si coincide el email
        $sql = "UPDATE usuarios 
                SET usuario=?, pass=?, email=?, hobby=?, sexos=? 
                WHERE email=?";
        $stmtUpdate = $con->prepare($sql); 
        $stmtUpdate->bind_param('ssssss', $usuario, $passwordHash, $email, $hobbyJson, $sexo, $email);
        
        if ($stmtUpdate->execute()) {
            echo "<div class='error'>El email $email ya existe en la base de datos, 
                  se ha actualizado la nueva información proporcionada en el formulario</div>
                  <div class='error'>Redirigiendo a página de login en <span id='countdown'>6</span></div>";
            echo "<script type='text/javascript'>
                    let countdown = 6;
                    let countdownElement = document.getElementById('countdown');
                    let interval = setInterval(function() {
                        countdown--;
                        countdownElement.innerText = countdown; 
                        if (countdown <= 0) {
                            clearInterval(interval); 
                            setTimeout(function() {
                                window.location.href = 'login.php';
                            }, 1000); 
                        }
                    }, 1000);
                  </script>";
        } else {
            echo "<div class='error'>Error insertando datos: " . $stmtUpdate->error . "</div>";
        }
        $stmtUpdate->close();
    } else {
        // insertar
        $sql="INSERT INTO usuarios (id, usuario, pass, email, hobby, sexos, suscribir)
                VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $stmtInsert=$con->prepare($sql);
        $stmtInsert->bind_param('ssssss', $usuario, $passwordHash, $email, $hobbyJson, $sexo, $suscrito);

        if ($stmtInsert->execute()) {
            echo "<div class='error'>Bienvenid@, $usuario!! Te has registrado correctamente.</div>
                  <div class='error'>Redirigiendo a página de login en <span id='countdown'>3</span></div>";
            echo "<script type='text/javascript'>
                    let countdown = 3;
                    let countdownElement = document.getElementById('countdown');
                    let interval = setInterval(function() {
                        countdown--;
                        countdownElement.innerText = countdown; 
                        if (countdown <= 0) {
                            clearInterval(interval); 
                            setTimeout(function() {
                                window.location.href = 'login.php';
                            }, 1000); 
                        }
                    }, 1000);
                  </script>";
        } else {
            echo "<div class='error'>Error insertando datos: " . $stmtInsert->error . "</div>";
        }
        $stmtInsert->close();
    }
    $stmtCheck->close();
    $con->close();
} else {
    echo "Revisa los siguientes campos:";
    foreach ($errores as $error) {
        echo "<div class='error'>$error</div>";
    }
}
    echo "</div>";
} //fin if global
?>
