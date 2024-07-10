<?php
require_once "../../functions/autoload.php";

$id = $_GET["id"] ?? false;
$categoria = (new Categoria())->get_x_id($id);
try {
    $categoria->delete();
} catch (Exception $e) {
    echo $e->getMessage();
    die("No se pudo eliminar :(");
}


header("Location: ../index.php?sec=admin_categorias");

