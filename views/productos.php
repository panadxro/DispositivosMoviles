<?php
    $productos = ( new Producto() )->catalogo_completo();
?>

<section class="seccion-productos">
  <h2 class="titulo-2" id="tit-categoria">PRODUCTOS</h2>
  <div id="productos">
  <?php foreach ($productos as $producto) { ?>
<!-- Hay que cambiar la src despues /dropdead/dropdead/ -->
    <article class="card">
      <a href="index.php?sec=detalle&id=<?=$producto->getId()?>">
        <figure><img src="/dropdead/dropdead/img/covers/<?= $producto->getImagen() ?>"></figure>
        <h3><?= $producto->getNombre() ?></h3>
        <p><?= $producto->getAlias() ?></p>
        <p class="price">$<?= $producto->getPrecio() ?></p>
      </a>
    </article>

  <?php } ?>
  </div>
</section>