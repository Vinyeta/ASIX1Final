<?php
// PLANTILLA DE CONEXION A BASE DE DATOS

// Crear constantes para la base de datos

define('SERVIDOR', 'localhost');
define('USUARIO', 'mytypeoscad6');
define('PASSWORD', 'H678E5L4');  
define('BD', 'registrotypeform');

/*define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');  
define('BD', 'registrotypeform');*/


if (!isset($con)) {
    $con = new mysqli(SERVIDOR, USUARIO, PASSWORD, BD);

    // Comprobar conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
}
/*
//PLANTILLA DE CONEXION A BASE DE DATOS
//crear constantes para la base de datos
define('SERVIDOR','typeoscar.com');
define('USUARIO','mytypeoscad6');
define('PASSWORD','H678E5L4');
//nombre de la base de datos

//crear conexion
$con=new mysqli(SERVIDOR,USUARIO,PASSWORD);
$con->query("CREATE DATABASE IF NOT EXISTS registrotypeform");
$con->select_db("registrotypeform");

//comprobar conexion
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}*/
?>
