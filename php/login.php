<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/registro_login.css"/>
    <?php
    require_once("header.php");
    ?>
</head>
<body>


<div class="contacta">Inicio de sesión</div>



<form method="post" action="login.php">
<section class="cajaFlex">
</div>
    <fieldset class="ventana">
    <legend class="leyenda">Datos de acceso</legend>
    <section class="datos">
        <div class="names">
            <div class="name">
                <label for="nombre">Usuario: </label>
            </div>
            <div class="name1">
                <input class="inputName" type="text" size="30" title="Usuario" name="usuarios" autofocus placeholder="Nombre de usuario"/>
            </div>
        </div>
    <div class="cajaPassword">
        <div class="passwords">
            <label class="key" for="password">Contraseña:</label>
        </div>
        <div class="inputKey">
            <img class="ojoAbierto" src="img/eyeOpen.svg"/>
            <input class="pasword"type="password" patter=".{8,}" id="password" size="30" title="Contraseña" name="contraseña" autofocus placeholder="Contraseña">     
        </div>
    </div>
    </section>  
    </fieldset> 
    <div class="submit">
        <input class="botonEnviar" type="submit" value="LOGIN">
    </div>
    <?php
    require_once ("validacionlogin.php");
    ?>
</section>
</form> 
<script src="js/javascript.js"></script>
    
</body>
</html>