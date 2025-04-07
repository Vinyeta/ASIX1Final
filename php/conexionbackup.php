<?php
//PLANTILLA DE CONEXION A BASE DE DATOS
//crear constantes para la base de datos
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
//nombre de la base de datos

//crear conexion
$con=new mysqli(SERVIDOR,USUARIO,PASSWORD);
$con->query("CREATE DATABASE IF NOT EXISTS registrotypeform");
$con->select_db("registrotypeform");

//comprobar conexion
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

?>