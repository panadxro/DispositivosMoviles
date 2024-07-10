<?php
require_once "../../functions/autoload.php";
$fileData = $_FILES["imagen"] ?? FALSE;

try {
    $categoria = new Categoria();
    $categoria->edit($_POST["nombre"],$_POST["id"]);
    header("Location: ../index.php?sec=admin_categorias");
} catch (Exception $e) {
    echo $e->getMessage();
    die("Error al editar categoría");
}

