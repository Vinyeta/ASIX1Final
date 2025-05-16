<?php
    require_once('conexionok.php');

    $sql = "SELECT categoria, SUM(ventas_count) AS total_ventas 
        FROM ranking 
        GROUP BY categoria 
        ORDER BY total_ventas DESC 
        LIMIT ?";
    $stmt = $con->prepare($sql);

    // Límite de productos a mostrar
    $limit = 10;
    $stmt->bind_param("i", $limit);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();
    while ($fila = $result->fetch_assoc()) {
        $categorias[] = $fila;
    }
    echo  json_encode($categorias);
?>