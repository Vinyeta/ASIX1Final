<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}

require_once("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
    <link rel="stylesheet" href="css/header.css"/>
</head>
<body>
<?php
require_once("conexionok.php");
$id=$_GET['id'];
$usuario=$_GET['usuario'];
$sql="DELETE FROM usuarios WHERE id=$id";
if ($con->query($sql) === TRUE) {
  echo "<script>
          window.location.href='baseDatos.php';
        </script>";
  } else {
    echo "Error eliminando datos: " . $con->error;
  }
  echo "<div><a href='baseDatos.php'>Volver</a></div>";
    ?>
    
</body>
</html>