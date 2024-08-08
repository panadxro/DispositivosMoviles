<?php
require_once "../../functions/autoload.php";
$usuario_id = $_SESSION['login']['id'];
$producto_id = $_GET['id'] ?? FALSE;
$cantidad = $_GET['cantidad'] ?? 1;
$talle = $_GET['talle'] ?? FALSE;

if($producto_id){
    (new Carrito())->add_item($producto_id, $cantidad, $talle);
    (new Carrito())->insert_item($usuario_id ,$producto_id, $cantidad, $talle);
    (new Alerta())->add_alerta("Producto agregado al carrito", "success");
    header("Location: ../../index.php?sec=detalle&id=$producto_id");
}