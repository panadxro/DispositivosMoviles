<?php 
  $categorias = (new Categoria())->catalogo_completo();
  if (isset($_SESSION['login']) || isset($_SESSION['login']['id'])) {
    $miCarrito = new Carrito();
    $items = ($miCarrito)->getCarrito();
  }
?>

<header class="navt">
  <button 
    class="icon a-burger" 
    type="button" 
    data-bs-toggle="offcanvas" 
    data-bs-target="#navDesplegable" 
    aria-controls="navDesplegable"
    >
    <small>Abrir navegador</small>
  </button>
  <h1><a class="a-logo" href="index.php?sec=home">DROPDEAD</a></h1>
  <nav 
    class="nav-list offcanvas-start" 
    id="navDesplegable" 
    tabindex="-1" 
    aria-labelledby="navDesplegable"
    >
    <div class="offcanvas-header">
      <h2 class="offcanvas-title a-logo" 
      id="offcanvasNavbarLabel">DropDead</h2>
      <button 
        class="btn-close shadow-none" 
        data-bs-dismiss="offcanvas" 
        data-bs-target="#navDesplegable"
        type="button" 
        aria-label="Close"
        >
        <small>Cerrar navegador</small>
      </button>
    </div>
    <ul class="ul-list nav-underline" >
      <li><a class="nav-link <?= $_GET["sec"] == "home" ? "active" : "" ?>" href="index.php?sec=home">INICIO</a></li>
      <li class="dropdown">
        <a class="nav-link <?= $_GET["sec"] == "productos" ? "active" : "" ?>" data-bs-toggle="collapse" 
        href="#dropdown-menu" role="button" aria-expanded="false" aria-controls="dropdown-menu">CATEGORIAS</a>
        <ul class="collapse" id="dropdown-menu">
          <li><a href="index.php?sec=productos">Todo</a></li>
        <?php foreach ($categorias as $categoria) { ?>
          <li><a href="index.php?sec=categoria&cat=<?= $categoria->getId() ?>"><?= $categoria->getNombre() ?></a></li>
        <?php } ?>
        </ul>
      </li>
      <?php if( isset($_SESSION["login"]) ){ ?>
      <li><a class="nav-link <?= $_GET["sec"] == "perfil" ? "active" : "" ?>" href="index.php?sec=perfil">PERFIL</a></li>       
      <?php }else{ ?>
      <li><a class="nav-link" href="index.php?sec=login">LOGIN</a></li>
      <?php } ?>                              
    </ul>
  </nav>

  <?php if( isset($_SESSION["login"]) ){ ?>       
  <!-- <a class="icon a-cart" href="index.php?sec=carrito"> -->
  <button 
    class="icon a-cart" 
    type="button" 
    data-bs-toggle="offcanvas" 
    data-bs-target="#carritoDesplegable" 
    aria-controls="carritoDesplegable"
    >
    <small>Carrito</small>
  </button>
  <aside class="offcanvas offcanvas-end carrito-section" tabindex="-1" id="carritoDesplegable" aria-labelledby="carritoDesplegable">
    <div class="cart-head">
      <button
        type="button"
        class="btn-close"
        data-bs-dismiss="offcanvas"
        aria-label="Close"><small>Cerrar carrito</small></button>
      <h2>CARRITO</h2>
      <form action="admin\actions\vaciar_carrito_acc.php" method="post">
        <button id="reset" type="submit"><small class="d-lg-none">Vaciar carrito</small></button>
      </form>
    </div>
    <ul id="lista-carrito">
    <?php if( count($items) ){ ?>
      
      <?php foreach( $items as $key => $item ) {?>
        <li class="item-producto">
          <figure class="descrip-car">
            <img 
              class="miniportada" 
              src="assets/products/<?= str_replace([" ", "'", "&", "#039;", "amp;"], '', $item["producto"]) ?>/<?= $item["imagen"] ?>"
              alt="<?= $item["producto"] ?>"
              >
            <figcaption 
              class="titulo-car"
              >
              <?= $item["producto"]; ?> - <?= $item["talle"]; ?>
              <p> $<?= $item["precio"]; ?>
                <span class="cantidad-prod">x<?= $item["cantidad"]; ?></span>
              </p>
            </figcaption>
          </figure>
        </li>
        <?php } ?> 

      <?php }else{ ?>
      <li class="no-productos">No hay elementos en el carrito</li>
    <?php } ?>     
    </ul>
    <article class="info">
      <p>TOTAL:<span class="icon" id="total-carrito">$<?= $miCarrito->getTotal() ?></span></p>
      <?php if( count($items) ){ ?>
      <a class="boton" id="botonCompra" href="index.php?sec=carrito">Checkout</a>
      <?php }else{ ?>
      <a class="boton desabilitado" id="botonCompra">Comprar</a>      
      <?php } ?> 
    </article>
  </aside>
  <?php }else{ ?>
  <a class="icon a-cart" href="index.php?sec=login">
    <small>Carrito</small>
  </a>
  <?php } ?>
</header>