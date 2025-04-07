
<?php
if(isset($_SESSION['id'])){
    echo "<header>
        <a class='logotipo' href='index.php'>
            <img class='imglogo' src='img/logotype.png' alt='logo typeform'>
        </a>
        <nav class='enlaces'>
            <a id='link' class='linkLogout' href='logout.php'>Logout</a>
            <a id='link' class='linkProductos' href='productos.php'>Productos</a> 
            <a id='link' class='linkUsuarios' href='baseDatos.php'>Usuarios</a>  
            <a id='link' class='linkMapa' href='mapa.php'>Ubicación</a>      
        </nav>
        <div>   
            <button class='botonHeader'>{$_SESSION['usuario']}</button>
        </div>
    </header>";
} else {
    echo "<header>
    <a href='index.php' class='logotipo'>
            <img class='imglogo' src='img/logotype.png' alt='logo typeform'>
        </a>
        <div class=enlacesBoton>
        <nav class='enlaces'>
            <a class='login' href='login.php'>Login</a>
            <div>|</div>  
            <a class='registro' href='formulario.php'>Registro</a>      
        </nav>
        <div>   
            <button class='botonHeader'>No registrado</button>
        </div>
        </div>
    </header>";
}
?>