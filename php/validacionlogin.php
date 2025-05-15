<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuarios']) && isset($_POST['contraseña'])) {
    require_once("conexionok.php");
    $user = $_POST['usuarios'];
    $password = $_POST['contraseña'];

    $sql = "SELECT id, usuario, pass FROM usuarios WHERE usuario = ?";

    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();

            if (password_verify($password, $fila['pass'])) {
                $_SESSION['id'] = $fila['id'];
                $_SESSION['usuario'] = $fila['usuario'];

                setcookie("usuario", $fila['usuario'], time() + (86400 * 3), "/");
                setcookie("contraseña", $fila['pass'], time() + (86400 * 3), "/");

                echo "<div class='errores'>
                        <div>¡SESIÓN INICIADA! REDIRIGIENDO EN <span id='countdown'>3</span></div>
                      </div>";

                echo "<script type='text/javascript'>
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
                echo "<div class='errores'><div>Usuario o contraseña incorrectos</div></div>";
            }
        } else {
            echo "<div class='errores'><div>Usuario o contraseña incorrectos</div></div>";
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }
    $con->close();
}
?>


