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
    <title>Productos</title>
    <link rel="stylesheet" href="css/header.css"/>
    <link rel="stylesheet" href="css/styleProductos.css"/>
</head>
<body>
    <h1>Nuestros Servicios</h1>
    
    <a class="enlaceProductos" href="productos.php#tus_productos">Ir a mis productos</a>
<?php
require_once("conexionok.php");
//1 MOSTRAR CARRITO COMPRA
$idUsuario=$_SESSION['id'];
$totalPrecio=0;
//1.1 CONSULTA SQL, se asocian la clave foranea de ventas y la id de productos
$carrito_sql= "SELECT ventas.producto_id, ventas.id, productos.nombre, productos.precio, productos.img 
               FROM ventas JOIN productos ON ventas.producto_id=productos.id 
               WHERE ventas.usuario_id=$idUsuario AND ventas.estado='carrito'";
$result_carrito=$con->query($carrito_sql);
if($result_carrito->num_rows>0){
    echo "<section class='productos__user__carrito'>";
    while($carro=$result_carrito->fetch_assoc()){
        $imagenn=$carro['img'];
        $id_productoo=$carro['producto_id'];
        $prices=$carro['precio'];
        $totalPrecio += $prices;
        echo "<div class='lista__productos'>
              <div class='productos__carrito'>
                    <h2 class='producto__carrito__nombre'>{$carro['nombre']}</h2>
                    <div class='producto__carrito__imagen'>
                        <img class='imagen' src='$imagenn'>
                    </div>
                    <div class='producto__carrito__precio'>Precio: {$carro['precio']} €</div>
                    <form action='productos.php' method='POST'>
                      <input type='hidden' name='id_productoo' value='$id_productoo'>
                      <input type='submit' name='quitar' class='botonEliminar' value='Quitar'>
                  </form>
              </div>
              </div>";
    }

    echo "<div class='error_carrito'></div>
          </section>
          <h4 class='total__carrito'>Total carrito: $totalPrecio €</h4>
          <form action='productos.php' method='POST'>
          <input type='submit' name='comprar' class='botonComprar' value='Comprar'>
          </form>";
} else {
    echo "<div class='error_carrito'></div><h3 class='carrito_vacio'>No tienes productos en el carrito ¡Echa un vistazo!</h3>";
}
//1.2 CONSULTA SQL PARA ACTUALIZAR EL ESTADO DE VENTAS A COMPRADO
if(isset($_POST['comprar'])){
    $update_sql="UPDATE ventas JOIN productos ON ventas.producto_id=productos.id
                  SET ventas.estado='comprado' WHERE ventas.usuario_id=$idUsuario AND ventas.estado='carrito'";

    if($con->query($update_sql)===TRUE){
        echo "<script>
                window.location.href='productos.php?mensaje=comprado';
              </script>";
    } else {
        echo "<div class='comprado'>Vaya...algo ha salido mal</div>";
    }
}
if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'comprado') {
    echo "<script>
          document.querySelector('.error_carrito').innerHTML='¡Gracias por tu compra!';
          </script>";
}
//1.3 CONSULTA SQL PARA QUITAR DEL CARRITO UN PRODUCTO
if(isset($_POST['quitar'])){
    $id_quitar=$_POST['id_productoo'];
    $idUserr=$_SESSION['id'];
    $delete_sql="DELETE FROM ventas 
                 WHERE usuario_id=$idUserr
                 AND producto_id=$id_quitar 
                 AND estado='carrito'";

    if($con->query($delete_sql)===TRUE){
        echo "<script>
                window.location.href='productos.php?mensaje=quitado';
              </script>";
    } else {
        echo "<div class='error_carrito'>Vaya...algo ha salido mal</div>";
    }
}
//FIN PARTE CARRITO COMPRA
?>

