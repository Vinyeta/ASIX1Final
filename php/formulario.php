<?php
session_start();

require_once("header.php");
require_once("conexionok.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/registro_login.css"/> 
</head>
<body>


<div class="contacta">Formulario de registro</div>
<form method="post" action="formulario.php">
<section class="cajaFlex">
    <fieldset class="ventana">
    <legend class="leyenda">Datos de registro</legend>
    <section class="datos">
        <div class="names">
            <div class="name">
                <label for="nombre">Usuario: </label>
            </div>
            <div class="name1">
                <input class="inputName" type="text" size="30" title="Usuario" name="usuario" autofocus placeholder="Nombre de usuario"/>
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
        <div class="emails">
        <div class="email">
            <label for="mail">E-mail: </label>
        </div>
        <div>
            <input class="inputEmail" type="text" size="30" title="E-mail" name="email" autofocus placeholder="Escribe tu e-mail"/>
        </div>
        </div>
    </section>  
    </fieldset>
    
    <section class="sersex">
    <div class="servicios">Servicios:
        <div>
        <label for="web">
            <input id="web"type="checkbox" name="hobby[]" value="Web"/>Web
        </label>
        </div>
        <div>
            <label for="redes">
                <input id="redes"type="checkbox" name="hobby[]" value="Redes"/>Redes
            </label>
        </div>
        <div>
            <label for="sistemas">
            <input id="sistemas"type="checkbox" name="hobby[]" value="Sistemas"/>Sistemas
            </label>
        </div>
    </div>
        <div class="cajaSexo">
            <label for="sexos">Sexo:
            <div>
                <input id="sexo1" name="sexos"type="radio" value="Mujer">
                <label for="sexo1">
                <span class="mujer"></span>
                <span>Mujer</span></label>
            </div>
            <div>
                <input id="sexo2" name="sexos"type="radio" value="Hombre">
                <label for="sexo2">
                <span class="hombre"></span>
                <span>Hombre</span></label>
            </div>
            <div>
                <input id="sexo3" name="sexos"type="radio" value="NS-NC">
                <label for="sexo3">
                <span class="nsnc"></span>
                <span>NS/NC</span></label>
            </div>
            </label>
        </div>
    </section>
    <div class="subscribe">
        <label for="suscribir">Acepto los términos y condiciones</label>
        <input type="checkbox" id="suscrito" name="suscribir" value="acepto"/>
    </div> 
    <div class="submit">
        <input class="botonEnviar" type="submit" value="ENVIAR">
    </div> 
    <?php
        require_once("datosok.php");
    ?>  
</section>
</form>      

<script src="js/javascript.js"></script>  
</body>
</html>