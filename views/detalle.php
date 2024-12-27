<?php
// require_once "class/producto.php";


// Detalle
$id = $_GET['id'];
$producto = (new Producto())->catalogo_x_id($id);
// $talles = (new Talle())->catalogo_completo();
// $talle_seleccionado = $producto->getTalles();
$talles = $producto->getTalles();
$nombreProducto = str_replace([" ", "'", "&", "#039;", "amp;"], '', $producto->getNombre())
?>


<div class="detalle-producto">
  <div id="carouselExampleIndicators" class="carousel slide">
        <figure id="galeria-productos" class="carousel-inner">
          <picture class="carousel-item active"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>1.png"
          alt="<?= $producto->getNombre() ?>"></picture>
          <picture class="carousel-item"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>2.png"
          alt="<?= $producto->getNombre() ?>"></picture>
          <picture class="carousel-item"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>3.png"
          alt="<?= $producto->getNombre() ?>"></picture>
          <picture class="carousel-item"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>4.png"
          alt="<?= $producto->getNombre() ?>"></picture>
          <picture class="carousel-item"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>5.png"
          alt="<?= $producto->getNombre() ?>"></picture>
        </figure>
        <ul id="indicador-productos" class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>1.png"
          alt="<?= $producto->getNombre() ?>"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>2.png"
          alt="<?= $producto->getNombre() ?>"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>3.png"
          alt="<?= $producto->getNombre() ?>"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>4.png"
          alt="<?= $producto->getNombre() ?>"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"><img src="assets/products/<?= $nombreProducto ?>/<?= $nombreProducto ?>5.png"
          alt="<?= $producto->getNombre() ?>"></li>
        </ul>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
<!--       <div id="carouselExampleIndicators" class="carousel slide">
        <figure id="galeria-productos" class="carousel-inner">
          <picture class="carousel-item active">
            <source media="(max-width: 1024px)" srcset="../dropdead/img/covers/">
            <img src="../dropdead/img/covers/" alt="">
          </picture>
        </figure>
      </div> -->
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