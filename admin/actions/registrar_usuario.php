<?php

require_once "../../functions/autoload.php";

$email = $_POST["email"];
$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);

try {
    $usuarioAnterior = (new Usuario())->usuario_x_email($email);
    if($usuarioAnterior){
        //mensaje al usuario
    }else{
        (new Usuario())->insert($email, $pass);        
    }
    header("Location: ../../index.php?sec=login");
} catch (Exeption $e) {
    echo $e->getMessage();
}

