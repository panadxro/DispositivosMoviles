<?php
include_once "libraries/funciones.php";
// require_once "class/Comic.php";


// Detalle
$id = $_GET['id'];
$comic = (new Comic())->catalogo_x_id($id);

?>


<div class="detalle-producto">
      <div id="carouselExampleIndicators" class="carousel slide">
        <figure id="galeria-productos" class="carousel-inner">
          <picture class="carousel-item active">
            <source media="(max-width: 1024px)" srcset="<?= $comic->getImagen() ?>">
            <img src="<?= $comic->getImagen() ?>" alt="<?= $comic->getTitulo() ?>">
          </picture>
        </figure>
      </div>
      <article id="infoProducto">
        <h2 id="nombre-producto" class="titulo-2"><?= $comic->getTitulo() ?></h2>
        <span id="cat-producto"><?= $comic->getCategoria() ?></span>
        <p id="subtitulo-producto"><?= $comic->getSubtitulo() ?></p>
        <p id="descripcion-producto"><?= $comic->getDescripcion() ?></p>
        <p id="precio-producto"><?= $comic->getPrecio() ?></p>
        <button id="boton-agregar" class="boton add" data-id="2" data-val="50" data-cat="Remeras">Agregar al carrito</button>
      </article>
    </div>