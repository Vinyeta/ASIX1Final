<?php
$errores=false;

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(empty($_POST['contraseña'])){
         echo "<div class='errores'><div>El campo contraseña es obligatorio</div></div>";
    } else {
        $password=htmlspecialchars(trim($_POST['contraseña']));
        if(strlen($password)<6){
            $errores=true;
             echo "<div class='errores'><div>La contraseña debe tener al menos 6 caracteres</div></div>";
        }
        if(!preg_match('/[A-Z]/',$password) || !preg_match('/[0-9]/',$password) || !preg_match('/[a-z]/',$password)){
            $errores=true;
            echo "<div class='errores'><div>La contraseña debe incluir almenos una minúscula, una mayúscula y un número</div></div>";
        }

    }
}