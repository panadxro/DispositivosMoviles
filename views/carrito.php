<?php
// echo "<pre>";
// print_r($_SESSION["carrito"]);
// echo "</pre>";
$miCarrito = new Carrito();
$items = ($miCarrito)->getCarrito();
?>


<div class="seccion-productos">
  <h1 class="mt-5 titulo-2" id="tit-categoria">Carrito de compras</h1>
    <?= (new Alerta())->get_alertas() ?>
    <?php if( count($items) ){ ?>
      <aside>
          <section>
            <div class="cart-head d-none">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              <h2>CARRITO</h2>
              <button id="reset"><small>Vaciar carrito</small>
                <span class="badge bg-danger cantidades-carrito">0</span>
              </button>
            </div>
            <ul id="lista-carrito">
            <?php foreach( $items as $key => $item ) {?>
              <li class="item-producto">
                <figure class="descrip-car">
                  <img class="miniportada" src="../dropdead/img/covers/<?php echo $item["imagen"]; ?>" alt="<?php echo $item["producto"]; ?>">
                  <figcaption class="titulo-car"><?php echo $item["producto"]; ?> - <?php echo $item["talle"]; ?><p> $<?php echo $item["precio"]; ?><span class="cantidad-prod">x<?php echo $item["cantidad"]; ?></span></p></figcaption>
                </figure>
                <a class="del" href="admin/actions/remove_item_acc.php?id=<?= $item["id"] ?>" >Eliminar</a>
              </li>
              <?php } ?> 

            </ul>

            <article id="articleInfo" class="info">
              <p>TOTAL:<span class="icon" id="total-carrito">$<?= $miCarrito->getTotal() ?></span></p>
              <a href="index.php?sec=envios" id="botonCompra" class="boton">Comprar</a>
            </article>
            <div class="form-submit">
              <a href="index.php?sec=home" class="volver">Volver al inicio</a>
              <a class="boton" href="admin/actions/vaciar_carrito_acc.php">Vaciar</a>
            </div>
          </section>
        </aside>
    
    <?php }else{ ?>
        <p>No hay productos en el carrito</p>
        <a href="index.php?sec=home" class="boton mb-3">Volver al inicio</a>
    <?php } ?>
</div>
