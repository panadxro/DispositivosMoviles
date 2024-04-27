<?php 
    // require_once "libraries/productos.php";
    require_once "class/producto.php";

    // echo "<pre>";
    // print_r($_GET["sec"]); //index.php
    // echo "</pre>";
    $view = isset($_GET["sec"]) ? $_GET["sec"] : "home"; 
    $vista = "404";
    $seccionesValidas = [
        "home" => [
            "titulo" => "Home"
        ],
        "404" => [
            "titulo" => "Pagina no encontrada"
        ],
        "detalle" => [
            "titulo" => "Detalle de producto"
        ],
        "categoria" => [
            "titulo" => "Categoria"
        ],
        "envios" => [
            "titulo" => "Envios"
        ],
        "quienes_somos"  => [
            "titulo" => "Quienes Somos?"
        ],
        "catalogo" => [
            "titulo" => "Productos"
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
    <title><?= $titulo ?> | DROPDEAD</title>
    <link rel="shortcut icon" href="assets/icon/faviconDrop.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <?php include_once "includes/nav.php" ?>

    <main id="pag-<?= $view ?>">
        <?php file_exists("views/$vista.php") 
                ? include "views/$vista.php" 
                : include "views/404.php" ?>
    </main>
    <?php include_once "includes/footer.php" ?>
  </body>
  <script src="js/bootstrap.bundle.min.js"></script>

</html>
