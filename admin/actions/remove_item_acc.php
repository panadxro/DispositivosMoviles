<?php
require_once "../../functions/autoload.php";    
$id = $_GET['id'] ?? FALSE;

if($id){
    // (new Carrito())->removeItem($id);
    (new Carrito())->delete_item($id);
}
header("Location: ../../index.php?sec=carrito");