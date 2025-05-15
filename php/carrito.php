<?php
$idUsuario = $_SESSION['id'];
$totalPrecio = 0;

//PRODUCTOS QUE HAY EN EL CARRITO
$stmt = $con->prepare("SELECT ventas.id, productos.nombre, productos.precio, productos.img 
                       FROM ventas 
                       JOIN productos ON ventas.producto_id=productos.id 
                       WHERE ventas.usuario_id = ? AND productos.estado = 'carrito'");

$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result_carrito = $stmt->get_result();

if ($result_carrito->num_rows > 0) {
    echo "<section class='productos__user'>";
    while ($carro = $result_carrito->fetch_assoc()) {
        $imagenn = $venta['img'];  
        $id_productoo = $venta['id'];
        $prices = $venta['precio'];
        $totalPrecio += $prices;       
        echo "<div class='lista__productos'>
                <div class='productos__carrito'>
                    <h3 class='producto__carrito__nombre'>{$carro['nombre']}</h3>
                    <div class='producto__carrito__imagen'>
                        <img class='imagen' src='$imagenn'>
                    </div>
                    <div class='producto__carrito__precio'>Precio: {$carro['precio']} €</div>
                    <form action='productos.php' method='POST'>
                        <input type='hidden' name='id_producto' value='$id_productoo'>
                        <input type='submit' name='quitar' class='botonEliminar' value='Quitar'>
                    </form>
                </div>
              </div>";
    }

    echo "<h4>Precio total carrito: $totalPrecio €</h4>
          <form action='productos.php' method='POST'>
          <input type='submit' name='comprar' class='botonComprar' value='Comprar'></section>
          </form>";
} else {
    echo "<h3>Todavía no tienes productos en el carrito ¡Echa un vistazo!</h3>";
}

// Consulta UPDATE (marcar productos como "comprado")
if (isset($_POST['comprar'])) {
    $stmt_update = $con->prepare("UPDATE ventas 
                                  JOIN productos ON ventas.producto_id = productos.id
                                  SET productos.estado = 'comprado' 
                                  WHERE ventas.usuario_id = ? AND productos.estado = 'carrito'");

    $stmt_update->bind_param("i", $idUsuario);
    if ($stmt_update->execute()) {
        echo "<div class='comprado'>¡Gracias por tu compra!<a href='productos.php#tus_productos'>Ir a productos comprados</a></div>";
    } else {
        echo "<div class='comprado'>Vaya...algo ha salido mal</div>";
    }
}

// Consulta DELETE (eliminar productos del carrito)
if (isset($_POST['quitar'])) {
    $stmt_delete = $con->prepare("DELETE ventas 
                                  FROM ventas 
                                  JOIN productos ON ventas.producto_id = productos.id
                                  WHERE ventas.usuario_id = ? AND productos.estado = 'carrito'");

    $stmt_delete->bind_param("i", $idUsuario);
    if ($stmt_delete->execute()) {
        echo "<script>window.location='productos.php';</script>";
    } else {
        echo "<div class='comprado'>Vaya...algo ha salido mal</div>";
    }
}
?>