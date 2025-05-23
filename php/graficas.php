<?php
    session_start();
    session_start();
    if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }
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
        <div class='botones'>
            <button class="boton" id="btnProductos">Ranking</button>
            <button class="boton" id="btnCategorias">Categorias</button>
        </div>
        <div class="canvas">
            <canvas class="miGrafica"></canvas>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/jsenlaces.js"></script>
<script src="js/grafica.js"></script>
</html>
