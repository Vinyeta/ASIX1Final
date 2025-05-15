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
    <title>Modificar datos</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/registro_login.css"/> 
</head>
<body>
<?php
require_once("conexionok.php");
if (isset($_GET['id'])) {
    $_SESSION['idModify']=$_GET['id'];  
    $idGet=$_SESSION['idModify'];  

    $sql="SELECT * FROM usuarios WHERE id=?";
    if ($stmt=$con->prepare($sql)) {
        $stmt->bind_param('i', $idGet);
        $stmt->execute();
        $resultado=$stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $name=$fila['usuario'];
                $pswd=$fila['pass'];
                $mail=$fila['email'];
                $service=json_decode($fila['hobby']);
                $sex=$fila['sexos'];
            }
        } else {
            echo "<div class='error'>No se encontró el usuario</div>";
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }
} else {
    $idGet=$_SESSION['idModify'];
    $sql="SELECT * FROM usuarios WHERE id=?";

    if($stmt=$con->prepare($sql)) {
        $stmt->bind_param('i', $idGet);
        $stmt->execute();
        $resultado=$stmt->get_result();
        
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $name=$fila['usuario'];
                $pswd=$fila['pass'];
                $mail=$fila['email'];
                $service=json_decode($fila['hobby']);
                $sex=$fila['sexos'];
            }
        } else {
            echo "<div class='error'>No se encontró el usuario</div>";
        }
        $stmt->close();
    } else {
        echo "Error al preparar la consulta.";
    }
}
?>
<div class="contacta">Modifica tus datos</div>
<form method="post" action="modificar.php">
<section class="cajaFlex">
    <fieldset class="ventana">
    <legend class="leyenda">Datos de <b><?php if(isset($name)){echo $name;} ?></b></legend>
    <section class="datos">
    <input type="hidden" name="id" value="<?php if(isset($idGet)){echo $idGet;} ?>"/>
        <div class="names">
            <div class="name">
                <label for="nombre">Usuario: </label>
            </div>
            <div class="name1">
                <input class="inputName" type="text" size="30" title="Usuario" name="usuario" autofocus value="<?php if(isset($name)){echo $name;}?>"/>
            </div>
        </div>
        <div class="cajaPassword">
        <div class="passwords">
            <label class="key" for="password">Contraseña:</label>
        </div>
        <div class="inputKey">
            <img class="ojoAbierto" src="img/eyeOpen.svg"/>
            <input class="pasword"type="password" patter=".{8,}" id="password" size="30" title="Contraseña" name="contraseña" autofocus value="<?php if(isset($pswd)){echo $pswd;}?>">   
        </div>
        </div>
        <div class="emails">
        <div class="email">
            <label for="mail">E-mail: </label>
        </div>
        <div>
            <input class="inputEmail" type="text" size="30" title="E-mail" name="email" autofocus value="<?php if(isset($mail)){echo $mail;}?>"/>
        </div>
        </div>
    </section>  
    </fieldset>
    
    <section class="sersex">
    <div class="servicios">Servicios:
        <div>
        <label for="web">
            <input id="web"type="checkbox" name="hobby[]" <?php if(isset($service)){ if(in_array("Web", $service)) { echo "checked";}} ?> value="Web"/>Web
        </label>
        </div>
        <div>
            <label for="redes">
                <input id="redes"type="checkbox" name="hobby[]" <?php if(isset($service)){ if(in_array("Redes", $service)) { echo "checked";}} ?> value="Redes"/>Redes
            </label>
        </div>
        <div>
            <label for="sistemas">
            <input id="sistemas"type="checkbox" name="hobby[]" <?php if(isset($service)){ if(in_array("Sistemas", $service)) { echo "checked";}} ?> value="Sistemas"/>Sistemas
            </label>
        </div>
    </div>
        <div class="cajaSexo">
            <label for="sexos">Sexo:
            <div>
                <input id="sexo1" name="sexos"type="radio" <?php if(isset($sex)){if($sex == "Mujer") {echo "checked";}} ?> value="Mujer">
                <label for="sexo1">
                <span class="mujer"></span>
                <span>Mujer</span></label>
            </div>
            <div>
                <input id="sexo2" name="sexos"type="radio" <?php if(isset($sex)){if($sex == "Hombre") {echo "checked";}}  ?> value="Hombre">
                <label for="sexo2">
                <span class="hombre"></span>
                <span>Hombre</span></label>
            </div>
            <div>
                <input id="sexo3" name="sexos"type="radio" <?php if(isset($sex)){if($sex == "NS-NC") {echo "checked";}}  ?> value="NS-NC">
                <label for="sexo3">
                <span class="nsnc"></span>
                <span>NS/NC</span></label>
            </div>
            </label>
        </div>
    </section> 
    <div class="submit">
        <input class="botonEnviar" type="submit" value="ENVIAR">
    </div> 
    <?php
        require_once("validacionUpdate.php");
    ?>  
</section>
</form>      

<script src="js/javascript.js"></script>  
</body>
</html>