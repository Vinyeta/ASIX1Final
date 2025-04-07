<?php

require_once('conexionok.php'); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario=$_POST['id_usuario'];
    if(empty($_POST['estrellas']) || (empty($_POST['comentario']))){
        $error="Debes marcar almenos una estrella e introducir un comentario";
    } else {
        $valoracion=$_POST['estrellas'];
        $valoracion=(int)$valoracion;
        $comentario=$_POST['comentario'];
    } 
    if (empty($error)){
        $sql = "INSERT INTO opiniones (id_usuario, valoracion, comentario) 
            VALUES ('$id_usuario', '$valoracion', '$comentario')";

        if ($con->query($sql) === TRUE) {
            echo "<div>¡Gracias por tu comentario!</div>
                    <script>
                        window.onload = function() {
             document.getElementById('marcador').scrollIntoView();
         }
                    </script>";
        } else {
            echo "Error insertando datos: " . $con->error;
        }
    } else {
        echo "<div class='mensaje'>$error</div>";
        echo    "<script>
                    window.onload = function() {
             document.getElementById('marcador').scrollIntoView();
         }
                </script>";
    }
}

?>