<?php
require_once "../../functions/autoload.php";

$id = $_GET["id"] ?? false;
$producto = (new Producto())->catalogo_x_id($id);
try {
    if( $producto->getImagen() != "" ){
        (new Imagen())->borrarImagen("../../img/covers/".$producto->getImagen());
    }
    $producto->delete();
} catch (Exception $e) {
    echo $e->getMessage();
    die("No se pudo eliminar :(");
}

header("Location: ../index.php?sec=admin_productos");
