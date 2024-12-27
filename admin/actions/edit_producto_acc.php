<?php
require_once "../../functions/autoload.php";

$talles = $_POST["talles"];
$fileData = $_FILES["imagenes"];
$imagenesExistentes = $_POST["imagenes_existentes"] ?? [];
$nombreProducto = str_replace(["'", "&", " "], "", $_POST["nombre"]);

try {
    // Manejar imágenes
    $directorio = "../../assets/products/$nombreProducto";
    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    foreach ($fileData["tmp_name"] as $index => $tmp_name) {
        if (!empty($tmp_name)) {
            $nombreImagen = "{$nombreProducto}" . ($index + 1) . ".png";
            $rutaImagen = "$directorio/$nombreImagen";

            // Si existe una imagen previa, reemplazarla
            if (!empty($imagenesExistentes[$index]) && file_exists("$directorio/{$imagenesExistentes[$index]}")) {
                unlink("$directorio/{$imagenesExistentes[$index]}");
            }

            move_uploaded_file($tmp_name, $rutaImagen);
        }
    }

    // Actualizar el producto en la base de datos
    (new Producto())->edit(
        $_POST["nombre"],
        $_POST["alias"],
        $_POST["categoria_id"],
        $_POST["descripcion"],
        $_POST["precio"],
        $_POST["id"]
    );

    // Actualizar talles
    (new Producto())->clear_talles($_POST["id"]);
    foreach ($talles as $talle_id) {
        (new Producto())->add_talles($_POST["id"], $talle_id);
    }

    (new Alerta())->add_alerta("Se pudo editar el producto", "success");
    header("Location: ../index.php?sec=admin_productos");
} catch (Exception $e) {
    echo $e->getMessage();
    (new Alerta())->add_alerta("No se pudo editar el producto", "danger");
    die("Error al editar el producto");
}