<div id="filtro"></div>
<fieldset class='bordeFiltro'><legend>Selecciona aquí la categoría</legend>
        <div class='producto__filtro'>
            <a href='productos.php?categoria=Redes#filtro' title='Redes'><img class='imgRedes' src='img/Redes.png'></a>
            <a href='productos.php?categoria=Sistemas#filtro' title='Sistemas'><img class='imgSistemas' src='img/Sistemas.png'></a>
            <a href='productos.php?categoria=Web#filtro' title='Web'><img class='imgWeb' src='img/Web.png'></a>
            <a href='productos.php#filtro' title='Todos los productos'><img class='imgFiltro' src='img/Todo.png'></a>
            
        </div>
</fieldset>


<?php
//MOSTRAR PRODUCTOS
if(isset($_GET['categoria'])){
    //2.1 MOSTRAR PRODUCTOS FILTRADOS, con get se obtiene variable de categoria y se utiliza para consulta SQL
    $categoria=$_GET['categoria'];
    $sql="SELECT productos.*
          FROM productos
          LEFT JOIN ventas ON productos.id = ventas.producto_id
          WHERE productos.categoria = '$categoria'
          AND ventas.estado IS NULL;";

    $result=$con->query($sql);
    $numProductos = $result->num_rows;
    echo "<h2 class='tituloProductos'>Mostrando los productos de: $categoria [$numProductos]</h2>";
    if($result->num_rows>0){
        echo "<section class='productos'>";
        while ($fila=$result->fetch_assoc()){
            $idProducto=$fila['id'];
            $img=$fila['img'];
            $seccion=$fila['categoria'];
            echo "<div class='producto'>
                    <div class='producto__precio'>{$fila['precio']} €</div>
                    <div class='producto__imagen'><img class='imagen' src='$img'></div>
                    <h2 class='producto__nombre'>{$fila['nombre']}</h2>
                    <div class='producto__flex'>
                    <div class='producto__flex__categoria'><img class='iconoServ' title='$seccion' src='img/$seccion.png'></div>
                    <form action='productos.php' method='POST'>
                        <input type='hidden' name='idProducto' value='$idProducto'>
                        <input type='submit' class='producto__flex__boton' value='Lo quiero'>
                    </form>
                    </div>
              </div>";
        }
        echo "</section>";
    }
} else {
    //2.2 MOSTRAR TODOS LOS PRODUCTOS
    $sql = "SELECT productos.*
            FROM productos
            LEFT JOIN ventas ON productos.id = ventas.producto_id
            WHERE ventas.estado IS NULL;";
    $result=$con->query($sql);
    $numProductos=$result->num_rows;
    echo "<h2 class='tituloProductos'>Mostrando todos los productos [$numProductos]</h2>";
    if($result->num_rows>0){
        echo "<section class='productos'>";
        while ($fila=$result->fetch_assoc()){
            $idProducto=$fila['id'];
            $img=$fila['img'];
            $seccion=$fila['categoria'];
            echo "<div class='producto'>
                <div class='producto__precio'>{$fila['precio']} €</div>
                <div class='producto__imagen'><img class='imagen' src='$img'></div>
                <h2 class='producto__nombre'>{$fila['nombre']}</h2>
                <div class='producto__flex'>  
                <div class='producto__flex__categoria'><img class='iconoServ' title='$seccion' src='img/$seccion.png'></div>
                <form action='productos.php' method='POST'>
                    <input type='hidden' name='idProducto' value='$idProducto'>
                    <input type='submit' class='producto__flex__boton' value='Lo quiero'>
                </form>
                </div>
              </div>";
    }
    echo "</section>";
    }
    
}
//2.3 CONSULTA PARA AÑADIR AL CARRITO
if (isset($_POST['idProducto'])){
    $idUser=$_SESSION['id'];
    $id_producto=intval($_POST['idProducto']);
    //consulta para obtener precio de producto e insertarlo luego en la tabla ventas, es para calcular el precio total en el carrito
    //se podria hacer un join en el carrito si se tiene la clave foranea ¿?
    $consultaPrecio="SELECT precio FROM productos WHERE id=$id_producto";
    $resultado=$con->query($consultaPrecio);
    if($resultado->num_rows>0){
        $producto=$resultado->fetch_assoc();
        $precio=$producto['precio'];
    }
    
    //DESCARTADO 2.4 ANTES DE INSERTAR COMPROBAR SI EL PRODUCTO ESTA EN EL CARRITO
    $venta_sql="SELECT producto_id FROM ventas WHERE producto_id=$id_producto AND usuario_id=$idUser AND estado='carrito';";
    $checkVenta=$con->query($venta_sql);
    
    if ($checkVenta->num_rows > 0) {
        echo "<script>
            document.querySelector('.error_carrito').innerHTML = 'Ya tienes este producto en el carrito';
            window.location.href = 'productos.php';
        </script>";
    } else {
        //insertar en tabla ventas y estado carrito para mostrarlo
        $venta_sql = "INSERT INTO ventas(estado, usuario_id, producto_id, total) VALUES ('carrito', '$idUser', '$id_producto', '$precio')";
        if ($con->query($venta_sql)===TRUE) {
            echo "<script>
                window.location.href='productos.php';
            </script>";
        } else {
            echo "<script>
                        document.querySelector('.error_carrito').innerHTML='Error al añadir el producto';
                        window.location.href='productos.php';
                  </script>";
    }
} 
}
//FIN AÑADIR AL CARRITO
//3 MOSTRAR PRODUCTOS COMPRADOS
?>  


