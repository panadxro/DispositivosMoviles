<?php
// require_once "class/producto.php";


// Detalle
$id = $_GET['id'];
$producto = (new Producto())->catalogo_x_id($id);
// $talles = (new Talle())->catalogo_completo();
// $talle_seleccionado = $producto->getTalles();
$talles = $producto->getTalles();
?>


<div class="detalle-producto">
      <div id="carouselExampleIndicators" class="carousel slide">
        <figure id="galeria-productos" class="carousel-inner">
<!-- Hay que cambiar la src despues /dropdead/dropdead/ -->
          <picture class="carousel-item active">
            <source media="(max-width: 1024px)" srcset="../dropdead/img/covers/<?= $producto->getImagen() ?>">
            <img src="../dropdead/img/covers/<?= $producto->getImagen() ?>" alt="<?= $producto->getNombre() ?>">
          </picture>
        </figure>
      </div>
      <article id="infoProducto">
        <h2 id="nombre-producto" class="titulo-2"><?= $producto->getNombre() ?></h2>
        <span id="cat-producto"><?= $producto->getCategoria() ?></span>
        <p id="subtitulo-producto"><?= $producto->getAlias() ?></p>
        <p id="descripcion-producto"><?= $producto->getDescripcion() ?></p>
        <p id="precio-producto">$<?= $producto->getPrecio() ?></p>
        <form action="admin/actions/add_item_acc.php" class="d-flex flex-column gap-3" method="get">
            <div class="col-md-12">
                <?php foreach ($talles as $talle) {     
                ?>
                <input class="btn-check" name="talle" id="<?= $talle->getId() ?>" type="radio" value="<?= $talle->getNombre() ?>" <?= $talles[0] == $talle ? "checked" : "" ?> required>
                <label class="btn" for="<?= $talle->getId() ?>"><?=$talle->getNombre() ?></label>
                <?php } ?>
            </div>
            <div class="col-2">
              <input class="form-control form-control-lg" type="number" name="cantidad" id="c" value="1">
            </div>
            <div class="col-12 mt-3">
            <?php if( isset($_SESSION["login"]) ){ ?>       
              <input id="boton-agregar" class="boton add" type="submit" value="Agregar al carrito">
            <?php }else{ ?>
              <a href="index.php?sec=login" class="add boton">Agregar al carrito</a>
            <?php } ?>
              <input type="hidden" name="id" value="<?= $producto->getId() ?>">
            </div>
        </form>
      <?= (new Alerta())->get_alertas() ?>
      </article>
    </div>