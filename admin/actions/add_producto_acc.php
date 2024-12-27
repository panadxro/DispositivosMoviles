<?php
require_once "../../functions/autoload.php";

$talles = $_POST["talles"];

try {
    // Generar un alias del nombre del producto (sin espacios y en minúsculas)
    $nombreProducto = str_replace(' ', '', $_POST["nombre"]);
    
    // Subir las imágenes
    $imagenes = (new Imagen())->subirImagenes("../../assets/products", $nombreProducto, $_FILES["imagenes"]);
    
    // Insertar el producto en la base de datos (solo almacena el nombre)
    $producto_id = (new Producto())->insert(
        $_POST["nombre"],
        $_POST["alias"], 
        $_POST["categoria_id"], 
        $_POST["descripcion"],
        $imagenes[0], // Primera imagen como portada
        $_POST["precio"]
    );

    // Asignar los talles
    foreach ($talles as $talle_id) {
        (new Producto())->add_talles($producto_id, $talle_id);
    }
    
    header("Location: ../index.php?sec=admin_productos");
} catch (\Exception $e) {
    echo $e->getMessage();
    die("No se pudo cargar el producto.");
}
