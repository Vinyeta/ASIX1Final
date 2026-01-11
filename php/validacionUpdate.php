<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //VALIDACION USUARIO
    if(empty($_POST['usuario'])){
        $errores[]="El campo usuario es obligatorio";
    } else {
        $nombre=htmlspecialchars($_POST['usuario']);
        if(strlen($nombre)<3) {
            $errores[]="El usuario debe tener al menos 3 caracteres";
        }
    }
    //VALIDACION CONTRASEÑA
    if(empty($_POST['contraseña'])){
        $errores[]="El campo contraseña es obligatorio";
    } else {
        $passwd=trim($_POST['contraseña']);
        if(strlen($passwd)<6){
            $errores[]="La contraseña debe tener al menos 6 caracteres";
        }
        if(!preg_match('/[A-Z]/',$passwd) || !preg_match('/[0-9]/',$passwd) || !preg_match('/[a-z]/',$passwd)){
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
        $sexo="NS-NC";
    }

    //ACTUALIZACION DE DATOS
    echo "<div class='errores'>";
    if (empty($errores)) {
    require_once("conexionok.php");
    $id = $_POST['id'];
    $passwdHash = password_hash($passwd, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios 
            SET usuario=?, pass=?, email=?, sexos=?, hobby=? 
            WHERE id=?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('sssssi', $nombre, $passwdHash, $email, $sexo, $hobbyJson, $id);

        if ($stmt->execute()) {
            echo "<div class='error'>¡Se han modificado los datos!</div>
                  <div class='error'>Redirigiendo a página de usuarios en <span id='countdown'>3</span></div>
                  <script type='text/javascript'>
                      let countdown = 3;
                      let countdownElement = document.getElementById('countdown');
                      let interval = setInterval(function() {
                          countdown--;
                          countdownElement.innerText = countdown; 
                          if (countdown <= 0) {
                              clearInterval(interval); 
                              setTimeout(function() {
                                  window.location.href = 'baseDatos.php';
                              }, 1000); 
                          }
                      }, 1000);
                    </script>";
        } else {
            echo "<div class='error'>Error modificando datos: " . $con->error . "</div>";
        }
        $stmt->close();
    } else {
        echo "<div class='error'>Error al preparar la consulta SQL: " . $con->error . "</div>";
    }
    $con->close();
} else {
    echo "Revisa los siguientes campos:";
    foreach ($errores as $error) {
        echo "<div class='error'>$error</div>";
    }
}

    echo "</div>";
}  

?> 

