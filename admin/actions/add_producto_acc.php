<?php
require_once "../../functions/autoload.php";

$talles = $_POST["talles"];

try {
  $imagen = ( new Imagen() )->subirImagen("../../img/covers", $_FILES["imagen"]);
    $producto_id = (new Producto())->insert(
      $_POST["nombre"],
        $_POST["alias"], 
        $_POST["categoria_id"], 
        $_POST["descripcion"],
        $imagen,
        $_POST["precio"]
    );

    foreach ($talles as $talle_id) {
      (new Producto())->add_talles($producto_id, $talle_id);
    }
    
    header("Location: ../index.php?sec=admin_productos");
} catch (\Exception $e) {
  echo $e->getMessage();
    die("No pude cargar el personaje :(");
  }
/* echo "<pre>";
print_r($producto_id);
echo "</pre>"; */