<?php 
  $categorias = (new Categoria())->catalogo_completo();
  // $usuario = (new Usuario())
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
      <li><a class="nav-link" href="admin/actions/auth_logout.php">SALIR</a></li>
      <?php }else{ ?>
      <li><a class="nav-link" href="index.php?sec=login">LOGIN</a></li>
      <?php } ?>                              
    </ul>
  </nav>
  <a 
    class="icon a-cart" 
    href="index.php?sec=carrito"
    >
    <small>Carrito</small>
  </a>
</header>