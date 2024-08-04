<?php
require_once "../../functions/autoload.php";

try {
    $usuario = new Usuario();
    $usuario->edit($_POST["nombre"], $_POST["id"]);
    header("Location: ../index.php?sec=admin_usuarios");
} catch (Exception $e) {
    echo $e->getMessage();
    die("Error al editar talle");
}

