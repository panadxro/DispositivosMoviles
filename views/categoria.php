<?php
$categoria = $_GET['cat'];
$productos = (new Producto())->catalogo_x_categoria($categoria);
?>
<div id="pag-categorias">
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
  
  <div class="modal fade" id="modal-publicidad" tabindex="-1" aria-labelledby="modal-publicidad" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <picture>
          <source media="(max-width: 576px)" srcset="./assets/fondos/banner-squeaky-clean.png">
          <source media="(max-width: 1024px)" srcset="./assets/fondos/banner-hollowfication.png">
          <img id="banner" src="./assets/fondos/banner-dead-cell.png" alt="Banner publicitario">
        </picture>
      </div>
    </div>
  </div>
</div>