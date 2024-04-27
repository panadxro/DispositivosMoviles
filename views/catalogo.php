<?php
    // include_once "libraries/funciones.php";

    // Catalogo
    $comics = ( new Comic() )->catalogo_completo();
    //$comics = catalogo_completo();
?>

<section class="seccion-productos">
  <h2 class="titulo-2" id="tit-categoria">PRODUCTOS</h2>
  <div id="productos">
  <?php foreach ($comics as $comic) { ?>

    <article class="card">
      <a href="index.php?sec=detalle&id=<?=$comic->getId()?>">
        <figure><img src="<?= $comic->getImagen() ?>"></figure>
        <h3><?= $comic->getTitulo() ?></h3>
        <p><?= $comic->getSubtitulo() ?></p>
        <p class="price">$<?= $comic->getPrecio() ?></p>
      </a>
      <button class="add boton" data-id="1" data-val="120" data-cat="Buzos">Agregar al carrito</button>
    </article>

  <?php } ?>
  </div>
</section>