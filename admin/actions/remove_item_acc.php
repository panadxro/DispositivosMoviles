<?php
require_once "../../functions/autoload.php";    
$id = $_GET['id'] ?? FALSE;

if($id){
    (new Carrito())->removeItem($id);
}
header("Location: ../../index.php?sec=carrito");