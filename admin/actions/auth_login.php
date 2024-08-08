<?php
require_once "../../functions/autoload.php";

$email = $_POST["email"];
$pass = $_POST["pass"];

$login = (new Autenticacion())->log_in($email, $pass);

if( $login ){
  if($_SESSION["login"]["roles"] != "usuario" ){
    header("Location: ../index.php?sec=dashboard");
  }else{
    header("Location: ../../index.php?sec=home");
  }
}else{
    (new Autenticacion())->log_out();
    (new Alerta())->add_alerta("Usuario o Contraseña incorrecto", "danger");
    header("Location: ../index.php?sec=login");
}