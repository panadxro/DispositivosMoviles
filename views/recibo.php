<?php
$usuario_id = $_SESSION['login']['id'];
$compra_realizada = new Compra();
$compras= ($compra_realizada)->historial($usuario_id); 
?>
<main id="pag-comprobante">
      <div id="datosPersonales">
        <h1>¡Gracias por tu compra!</h1>
        <table>
          <tr>
            <td>Contacto</td>
            <td><?= $_SESSION["datos_comprador"][$usuario_id]["email"] ?></td>
            <td><button class="volver" type="button">Modificar</button></td>
          </tr>
          <tr>
            <td>Dirección</td>
            <td id="tabla-direccion"><?= $_SESSION["datos_comprador"][$usuario_id]["direccion"] ?></td>
            <td><button class="volver" type="button">Modificar</button></td>
          </tr>
        </table>
      </div>
      <aside>
        <div>
          <div class="cart-head">
            <button id="reset"><small>Vaciar carrito</small>
              <span class="badge bg-danger cantidades-carrito">0</span>
            </button>
          </div>
          <ul id="lista-carrito">
          <?php foreach($compras as $compra) {?>
            <li class="compra-producto">
              <figure class="descrip-car">
                <img class="miniportada" src="../dropdead/img/covers/<?= $compra["imagen"]; ?>" alt="<?= $compra["producto"]; ?>">
                <figcaption class="titulo-car"><?= $compra["producto"]; ?><p> $<?= $compra["precio"]; ?><span class="cantidad-prod">x<?= $compra["cantidad"]; ?></span></p></figcaption>
              </figure>
              <button class="del" data-id="6" data-val="120" data-cat="Buzos">Eliminar</button>
            </li>
          <?php } ?> 
          </ul>
          <article id="articleInfo" class="info">
          <p>TOTAL:<span class="icon" id="total-carrito">$<?= $compra_realizada->getTotal($usuario_id) ?></span></p>
            <a href="index.php?sec=home" id="botonCompra" class="boton">Volver al inicio</a>
          </article>
        </div>
      </aside>

      <div class="modal fade" id="modalAutor" tabindex="-1" aria-labelledby="modalAutor" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body">
              <article class="datosAutor">
                <h3>PANADERO LUCAS</h3>
                <a class="link-correo" href="mailto:lucasn.panadero@gmail.com">Contactame por correo</a>
                <p>Final de Programación I e Interacción con Dispositivos Móviles</p>
                <p>Programación y Diseño Web DWT2AP 2024</p>
                <ul>
                  <li><a href="https://www.linkedin.com/in/panadxro" target="_blank" class="icon a-linkedin"><small>Linkedin</small></a></li>
                  <li><a href="https://github.com/panadxro" target="_blank" class="icon a-github"><small>Github</small></a></li>
                  <li><a href="https://www.behance.net/panadxro" target="_blank" class="icon a-behance"><small>Behance</small></a></li>
                </ul>
              </article>
              <figure>
                <img title="Lucas Panadero" src="assets/fondos/profile.jpg" alt="Foto de perfil de Lucas Panadero">
              </figure>
            </div>
            <div class="modal-footer">
              <button type="button" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </main>
