<?php
// include_once 'libraries/funciones.php';
$serieSeleccionada = $_GET['cat'];
//$comics = $productos[$serieSeleccionada];
$comics = (new Comic())->catalogo_x_personaje($serieSeleccionada);

// Categoria
?>

<section class="seccion-productos">
  <h2 class="titulo-2" id="tit-categoria"><?= $comics[0]->getCategoria() ?></h2>
  <div id="productos">
  <?php foreach ($comics as $comic) { ?>

    <article class="card">
      <a href="index.php?sec=detalle&id=<?=$comic->getId()?>">
        <figure><img src="<?= $comic->getImagen() ?>"></figure>
        <h3><?= $comic->getTitulo() ?></h3>
        <p><?= $comic->getSubtitulo() ?></p>
        <p class="price">$<?= $comic->getPrecio() ?></p>
        <button class="add boton" data-id="1" data-val="120" data-cat="Buzos">Agregar al carrito</button>
      </a>
    </article>

  <?php } ?>
  </div>
</section>