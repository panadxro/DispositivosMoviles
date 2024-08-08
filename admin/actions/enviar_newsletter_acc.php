<?php
require_once "../../functions/autoload.php";

try {
  (new Alerta())->add_alerta("Registrado a la Newsletter con éxito", "success");
    header("Location: ../../index.php?sec=home");
} catch (Exception $e) {
    echo $e->getMessage();
    die("Error al editar talle");
}
