<?php
//PLANTILLA DE CONEXION A BASE DE DATOS
//crear constantes para la base de datos
define('SERVIDOR','localhost');
define('USUARIO','typeformAdmin');
define('PASSWORD','typeform');
//nombre de la base de datos

//crear conexion
$con=new mysqli(SERVIDOR,USUARIO,PASSWORD);
$con->query("CREATE DATABASE IF NOT EXISTS typeformcontacto");
$con->select_db("typeformcontacto");

//comprobar conexion
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

?>