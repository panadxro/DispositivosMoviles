<?php
require_once "../../functions/autoload.php";
$usuario_id = $_SESSION['login']['id'];

(new Carrito())->vaciarCarrito();
// (new Carrito())->insert_item($usuario_id);
// $miCarrito = (new Carrito())->get_carrito_x_usuario($usuario_id);
(new Carrito())->borrarCarritosAnteriores();


header("Location: ../../index.php?sec=carrito");