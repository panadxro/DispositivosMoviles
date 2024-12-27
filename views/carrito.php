<?php
// Validar si el usuario está logueado
if (!isset($_SESSION['login']) || !isset($_SESSION['login']['id'])) {
  // Redirigir si no está logueado
  header("Location: index.php?sec=login");
  exit;
}
$miCarrito = new Carrito();
$items = ($miCarrito)->getCarrito();
?>
<div class="seccion-productos" id="pag-comprar">
<?= (new Alerta())->get_alertas() ?>
  <h1 class="mt-5 titulo-2" id="tit-categoria">Carrito de compras</h1>
  <?php if( count($items) ){ ?>
    <div class="sect-comprar" id="sect-comprar">
      <!-- Formulario unificado -->
      <form action="admin/actions/realizar_compra_acc.php" method="post" id="formularioCompraCompleto">
          <div id="formularioDatosPersonales">
              <fieldset>
                  <legend>Contacto</legend>
                  <div class="entrada">
                      <input name="email" placeholder="Email" id="email" type="email" required>
                      <label for="email">Email</label>
                  </div>
                  <div>
                      <input name="ofertas" id="ofertas" type="checkbox" value="1">
                      <label for="ofertas">Deseo recibir noticias y ofertas.</label>
                  </div>
              </fieldset>
              <fieldset>
                  <legend>Dirección de envío</legend>
                  <div class="entrada">
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
                      <label for="pais">País</label>
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
                      <input name="postal" placeholder="Código postal (opcional)" id="postal" type="text">
                      <label for="postal">Código postal (opcional)</label>
                  </div>
                  <div class="entrada">
                      <input name="telefono" placeholder="Teléfono" id="telefono" type="tel" required>
                      <label for="telefono">Teléfono</label>
                  </div>
              </fieldset>
              <div class="form-submit">
                  <button type="button" class="boton" id="irDatosPago">Continuar</button>
              </div>
          </div>

          <div id="formularioDatosPago" style="display: none;">
              <fieldset>
                  <legend>Método de pago</legend>
                  <div>
                      <input name="metodopago" id="credito" type="radio" value="credito" required>
                      <label for="credito">Tarjeta de crédito</label>
                      
                      <input name="metodopago" id="debito" type="radio" value="debito" required>
                      <label for="debito">Tarjeta de débito</label>
                  </div>
                  <div class="entrada">
                      <input name="tarjeta" id="tarjeta" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="xxxx xxxx xxxx xxxx" required>
                      <label for="tarjeta">Número de tarjeta</label>
                  </div>
                  <div class="entrada">
                      <input name="titular" placeholder="Nombre del titular" id="titular" type="text" required>
                      <label for="titular">Nombre del titular</label>
                  </div>
                  <div class="entrada">
                      <input name="vencimiento" id="vencimiento" type="date" required>
                      <label for="vencimiento">Fecha de vencimiento</label>
                  </div>
                  <div class="entrada">    
                      <input name="cvv" placeholder="CVV/CVC(123)" id="cvv" type="number" required>
                      <label for="cvv">CVV/CVC(123)</label>
                  </div>
              </fieldset>
              <div class="form-submit">
                  <button type="button" class="volver" id="volverDatosPersonales">Volver a información</button>
                  <input class="boton" value="Comprar" type="submit">
              </div>
          </div>
      </form>
      <aside>
        <section>
          <div class="cart-head">
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
                <img               
                  class="miniportada" 
                  src="assets/products/<?= str_replace([" ", "'", "&", "#039;", "amp;"], '', $item["producto"]) ?>/<?= $item["imagen"] ?>"
                  alt="<?= $item["producto"] ?>">
                <figcaption 
                  class="titulo-car"
                  >
                  <?= $item["producto"]; ?> - <?= $item["talle"]; ?>
                  <p> $<?= $item["precio"]; ?>
                    <span class="cantidad-prod">x<?= $item["cantidad"]; ?></span>
                  </p>
                </figcaption>
              </figure>
              <a class="del" href="admin/actions/remove_item_acc.php?id=<?= $item["id"] ?>" >Eliminar</a>
            </li>
          <?php } ?> 
          </ul>
          <article id="articleInfo" class="info">
            <p>TOTAL:<span class="icon" id="total-carrito">$<?= $miCarrito->getTotal() ?></span></p>
          </article>
        </section>
      </aside>   
  </div>
  <?php }else{ ?>
      <p>No hay productos en el carrito</p>
      <a href="index.php?sec=home" class="boton mb-3">Volver al inicio</a>
  <?php } ?>     
  </div>
</div>

<script>
// Obtener referencias a los elementos
const irDatosPago = document.getElementById("irDatosPago");
const formularioDatosPersonales = document.getElementById("formularioDatosPersonales");
const camposRequeridos = formularioDatosPersonales.querySelectorAll("[required]");

// Función para validar si todos los campos obligatorios están completos
const validarCampos = () => {
    let todosCompletos = true;

    camposRequeridos.forEach((campo) => {
        if (!campo.value.trim()) {
            todosCompletos = false;
        }
    });

    // Habilitar o deshabilitar el botón
    irDatosPago.disabled = !todosCompletos;
};

// Escuchar cambios en los campos obligatorios
camposRequeridos.forEach((campo) => {
    campo.addEventListener("input", validarCampos);
});

// Inicializar el estado del botón al cargar la página
validarCampos();

// Cambiar entre formularios
irDatosPago.addEventListener("click", () => {
    formularioDatosPersonales.style.display = "none";
    formularioDatosPago.style.display = "block";
});

const volverDatosPersonales = document.getElementById("volverDatosPersonales");
const formularioDatosPago = document.getElementById("formularioDatosPago");

volverDatosPersonales.addEventListener("click", () => {
    formularioDatosPago.style.display = "none";
    formularioDatosPersonales.style.display = "block";
});
</script>
<style>
  #irDatosPago:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}
</style>