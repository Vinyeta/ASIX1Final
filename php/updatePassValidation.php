<?php
$errores = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        $errores = true;
        echo "<div class='errores'><div>Ha habido un error en el proceso de cambio de contraseña, por favor vuelva a inicarlo</div></div>";
    }
    if (empty($_POST['contraseña'])) {
        $errores = true;
        echo "<div class='errores'><div>El campo contraseña es obligatorio</div></div>";
    } else {
        $password = trim($_POST['contraseña']);
        if (strlen($password) < 6) {
            $errores = true;
            echo "<div class='errores'><div>La contraseña debe tener al menos 6 caracteres</div></div>";
        }
        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[a-z]/', $password)) {
            $errores = true;
            echo "<div class='errores'><div>La contraseña debe incluir almenos una minúscula, una mayúscula y un número</div></div>";
        }
        if (strtotime($_POST['token_creacion']) <= strtotime('-1 hour')) {
            $errores = true;
            echo "<div class='errores'><div>El token ha caducado, por favor vuelve a solicitar el cambio de contraseña</div></div>";
        }
        if (!$errores) {
            $id = htmlspecialchars(trim($_POST['id']));
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = $con->prepare("UPDATE usuarios SET pass=?, token='' WHERE id=?");
            $sql->bind_param("si", $passwordHash, $id);
            if (!$sql->execute()) {
                echo "<div class='errores'><div>Error al actualizar la contraseña</div></div>";
            } else {
                echo "<div class='error'><div>Contraseña actualizada correctamente, redirigiendo a la página de inicio de sesión en 
                      <span id='countdown'>3</span> segundos...</div></div>";
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
            }
        }
    }
}
?>

