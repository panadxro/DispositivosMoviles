<?php
require_once "../../functions/autoload.php";

$id = $_GET["id"] ?? false;
$usuario = (new Usuario())->catalogo_x_id($id);
try {
    $usuario->delete();
} catch (Exception $e) {
    echo $e->getMessage();
    die("No se pudo eliminar :(");
}

header("Location: ../index.php?sec=admin_usuarios");