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
      <source media="(max-width: 576px)" srcset="./assets/fondos/deadcell-md.png">
      <img src="assets/fondos/deadcell-lg.png" title="Modelo Dead Cell de espaldas" alt="Modelo Dead Cell de espaldas">
    </picture>
  </article>
  <article>
    <picture>
      <source media="(max-width: 576px)" srcset="./assets/fondos/tnsh-md.png">
      <img src="assets/fondos/tnsh-lg.png" title="Modelo TNSH de costado" alt="Modelo TNSH de costado">
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
              <img src="assets/fondos/lg-slider1.jpg" alt="Banner con modelos historia de la marca">
            </picture>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 576px)" srcset="assets/fondos/sm-slider2.jpg">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider2.jpg">
              <img src="assets/fondos/lg-slider2.jpg" alt="Banner con modelos el comienzo de la marca">
            </picture>
          </div>
          <div class="carousel-item active" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 576px)" srcset="assets/fondos/sm-slider3.jpg">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider3.jpg">
              <img src="assets/fondos/lg-slider3.jpg" alt="Banner con modelos y su filosofia">
            </picture>
          </div>
          <div class="carousel-item" data-bs-interval="5000">
            <picture class="d-block w-100">
              <source media="(max-width: 576px)" srcset="assets/fondos/sm-slider4.jpg">
              <source media="(max-width: 1024px)" srcset="assets/fondos/md-slider4.jpg">
              <img src="assets/fondos/lg-slider4.jpg" alt="Banner con modelos y su dilema">
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
    <article class="card">
      <a href="producto.html?id=8">
        <figure>
          <img src="assets/product/Blade/Blade1.png" alt="Blade">
        </figure>
        <h3>Blade</h3>
        <p>Necklace</p>
        <p class="price">$<span>35</span></p>
      </a>
      <button class="add boton" data-id="8" data-val="35" data-cat="Accesorio">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=13">
        <figure>
          <img src="assets/product/Hollowfication/Hollowfication1.png" alt="Hollowfication">
        </figure>
        <h3>Hollowfication</h3>
        <p>Washed Black Hoodie</p>
        <p class="price">$<span>120</span></p>
      </a>
      <button class="add boton" data-id="13" data-val="120" data-cat="Buzo">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=18">
        <figure>
          <img src="assets/product/JadoreHardcore/JadoreHardcore1.png" alt="J'adore Hardcore">
        </figure>
        <h3>J'adore Hardcore</h3>
        <p>2 in 1 Jacket</p>
        <p class="price">$<span>200</span></p>
      </a>
      <button class="add boton" data-id="18" data-val="200" data-cat="Campera">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=19">
        <figure>
          <img src="assets/product/Spiritual/Spiritual1.png" alt="Spiritual">
        </figure>
        <h3>Spiritual</h3>
        <p>Socks (Pack of 2)</p>
        <p class="price">$<span>20</span></p>
      </a>
      <button class="add boton" data-id="19" data-val="20" data-cat="Accesorio">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=17">
        <figure>
          <img src="assets/product/Violence/Violence1.png" alt="Violence">
        </figure>
        <h3>Violence</h3>
        <p>Elasticated Shorts</p>
        <p class="price">$<span>60</span></p>
      </a>
      <button class="add boton" data-id="20" data-val="60" data-cat="Pantalon">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=10">
        <figure>
          <img src="assets/product/Lure/Lure1.png" alt="Lure">
        </figure>
        <h3>Lure</h3>
        <p>Distressed Hoodie</p>
        <p class="price">$<span>120</span></p>
      </a>
      <button class="add boton" data-id="10" data-val="120" data-cat="Buzo">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=11">
        <figure>
          <img src="assets/product/Makeover/Makeover1.png" alt="Makeover">
        </figure>
        <h3>Makeover</h3>
        <p>Washed Black T-Shirt</p>
        <p class="price">$<span>50</span></p>
      </a>
      <button class="add boton" data-id="11" data-val="50" data-cat="Remera">Agregar al carrito</button>
    </article>
    <article class="card">
      <a href="producto.html?id=9">
        <figure>
          <img src="assets/product/Blessings/Blessings1.png" alt="Blessings">
        </figure>
        <h3>Blessings</h3>
        <p>Longsleeve</p>
        <p class="price">$<span>70</span></p>
      </a>
      <button class="add boton" data-id="9" data-val="70" data-cat="Accesorio">Agregar al carrito</button>
    </article>
  </div>
  <a href="categorias.html" class="boton">Ver más</a>
</section>

<section class="newsletter">
  <h2 class="titulo-2">Newsletter</h2>
  <p>Suscríbase a nuestra newsletter para recibir noticias exclusivas sobre nuestra próxima colección</p>
  <form class="form-newsletter" action="index.html" >
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
</section>