<?php


require_once("conexionok.php");
$sqlOpiniones = "SELECT opiniones.valoracion, opiniones.comentario, opiniones.fecha, usuarios.usuario 
FROM opiniones 
JOIN usuarios ON opiniones.id_usuario = usuarios.id
ORDER BY opiniones.fecha DESC";

$stmt = $con->prepare($sqlOpiniones);

if ($stmt) {
    $stmt->execute();
    $resultado=$stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($fila=$resultado->fetch_assoc()) {
            $puntuacion=$fila['valoracion'];
            $comentario=$fila['comentario'];
            $date=$fila['fecha'];
            $user=$fila['usuario'];
            echo "<div class='cajaOpinion'>
                    <div class='user__valoracion'>
                        <h3>$user</h3>
                        <div class='puntuacion'>";
            for ($i=1; $i<=5; $i++) {
                if ($i<=$puntuacion) {
                    echo "<img src='img/estrellaAmarilla.png' class='estrellaDos'>";
                } else {
                    echo "<img src='img/estrellaGris.png' class='estrellaDos'>";
                }
            }
            echo       "</div>
                    </div>
                    <div class='fecha'>$date</div>
                    <div class='opinion'>$comentario</div>
                </div>";
        }
    } else {
        echo "<h3>Todavía no hay comentarios ¡Déjanos uno!";
    }
    $stmt->close();
} else {
    echo "<div class='error'>Error preparando la consulta: " . $con->error . "</div>";
}

/*
require_once("conexionok.php");


if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

$sqlOpiniones = "SELECT opiniones.valoracion, opiniones.comentario, opiniones.fecha, usuarios.usuario 
FROM opiniones 
JOIN usuarios ON opiniones.id_usuario=usuarios.id
ORDER BY opiniones.fecha DESC";

$resultado = $con->query($sqlOpiniones);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $puntuacion = $fila['valoracion'];
        $comentario = $fila['comentario'];
        $date = $fila['fecha'];
        $user = $fila['usuario'];
        echo "<div class='cajaOpinion'>
                    <div class='user__valoracion'>
                        <h3>$user</h3>
                        <div class='puntuacion'>";
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $puntuacion) {
                                echo "<img src='img/estrellaAmarilla.png' class='estrellaDos'>";
                            } else {
                                echo "<img src='img/estrellaGris.png' class='estrellaDos'>";
                            }
                        }
        echo            "</div>
                    </div>
                    <div class='fecha'>$date</div>
                    <div class='opinion'>$comentario</div>
              </div>";
    }
} else {
    echo "<h3>Todavía no hay comentarios. ¡Déjanos uno!</h3>";
}
*/



?>