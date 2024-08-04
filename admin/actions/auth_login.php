<?php
require_once "../../functions/autoload.php";

$email = $_POST["email"];
$pass = $_POST["pass"];

$login = (new Autenticacion())->log_in($email, $pass);

if( $login ){
    if($_SESSION["login"]["roles"] != "usuario" ){
        (new Alerta())->add_alerta("Bienvenido administrador", "success");
        (new Usuario())->usuario_x_email($email);
        header("Location: ../index.php?sec=dashboard");
    }else{
        header("Location: ../../index.php?sec=home");
    }
}else{
    (new Alerta())->add_alerta("Usuario o Contraseña incorrecto", "danger");
    (new Autenticacion())->log_out();
    header("Location: ../index.php?sec=login");
}