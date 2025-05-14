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


<div class="contacta">Cambio de contraseña</div>



<form method="post" action="updatePass.php">
<section class="cajaFlex">
</div>
    <fieldset class="ventana">
    <legend class="leyenda">Datos de acceso</legend>
    <section class="datos">
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
        <input class="botonEnviar" type="submit" value="Enviar">
    </div>
    <?php
    require_once ("updatePassValidation.php");
    ?>
</section>
</form> 
<script src="js/javascript.js"></script>
    
</body>
</html>