<?php
$idUsuario=$_SESSION['id'];
$venta_sql= "SELECT ventas.id, ventas.estado, productos.nombre, productos.precio, productos.img 
             FROM ventas JOIN productos ON ventas.producto_id=productos.id 
             WHERE ventas.usuario_id=$idUsuario AND ventas.estado='comprado'";
$result_ventas=$con->query($venta_sql);
$numComprados=$result_ventas->num_rows;
if($result_ventas->num_rows>0){
    echo "<h2 id='tus_productos'>Tus productos [$numComprados]</h2>
          <section class='productos__user__comprado'>";
    while($venta=$result_ventas->fetch_assoc()){
        $image=$venta['img'];
        $id_producto=$venta['id'];
        $price=$venta['precio'];
        echo "<div class='productos__comprados'>
                    <h3 class='producto__comprado__nombre'>{$venta['nombre']}</h3>
                    <div class='producto__comprado__imagen'>
                        <img class='imagen' src='$image'>
                    </div>
                    <div class='producto__comprado__precio'>Precio: {$venta['precio']} €</div>
                    <form action='productos.php' method='POST'>
                      <input type='hidden' name='id_producto' value='$id_producto'>
                      <input type='submit' name='eliminar' class='botonEliminar' value='Devolver'>
                  </form>
              </div>";
    }
    echo "</section>";
    
} else {
    echo "<h2 class='carrito_vacio'>No tienes productos comprados</h2>";
}

//3.1 ELIMINAR PRODUCTO DE VENTAS

if (isset($_POST['eliminar'])) {
    $id_devolver=$_POST['id_producto'];
    $delete_sql="DELETE FROM ventas WHERE id=$id_devolver AND usuario_id={$_SESSION['id']}";
    if ($con->query($delete_sql) === TRUE) {
        echo "<script>
                window.location.href='productos.php?mensaje=devuelto';
              </script>";
        
    } else {
        echo "<div><h4 id='eliminado'>No se ha podido devolver el producto</h4></div>";
        echo "<script>document.getElementById('eliminado').scrollIntoView();</script>";
    }
    $con->close();   
}

if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'devuelto') {
    echo "<div><h4 id='eliminado'>¡Producto devuelto! Reembolso en 15 días</h4></div>";
    echo "<script>
          document.getElementById('eliminado').scrollIntoView();
          </script>";
}
?>


<script src="js/jsenlaces.js"></script>
<script src="js/productos.js"></script>  
</body>
</html>