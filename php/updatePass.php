<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/registro_login.css" />
<?php
    require_once("header.php");
    require_once("conexionok.php");
    $token = htmlspecialchars(trim($_GET['token']));
    $sql = $con->prepare("SELECT id, token_creacion FROM usuarios WHERE token = ?");
    $sql->bind_param("s", $token);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            $id = $fila['id'];
            $token_creacion = $fila['token_creacion'];
        }
    }
?>

</head>

<body>

    <div class="contacta">Cambio de contraseña</div>

    <form method="post" action="updatePass.php">
        <section class="cajaFlex">
            </div>
            <fieldset class="ventana">
                <legend class="leyenda">Contraseña nueva</legend>
                <section class="datos">
                    <div class="cajaPassword">
                        <div class="passwords">
                            <label class="key" for="password">Contraseña:</label>
                        </div>
                        <div class="inputKey">
                            <img class="ojoAbierto" src="img/eyeOpen.svg" />
                            <input class="pasword" type="password" patter=".{8,}" id="password" size="30" title="Contraseña" name="contraseña" autofocus placeholder="Contraseña">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="token" value="<?php echo $token_creacion; ?>">
                </section>
            </fieldset>
            <div class="submit">
                <input class="botonEnviar" type="submit" value="Enviar">
            </div>
            <?php
            require_once("updatePassValidation.php");
            ?>
        </section>
    </form>
    <script src="js/javascript.js"></script>

</body>

</html>