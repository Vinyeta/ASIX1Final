<?php
$idUsuario=$_SESSION['id'];
$totalPrecio=0;
$carrito_sql= "SELECT ventas.id, productos.nombre, productos.precio, productos.img 
             FROM ventas JOIN productos ON ventas.producto_id=productos.id 
             WHERE ventas.usuario_id=$idUsuario AND productos.estado='carrito'";
$result_carrito=$con->query($carrito_sql);
if($result_carrito->num_rows>0){
    echo "<section class='productos__user'>";
    while($carro=$result_carrito->fetch_assoc()){
        $imagenn=$venta['img'];
        $id_productoo=$venta['id'];
        $prices=$venta['precio'];
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
if(isset($_POST['comprar'])){
    $uptdate_sql="UPDATE ventas JOIN productos ON ventas.producto_id=productos.id
                  SET productos.estado='comprado' WHERE ventas.usuario_id=$idUsuario AND productos.estado='carrito'";

    if($con->query_sql($update_sql)===TRUE){
        echo "<div class='comprado'>¡Gracias por tu compra!<a href='productos.php#tus_productos'>Ir a productos comprados</a></div>";
    } else {
        echo "<div class='comprado'>Vaya...algo ha salido mal</div>";
    }
}
if(isset($_POST['quitar'])){
    $delete_sql="DELETE ventas FROM ventas JOIN productos ON ventas.producto_id=productos.id
                 WHERE ventas.usuario_id=$idUsuario AND productos.estado='carrito'";

    if($con->query_sql($delete_sql)===TRUE){
        echo "<script>window.location('productos.php')";
    } else {
        echo "<div class='comprado'>Vaya...algo ha salido mal</div>";
    }
}
?>