<?php
$categoria = $_GET['cat'];
$productos = (new Producto())->filtrar_x_categoria($categoria);
?>

<section class="seccion-productos">
  <h2 class="titulo-2" id="tit-categoria"><?= $productos[0]->getCategoria() ?></h2>
  <div id="productos">
  <?php foreach ($productos as $producto) { ?>

    <article class="card">
      <a href="index.php?sec=detalle&id=<?=$producto->getId()?>">
        <figure><img src="<?= $producto->getImagen() ?>"></figure>
        <h3><?= $producto->getTitulo() ?></h3>
        <p><?= $producto->getSubtitulo() ?></p>
        <p class="price">$<?= $producto->getPrecio() ?></p>
      </a>
    </article>

  <?php } ?>
  </div>
</section>