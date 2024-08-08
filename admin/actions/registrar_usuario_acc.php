<?php

require_once "../../functions/autoload.php";

$email = $_POST["email"];
$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
$rol = 'usuario';

try {
    $usuarioAnterior = (new Usuario())->usuario_x_email($email);
    if($usuarioAnterior){
      (new Alerta())->add_alerta("El nombre de usuario que ingresó, ya existe.", "danger");
      header("Location: ../../index.php?sec=registro");
    }else{
      (new Usuario())->insert($email, $pass, $rol);
      (new Alerta())->add_alerta("Usuario creado con éxito", "success");
      header("Location: ../../index.php?sec=login");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

