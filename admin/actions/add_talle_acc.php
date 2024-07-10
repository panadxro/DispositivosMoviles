<?php
    require_once "../../functions/autoload.php";
    try {
        ( new Talle() )->insert(
            $_POST["nombre"]
        );
        (new Alerta())->add_alerta("Talle cargado con éxito", "success");
        header("Location: ../index.php?sec=admin_talles");
    } catch (\Exception $e) {
        echo $e->getMessage();
        (new Alerta())->add_alerta("No se pudo agregar talle", "danger");
        die("Error al cargar talle :(");
    }
