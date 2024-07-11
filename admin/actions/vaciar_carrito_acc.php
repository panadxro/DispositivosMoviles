<?php
require_once "../../functions/autoload.php";

(new Carrito())->vaciarCarrito();

header("Location: ../../index.php?sec=carrito");