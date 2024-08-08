<?php
$categoria = $_GET['cat'];
$productos = (new Producto())->catalogo_x_categoria($categoria);
?>

<section class="seccion-productos mt-5">
  <h2 class="titulo-2" id="tit-categoria"><?= $productos[0]->getCategoria() ?></h2>
  <div class="mb-5" id="productos">
    <?php foreach ($productos as $producto) { ?>
      <!-- Hay que cambiar la src despues /dropdead/dropdead/ -->
    <article class="card">
      <a href="index.php?sec=detalle&id=<?=$producto->getId()?>">
        <figure><img src="../dropdead/img/covers/<?= $producto->getImagen() ?>"></figure>
        <h3><?= $producto->getNombre() ?></h3>
        <p><?= $producto->getAlias() ?></p>
      </a>
    </article>

  <?php } ?>
  </div>
</section>