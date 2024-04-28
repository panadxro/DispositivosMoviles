<?php
// require_once "class/producto.php";


// Detalle
$id = $_GET['id'];
$producto = (new Producto())->catalogo_x_id($id);

?>


<div class="detalle-producto">
      <div id="carouselExampleIndicators" class="carousel slide">
        <figure id="galeria-productos" class="carousel-inner">
          <picture class="carousel-item active">
            <source media="(max-width: 1024px)" srcset="<?= $producto->getImagen() ?>">
            <img src="<?= $producto->getImagen() ?>" alt="<?= $producto->getTitulo() ?>">
          </picture>
        </figure>
      </div>
      <article id="infoProducto">
        <h2 id="nombre-producto" class="titulo-2"><?= $producto->getTitulo() ?></h2>
        <span id="cat-producto"><?= $producto->getCategoria() ?></span>
        <p id="subtitulo-producto"><?= $producto->getSubtitulo() ?></p>
        <p id="descripcion-producto"><?= $producto->getDescripcion() ?></p>
        <p id="precio-producto"><?= $producto->getPrecio() ?></p>
        <button id="boton-agregar" class="boton add" data-id="2" data-val="50" data-cat="Remeras">Agregar al carrito</button>
      </article>
    </div>