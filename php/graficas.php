<?php
    session_start();
    require_once("header.php");
    require_once("conexionok.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto más vendido</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/grafica.css"/>
</head>
<body>
    <div class="container">
        <canvas class="miGrafica"></canvas>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/grafica.js"></script>
</html>