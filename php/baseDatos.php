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
    <title>Tabla de datos</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/styleDatos.css"/>
</head>
<body>
    <div class="titulo">Usuarios registrados</div>
    
<?php
require_once("conexionok.php");
$stmt = $con->prepare("SELECT * FROM usuarios");
$stmt->execute();

$result = $stmt->get_result();
//$data=array[]
//while ($result->num_rows > 0){ while ($row = $result->fetch_assoc()){
    // $data[]=$row}}

if($result->num_rows>0){
    while ($fila=$result->fetch_assoc()){
        $hobbyJson=$fila['hobby'];
        $hobby=json_decode($hobbyJson, true); 
        $sexos=$fila['sexos'];
        echo "<fieldset><table class='cajaDatos'>
                
                    <caption>Datos de <b>{$fila['usuario']}</b> con Id <b>{$fila['id']}:</b></caption>
                
                <tr>
                    <td class='columna1'>
                    <div class='datos'>
                        <div class='texto'>PASSWORD:</div>
                        <div>Ni de coña</div>
                    </div>
                    </td>
                    <td class='columna2'><b>SERVICIOS:</b><div class='servicios'>";
                    foreach($hobby as $servimg){
                        echo "<div class='icono'><img class='iconoServ' title='$servimg' src='img/$servimg.png'></div>";
                    }
                    
        echo        "</div></td>
                    <td rowspan='2' class='imgButtons'>
                        <div>
                        <a href='eliminar.php?id={$fila['id']}&usuario={$fila['usuario']}'>
                            <img class='eliminar' title='Eliminar usuario' src='img/papelera.png'>
                        </a>
                        </div> 
                        <div>
                        <a href='modificar.php?id={$fila['id']}'>
                            <img class='editar' title='Editar usuario' src='img/editar.png'>
                        </a>
                        </div>   
                    </td>
                </tr>
                <tr>
                    <td class='columna1'>
                    <div class='datos'>
                        <div class='texto'>E-MAIL:</div>
                        <div>{$fila['email']}</div>
                    </div></td>
                    <td class='columna2'>
                    <div class='datos'>
                        <div class='texto'>SEXO:</div>
                        <div><img class='iconoSexo' title='$sexos' src='img/$sexos.png'></div>
                    </div>
                    </td>
                </tr>
                </table></fieldset>";
    }
    
}
$stmt->close();
?>
<div id="marcador"></div>
<form method="post" action="">
    <fieldset class="cajaComentario">
        <h4>TU OPINIÓN NOS IMPORTA</h4>
        <div class="estrellas">
            <img src="img/estrellaGris.png" class="estrella" value="0">
            <img src="img/estrellaGris.png" class="estrella" value="1">
            <img src="img/estrellaGris.png" class="estrella" value="2">
            <img src="img/estrellaGris.png" class="estrella" value="3">
            <img src="img/estrellaGris.png" class="estrella" value="4">
        </div>
        <textarea name="comentario" id="comentario" maxlength="200" placeholder="Deja tu opinión"></textarea>
        <div id="contador">/200</div>
        <input name="estrellas" class="regalo" type="hidden" value="">
        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id'];?>">
        <div class="submit__error">
        <div class="enviar"><input class="enviarComentario" type="submit" value="Enviar"><div>
        <div>
            <?php require_once("comentarios.php"); ?>
        </div>
        </div>
</fieldset>
    </form>

<section class="opiniones">
    <?php require_once("opiniones.php"); ?>
</section>
<script src="js/jsenlaces.js"></script>
<script src="js/usuarios.js"></script>
</body>
</html>