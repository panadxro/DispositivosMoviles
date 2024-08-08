<?php
require_once "../../functions/autoload.php";

$usuario_id = $_SESSION['login']['id'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$miCompra = new Compra();
$miCompra->comprar($usuario_id);
$miCompra->cargarDatosComprador($usuario_id, $direccion, $email);
$miCarrito = new Carrito();
$miCarrito->borrarCarritosAnteriores();

header("Location: ../../index.php?sec=recibo");
?>