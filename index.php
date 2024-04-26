<?php 
    require_once "libraries/productos.php";
    require_once "class/Comic.php";

    // echo "<pre>";
    // print_r($_GET["sec"]); //index.php
    // echo "</pre>";
    $view = isset($_GET["sec"]) ? $_GET["sec"] : "home"; 
    $vista = "404";
    $seccionesValidas = [
        "home" => [
            "titulo" => "Bienvenidos"
        ],
        "404" => [
            "titulo" => "La pagina no fue encontrada"
        ],
        "comic" => [
            "titulo" => "Detalle de comic"
        ],
        "comics" => [
            "titulo" => "Comics"
        ],
        "envios" => [
            "titulo" => "Envios"
        ],
        "quienes_somos"  => [
            "titulo" => "Quienes Somos?"
        ],
        "todosLosComics" => [
            "titulo" => "Todos los comics"
        ]
    ];

    if( array_key_exists($view, $seccionesValidas) ){
        $vista = $view;
        $titulo = $seccionesValidas[$view]["titulo"];
    }else{
        $vista = "404";
        $titulo = $seccionesValidas["404"]["titulo"];
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DROPDEAD - Ecommerce <?= $titulo ?> </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" href="assets/icon/faviconDrop.png">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include_once "includes/nav.php" ?>

    <main class="container">
        <?php file_exists("views/$vista.php") 
                ? include "views/$vista.php" 
                : include "views/404.php" ?>
    </main>

    <?php include_once "includes/footer.php" ?>
</body>

</html>
