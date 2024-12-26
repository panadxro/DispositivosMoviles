<?php
require_once "../../functions/autoload.php";

$usuario_id = $_SESSION['login']['id'];

$email = $_POST['email'];
$pais = $_POST['pais'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];
$postal = $_POST['postal'];
$telefono = $_POST['telefono'];

$miCompra = new Compra();
$miCompra->comprar($usuario_id);
$miCompra->cargarDatosComprador($usuario_id, $direccion, $email, $pais, $nombre, $apellido, $ciudad, $postal, $telefono);
$miCarrito = new Carrito();
$miCarrito->borrarCarritosAnteriores();

header("Location: ../../index.php?sec=recibo");
?>