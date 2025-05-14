<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Pass</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/registro_login.css"/>
    <?php
    require_once("header.php");
    require_once("conexionok.php");
    ?>
</head>
<body>

<div class="contacta">Recuperar Contraseña</div>

<form method="post" action="recuperarPass.php" >
<section class="cajaFlex" id="formulario">
</div>
    <section class="datos" >
        <div class="names" id="datos">
            <div class="name">
                <label for="nombre">Tu e-mail: </label>
            </div>
            <div class="name1">
                <input required class="inputName" type="email" size="30" title="Email" name="email" autofocus placeholder="Email"/>
            </div>
        </div>
    </section>  
    <div class="submit">
        <input class="botonEnviar" type="submit" value="Enviar">
    </div>
    <?php
        require_once("recuperarPass.php");
    ?>  
</form> 
<script src="js/javascript.js"></script>
    
</body>
</html>