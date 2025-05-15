<?php

require_once('conexionok.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario=$_POST['id_usuario'];
    if(empty($_POST['estrellas']) || (empty($_POST['comentario']))){
        $error="Debes marcar almenos una estrella e introducir un comentario";
    } else {
        $valoracion=(int)$_POST['estrellas'];
        $comentario=$_POST['comentario'];
    } 
    if (empty($error)){
        $sql = "INSERT INTO opiniones (id_usuario, valoracion, comentario) 
            VALUES (?, ?, ?)";

if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("iis", $id_usuario, $valoracion, $comentario); 

    if ($stmt->execute()) {
        echo "<div>¡Gracias por tu comentario!</div>
              <script>
                  window.onload = function() {
                      document.getElementById('marcador').scrollIntoView();
                  }
              </script>";
    } else {
        echo "Error insertando datos: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error preparando la sentencia: " . $con->error;
}
} else {
echo "<div class='mensaje'>$error</div>";
echo "<script>
        window.onload = function() {
            document.getElementById('marcador').scrollIntoView();
        }
      </script>";
}
}

?>