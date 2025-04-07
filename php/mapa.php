<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}
require_once("header.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/estilosMapa.css"/>
</head>
<body>
    <div class="espacio"></div>
    <div class="velo"></div>
    <div class="mapa">
        <img title="Madrid" class="chin" id="chin1" src="img/supermario.gif">
        <img title="Nueva York" class="chin" id="chin2" src="img/supermario.gif">
        <img title="Rio de Janeiro" class="chin" id="chin3" src="img/supermario.gif">
        <img title="Tokyo" class="chin" id="chin4" src="img/supermario.gif">
        <img title="Sidney" class="chin" id="chin5" src="img/supermario.gif">
        <div class="panel"><p class="texto">HAZ CLICK EN LOS MARIOS PARA VER NUESTRAS SUCURSALES</p></div>
        
        <fieldset class="box">
            <img title="Anterior" class="flecha" id="izq" src="img/flechaIzq.png">
            <img title="Siguiente" class="flecha" id="der" src="img/flechaDer.png">
            <div><img title="Cerrar" class="cerrar" src="img/closebutton.webp" ></div>
            <div class="h1"><h1></h1></div>
            <div class="imagen"></div>
            <div class="adress"></div>
            <div class="contact">
                <div class="mail"></div>
                <div class="tel"></div>
            </div>
        </fieldset>
    </div>
    <div class="cajaCiudades">
        
    </div>
        
    
<script src="js/jsenlaces.js"></script>
<script src="js/jsmapa.js"></script>
</body>
</html>