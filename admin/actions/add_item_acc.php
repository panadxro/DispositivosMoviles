<?php
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$c = $_GET['c'] ?? 1;
$talle = $_GET['talle'] ?? FALSE;

if($id){
    (new Carrito())->add_item($id, $c, $talle);
    (new Alerta())->add_alerta("Producto agregado al carrito", "success");
    header("Location: ../../index.php?sec=detalle&id=$id");
    // header("Location: ../../index.php?sec=carrito");
}