<?php
$errores=[];

if($_SERVER['REQUEST_METHOD']=='POST'){
    //VALIDACION USUARIO
    if(empty($_POST['usuario'])){
        $errores[]="El campo usuario es obligatorio";
    } else {
        $usuario=htmlspecialchars($_POST['usuario']);
        if(strlen($usuario)<3) {
            $errores[]="El usuario debe tener al menos 3 caracteres";
        }
    }

    //VALIDACION CONTRASEÑA
    if(empty($_POST['contraseña'])){
        $errores[]="El campo contraseña es obligatorio";
    } else {
        $password=htmlspecialchars(trim($_POST['contraseña']));
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
        $sexo="NS-NC";
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
        //antes de insert, comprobar si existe email
        $sqlCheck = "SELECT email FROM usuarios WHERE email='$email'";
        $resultado = $con->query($sqlCheck);
        if ($resultado->num_rows>0){
            //update para introducir datos nuevos si coincide email
            $sql= "UPDATE usuarios SET usuario='$usuario', pass='$password', 
            email='$email', hobby='$hobbyJson', sexos='$sexo' WHERE email='$email'";
            if($con->query($sql) === TRUE){
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
                echo "<div class='error'>Error insertando datos: " . $con->error . "</div>
                      <div class='error'>$sql</div>";
            }
        } else {
            //insertar
            $sql = "INSERT INTO `usuarios`(`id`,`usuario`,`pass`,`email`,`hobby`,`sexos`,`suscribir`)
                    VALUES (NULL, '$usuario', '$password', '$email', '$hobbyJson', '$sexo', '$suscrito')";
            if ($con->query($sql) === TRUE){ //insert ok
                echo "<div class='error'>Bienvenid@, $usuario!! Te has registrado correctamente.</div>
                      <div class='error'>Redirigiendo a página de login en <span id='countdown'>3</span></div>";
                //cuenta atras con javascript (fte: Manual de HTML,CSS y JavaScript):
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
            } else { //insert no ok
                echo "<div class='error'>Error insertando datos: " . $con->error . "</div>
                      <div class='error'>$sql</div>";
            }
        }
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
