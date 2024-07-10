<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";
require_once "../../functions/autoload.php";
$fileData = $_FILES["imagen"] ?? FALSE;
$talles = $_POST["talles"];
try {
    $comic = new Producto();

    if( !empty($fileData["tmp_name"]) ){
        if( !empty($_POST["imagen_original"]) ){
            (new Imagen())->borrarImagen("../../img/covers/".$_POST["imagen_original"]);
        }
        $imagenNueva = (new Imagen())->subirImagen("../../img/covers", $fileData);
        $comic->reemplazarImagen($imagenNueva, $_POST["id"]);
    }
    (new Producto())->edit(
        $_POST["nombre"],
        $_POST["alias"], 
        $_POST["categoria_id"], 
        $_POST["descripcion"],
        $_POST["precio"],
        $_POST["id"]
    );
    (new Producto())->clear_talles($_POST["id"]);
    foreach ($talles as $talle_id) {
        (new Producto())->add_talles($_POST["id"], $talle_id);
    }
    (new Alerta())->add_alerta("Se pudo editar", "success");
    header("Location: ../index.php?sec=admin_productos");
} catch (Exception $e) {
    echo $e->getMessage();
    (new Alerta())->add_alerta("Se no pudo editar", "danger");
    die("No pude editar el personaje");
}