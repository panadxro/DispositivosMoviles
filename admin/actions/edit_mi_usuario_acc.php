<?php
require_once "../../functions/autoload.php";
$email = $_POST["email"];
$pass = $_POST["pass"];

$usuario = (new Usuario())->usuario_x_email($email);

if ($usuario) {
  if (password_verify($pass, $usuario->getPassword())) {
      try {
          $usuario->edit(
              $_POST["id"],
              $_POST["email"], 
              $_POST["rol_id"],
              $_POST["new_pass"] ?? null
          );
          (new Alerta())->add_alerta("Datos de usuario guardados.", "success");
          header("Location: ../../index.php?sec=perfil");
      } catch (Exception $e) {
          echo $e->getMessage();
          die("Error al editar usuario");
      }
  } else {
    (new Alerta())->add_alerta("Contraseña actual incorrecta.", "danger");
    header("Location: ../../index.php?sec=perfil");
  }
} else {
  header("Location: ../index.php?sec=home");
}