<?php
    require_once('conexionok.php');

    $sql = "SELECT * FROM ranking ORDER BY ventas_count DESC LIMIT ?";
    $stmt = $con->prepare($sql);

    // Límite de productos a mostrar
    $limit = 10;
    $stmt->bind_param("i", $limit);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();
    while ($fila = $result->fetch_assoc()) {
        $productos[] = $fila;
    }
    echo  json_encode($productos);
?>