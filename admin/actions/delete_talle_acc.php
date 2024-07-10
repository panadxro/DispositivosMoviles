<?php
require_once "../../functions/autoload.php";

$id = $_GET["id"] ?? false;
$talle = (new Talle())->catalogo_x_id($id);
try {
    $talle->delete();
} catch (Exception $e) {
    echo $e->getMessage();
    die("No se pudo eliminar :(");
}

header("Location: ../index.php?sec=admin_talles");