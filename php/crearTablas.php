<?php
    
require_once("conexionok.php");
$sql="CREATE TABLE IF NOT EXISTS productos(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(200),
        descripcion VARCHAR(255),
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
    token VARCHAR(150),
    token_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
  // si usuarios ya existe modificar usando el siguiente comando:
  // ALTER TABLE usuarios ADD token VARCHAR(150);
  // ALTER TABLE usuarios ADD token_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
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

  $sql = "CREATE TABLE IF NOT EXISTS ranking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT UNIQUE,
    nombre varchar(200),
    categoria varchar(60),
    ventas_count INT DEFAULT 0,
    FOREIGN KEY (id_producto) REFERENCES productos(id) ON DELETE SET NULL
);";

if ($con->multi_query($sql) === FALSE) {
  echo "Error creando tabla: " . $con->error;
  } 

$sql = "CREATE TRIGGER IF NOT EXISTS  after_insert_ventas
AFTER INSERT ON ventas
FOR EACH ROW
BEGIN
    UPDATE ranking 
    SET ventas_count = ventas_count + 1
    WHERE id_producto = NEW.producto_id;
END;";
if ($con->multi_query($sql) === FALSE) {
  echo "Error creando trigger: " . $con->error;
}

$sql = "CREATE TRIGGER IF NOT EXISTS after_insert_productos
AFTER INSERT ON productos
FOR EACH ROW
BEGIN
   INSERT INTO ranking (id,id_producto, nombre, categoria,ventas_count)
    VALUES (NULL,NEW.id, NEW.nombre, NEW.categoria,0);
END";

$sql = "CREATE TRIGGER IF NOT EXISTS after_delete_ventas
AFTER DELETE ON ventas
FOR EACH ROW
BEGIN
    UPDATE ranking
    SET ventas_count = ventas_count - 1
    WHERE id_producto = OLD.producto_id;
END";

if ($con->multi_query($sql) === FALSE) {
  echo "Error creando trigger: " . $con->error;
}

$con->close();

?>
