<?php
    
require_once("conexionok.php");
$sql="CREATE TABLE IF NOT EXISTS productos(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(70),
        descripcion VARCHAR(200),
        precio DECIMAL(6,2),
        img VARCHAR(50),
        categoria VARCHAR(60) 	
        );";
if ($con->query($sql) === FALSE) {
    echo "Error creando tabla: " . $con->error;
    } 

$sql="CREATE TABLE IF NOT EXISTS usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(20),
    pass VARCHAR(200),
    email VARCHAR(50),
    hobby JSON,
    sexos VARCHAR(10),
    suscribir BOOLEAN	,
    token VARCHAR(150)
    )";
  // si usuarios ya existe modificar usando el siguiente comando:
  // ALTER TABLE usuarios ADD token VARCHAR(150);
  if ($con->query($sql) === FALSE) {
    echo "Error creando tabla: " . $con->error;
    } 
  $sql = "CREATE TABLE IF NOT EXISTS ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    estado VARCHAR(20),
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
    );";

if ($con->query($sql) === FALSE) {
  echo "Error creando tabla: " . $con->error;
  } 


  $sql="CREATE TABLE IF NOT EXISTS opiniones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    valoracion INT,
    comentario TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);";

if ($con->query($sql) === FALSE) {
  echo "Error creando tabla: " . $con->error;
  } 

$con->close();

    
?>
