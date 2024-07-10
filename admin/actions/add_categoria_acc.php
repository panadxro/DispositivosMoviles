<?php
    require_once "../../functions/autoload.php";
    try {
        ( new Categoria() )->insert(
            $_POST["nombre"]
        );
        (new Alerta())->add_alerta("Categoría cargada con éxito", "success");
        header("Location: ../index.php?sec=admin_categorias");
    } catch (\Exception $e) {
        echo $e->getMessage();
        (new Alerta())->add_alerta("No se pudo agregar artista", "danger");
        die("No pude cargar la categoría :(");
    }

