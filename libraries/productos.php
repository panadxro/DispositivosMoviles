<?php 
function catalogo_completo(){
        $productosStringJson = file_get_contents("includes/productos.json");
        $productosArray = json_decode($productosStringJson, true);
        // echo "<pre>";
        // print_r($productosArray);
        // echo "</pre>";
        return $productosArray;
    }

function catalogo_x_personaje($personaje){
    $comics = catalogo_completo();
    $personajes = [];

    foreach ($comics as $comic) {
        if( $comic["personaje"] == $personaje ){
            $personajes []= $comic;
        }
    }

    return $personajes;
}

function catalogo_x_id($id){
    $comics = catalogo_completo();

    foreach ($comics as $comic) {
        if( $comic["id"] == $id ){
            return $comic;
        }
    }

    return [];
}