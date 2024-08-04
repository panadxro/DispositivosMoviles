<?php

require_once "../../functions/autoload.php";

$email = $_POST["email"];
$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
$rol = $_POST["rol_id"];

try {
    $usuarioAnterior = (new Usuario())->usuario_x_email($email);
    if($usuarioAnterior){
        //mensaje al usuario
    }else{
        $usuarioId = (new Usuario())->insert($email, $pass, $rol);
        (new Carrito())->insert($usuarioId);
    }
    header("Location: ../index.php?sec=admin_usuarios");
} catch (\Exception $e) {
    echo $e->getMessage();
}