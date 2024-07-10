<?php
require_once "../../functions/autoload.php";

try {
    $talle = new Talle();
    $talle->edit($_POST["nombre"], $_POST["id"]);
    header("Location: ../index.php?sec=admin_talles");
} catch (Exception $e) {
    echo $e->getMessage();
    die("Error al editar talle");
}

