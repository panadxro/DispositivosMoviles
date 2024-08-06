<?php
$miCarrito = new Carrito();
$items = ($miCarrito)->getCarrito();
?>

<div class="sect-comprar">
  <?php if( count($items) ){ ?>
        <div id="formularioDatosPersonales">
          <form class="inicio" action="index.php?sec=recibo" method=POST id="datosPersonalesForm">
            <fieldset>
              <legend>Contacto</legend>
              <div class="entrada">
                <input name="email" placeholder="Email" id="email" type="email" required>
                <label for="email">Email</label>
              </div>
              <div>
                <input name="check" id="ofertas" type="checkbox">
                <label for="ofertas">Deseo recibir noticias y ofertas.</label>
              </div>
            </fieldset>
            <fieldset>
              <legend>Dirección de envío</legend>
              <div class="pais">
                <select name="pais" id="pais" required>
                  <option value="">Elije un país</option>
                  <option value="Alemania">Alemania</option>
                  <option value="Argentina">Argentina</option>
                  <option value="Australia">Australia</option>
                  <option value="Brasil">Brasil</option>
                  <option value="Estados Unidos">Estados Unidos</option>
                  <option value="Francia">Francia</option>
                  <option value="Reino Unido">Reino Unido</option>
                  <option value="Rusia">Rusia</option>
                </select>
              </div>
              <div class="entrada">
                <input name="nombre" placeholder="Nombre" id="nombre" type="text" required>
                <label for="nombre">Nombre</label>
              </div>
              <div class="entrada">
                <input name="apellido" placeholder="Apellido" id="apellido" type="text" required>
                <label for="apellido">Apellido</label>
              </div>
              <div class="entrada">
                <input name="direccion" placeholder="Dirección" id="direccion" type="text" required>
                <label for="direccion">Dirección</label>
              </div>
              <div class="entrada">
                <input name="ciudad" placeholder="Ciudad" id="ciudad" type="text" required>
                <label for="ciudad">Ciudad</label>
              </div>
              <div class="entrada">
                <input name="postal" placeholder="Codigo postal (opcional)" id="postal" type="text">
                <label for="postal">Codigo postal (opcional)</label>
              </div>
              <div class="entrada">
                <input name="telefono" placeholder="Teléfono" id="telefono" type="number" required>
                <label for="telefono">Teléfono</label>
              </div>
            </fieldset>
            <div class="form-submit">
              <a href="index.php?sec=home" class="volver">Volver al inicio</a>
              <input class="boton" value="Realizar compra" type="submit">
            </div>
          </form>
        </div>

        <aside>
          <section id="pag-comprar">
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
                  <figcaption class="titulo-car"><?php echo $item["producto"]; ?><p> $<?php echo $item["precio"]; ?><span class="cantidad-prod">x<?php echo $item["cantidad"]; ?></span></p></figcaption>
                </figure>
                <button class="del" data-id="6" data-val="120" data-cat="Buzos">Eliminar</button>
              </li>
              <?php } ?> 

            </ul>

            <article id="articleInfo" class="info">
              <p>TOTAL:<span class="icon" id="total-carrito">$<?= $miCarrito->getTotal() ?></span></p>
            </article>
          </section>
        </aside>
      <?php }else{ ?>
        <h1 class="mt-5 text-center titulo-2" id="tit-categoria">Envios</h1>
        <div class="d-flex flex-column justify-content-center align-items-center gap-5">
          <p>No hay productos en el carrito</p>
          <a href="index.php?sec=home" class="boton mb-3">Volver al inicio</a>
        </div>
      <?php } ?>
      </div>