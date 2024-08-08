<?php
  $productos = ( new Producto() )->catalogo_completo();
?>
<div class="inicio">
  <article>
    <h2>Drop Dead <br> Estilo único, Calidad Intransigente</h2>
    <p>Combina originalidad, calidad y un toque de rebeldía. </p>
    <a href="index.php?sec=productos" class="boton">Explorar</a>
  </article>
  <figure>
    <img src="assets/icon/faviconDrop.png" title="Logo Dropdead Clothing" alt="Logo Dropdead Clothing">
  </figure>
</div>

<section class="nosotros">
  <h2 class="titulo-2">Descubre Dropdead</h2>
  <article>
    <p>Donde cada prenda es una declaración de audacia y autenticidad. Define tu estilo con la fusión única de moda y actitud que solo DropDead puede ofrecer.</p>
    <picture>
      <img src="assets/fondos/deadcell-md.png" title="Modelo Dead Cell de espaldas" alt="Modelo Dead Cell de espaldas">
    </picture>
  </article>
  <article>
    <picture>
      <source media="(max-width: 576px)" srcset="./assets/fondos/tnsh-md.png">
      <img src="assets/fondos/tnsh-md.png" title="Modelo TNSH de costado" alt="Modelo TNSH de costado">
    </picture>
    <p>Drop Dead es más que una marca de ropa; es una declaración de estilo. Fundada en la intersección de la moda alternativa y la estética gótica, Drop Dead ofrece prendas únicas y atrevidas para aquellos que buscan destacar en la multitud.</p>
  </article>
</section>

<section class="detalles">
  <h2 class="titulo-2">Nuestro impacto</h2>
  <p>Nos hemos unido a <a href="https://public.getgreenspark.com/1639580031124/drop-dead-clothing" target="_blank">Greenspark</a> para garantizar que <b>Drop Dead Clothing</b> tenga un impacto positivo en nuestro planeta y en su gente. ¡Echa un vistazo a nuestro impacto hasta ahora y únete a nuestro viaje!
  Nuestro impacto generado hasta ahora</p>
  <ul class="detalle-box">
    <li>
      <p id="botellas">87.690 <small>botellas de plástico rescatadas</small></p>          
    </li>
    <li>
      <p id="co2">8.797 <small>toneladas de CO2 compensadas</small></p>          
    </li>
    <li>
      <p id="arboles">40.663 <small>arboles plantados</small></p>
    </li>
  </ul>
  <div class="novedades">
    <figure id="carouselExampleCaptions" class="carousel slide" data-bs-touch="true" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 576px)" srcset="assets/fondos/sm-slider1.jpg">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider1.jpg">
              <img src="assets/fondos/md-slider1.jpg" alt="Banner con modelos historia de la marca">
            </picture>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider2.jpg">
              <img src="assets/fondos/md-slider2.jpg" alt="Banner con modelos el comienzo de la marca">
            </picture>
          </div>
          <div class="carousel-item active" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider3.jpg">
              <img src="assets/fondos/md-slider3.jpg" alt="Banner con modelos y su filosofia">
            </picture>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider4.jpg">
              <img src="assets/fondos/md-slider4.jpg" alt="Banner con modelos y su dilema">
            </picture>
          </div>
        </div>
    </figure>
    <figure>
      <iframe width="560" height="315" src="https://www.youtube.com/embed/W_03t-ddhAE?si=SMMggjVMrTgTi_4X" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </figure>
  </div>
</section>

<section class="sec-productos">
  <h2 class="titulo-2" id="tit-categoria">Productos</h2>
  <div id="productos">
  <?php foreach ($productos as $producto) { ?>
    <article class="card">
      <a href="producto.html?id=<?=$producto->getId()?>">
        <figure>
          <img src="../dropdead/img/covers/<?= $producto->getImagen() ?>" alt="Blade">
        </figure>
        <h3><?= $producto->getNombre() ?></h3>
        <p><?= $producto->getAlias() ?></p>
      </a>
    </article>
  <?php } ?>
  </div>
  <a href="index.php?sec=productos" class="boton">Ver más</a>
</section>

<section class="newsletter">
  <h2 class="titulo-2">Newsletter</h2>
  <p>Suscríbase a nuestra newsletter para recibir noticias exclusivas sobre nuestra próxima colección</p>
  <form class="form-newsletter" action="admin/actions/enviar_newsletter_acc.php" >
    <fieldset>
      <legend>Nombre formulario</legend>
      <div>
        <label for="nombre">Nombre y Apellido</label>
        <input placeholder="Nombre y Apellido" id="nombre" type="text">
      </div>
      <div>
        <label for="email">Email</label>
        <input placeholder="Email" id="email" type="email">
      </div>
      <div>
        <label for="tel">Teléfono</label>
        <input placeholder="Teléfono" id="tel" type="tel">
      </div>
      <div>
        <label for="comentario">Comentario</label>
        <textarea placeholder="Comentario" id="comentario"></textarea>
      </div>
    </fieldset>
    <div class="boton">
      <input value="Subscribirse" type="submit">
    </div>
  </form>
  <?= (new Alerta())->get_alertas() ?>
</section>