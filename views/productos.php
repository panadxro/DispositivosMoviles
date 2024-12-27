<?php
    $productos = ( new Producto() )->catalogo_completo();
?>

<section class="seccion-productos mt-5">
  <h2 class="titulo-2" id="tit-categoria">PRODUCTOS</h2>
  <div class="mb-5" id="productos">
  <?php foreach ($productos as $producto) { ?>
    <article class="card">
      <a href="index.php?sec=detalle&id=<?=$producto->getId()?>">
        <figure>
          <img 
            src="assets/products/<?= str_replace([" ", "'", "&", "#039;", "amp;"], '', $producto->getNombre()) ?>/<?= $producto->getImagen() ?>"
            alt="<?= $producto->getNombre() ?>"
          >
        </figure>
        <h3><?= $producto->getNombre() ?></h3>
        <p><?= $producto->getAlias() ?></p>
      </a>
    </article>
  <?php } ?>
  </div>
</section>