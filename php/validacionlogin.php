<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuarios']) && isset($_POST['contraseña'])){
    require_once("conexionok.php");
    $user=$_POST['usuarios'];
    $contraseña=$_POST['contraseña'];
    $sql="SELECT id,usuario,pass FROM usuarios WHERE usuario='$user'
          AND pass='$contraseña'";
    $result=$con->query($sql);
    if($result->num_rows>0){
        while($fila=$result->fetch_assoc()){
            $_SESSION['id']=$fila['id'];
            $_SESSION['usuario']=$fila['usuario'];
            $_SESSION['contraseña']=$fila['pass'];
        }
        echo "<div class='errores'>
            <div>¡SESIÓN INICIADA! REDIRIGIENDO EN <span id='countdown'>3</span></div>
            </div>";
        /*haciendo sleep(2) y header location no se muestra
        el mensaje de arriba, asi que lo he hecho con javascript, y 
        ya que estaba con un contador*/
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
        echo "<div class='errores'><div>Usuario o contraseña incorrectos</div>
        </div>";
    }
    $con->close();
}
?>
