<?php
require_once "../../functions/autoload.php";

$id = $_GET["id"] ?? false;
$producto = (new Producto())->catalogo_x_id($id);

try {
    if ($id && $producto) {
        // Construir la ruta de la carpeta del producto
        $nombreProducto = str_replace(' ', '', $producto->getNombre()); // Alias sin espacios
        $rutaCarpeta = "../../assets/products/$nombreProducto";

        // Borrar la carpeta de imágenes del producto
        (new Imagen())->borrarCarpeta($rutaCarpeta);

        // Eliminar el registro del producto de la base de datos
        $producto->delete();
    } else {
        throw new Exception("Producto no encontrado.");
    }
} catch (Exception $e) {
    echo $e->getMessage();
    die("No se pudo eliminar el producto.");
}

header("Location: ../index.php?sec=admin_productos");
