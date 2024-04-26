<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">La Tiendita de Comics</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=home"> <?= $_GET["sec"] == "home" ? "<b>Home</b>" : "home" ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_GET["sec"] == "quienes_somos" ? "active" : "" ?>" href="index.php?sec=quienes_somos"><?= $_GET["sec"] == "quienes_somos" ? "<b>¿Quienes Somos?</b>" : "¿Quienes Somos?" ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=todosLosComics">Catalogo</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=comics&serie=iron-man">Iron Man</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=comics&serie=batman">Batman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=comics&serie=wonder-woman">Wonder Woman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?sec=envios">Envios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->
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
      <h1><a class="a-logo" href="index.html">DROPDEAD</a></h1>
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
          <li><a class="nav-link active" href="index.php?sec=home"><?= $_GET["sec"] == "home" ? "<b>Home</b>" : "home" ?></a></li>
          <li class="dropdown">
            <a class="nav-link" data-bs-toggle="collapse" href="#dropdown-menu" role="button" aria-expanded="false" aria-controls="dropdown-menu">CATEGORIAS</a>
            <ul class="collapse" id="dropdown-menu">
              <li><a href="categorias.html">TODO</a></li>
              <li><a href="categorias.html?cat=Remeras">REMERAS</a></li>
              <li><a href="categorias.html?cat=Buzos">BUZOS</a></li>
              <li><a href="categorias.html?cat=Camperas">CAMPERAS</a></li>
              <li><a href="categorias.html?cat=Pantalones">PANTALONES</a></li>
              <li><a href="categorias.html?cat=Accesorios">ACCESORIOS</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href="comprar.html">COMPRAR</a></li>
        </ul>
      </nav>
      <button 
        class="icon a-cart" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#carritoDesplegable" 
        aria-controls="carritoDesplegable"
        >
        <small>Carrito</small>
        <span class="badge bg-danger cantidades-carrito">0</span>
      </button>
      <aside class="offcanvas offcanvas-end carrito-section" tabindex="-1" id="carritoDesplegable" aria-labelledby="carritoDesplegable">
        <div class="cart-head">
          <button
           type="button"
           class="btn-close"
           data-bs-dismiss="offcanvas"
           aria-label="Close"><small>Cerrar carrito</small></button>
          <h2>CARRITO</h2>
          <button id="reset"><small class="d-lg-none">Vaciar carrito</small>
            <span class="badge bg-danger cantidades-carrito">0</span>
          </button>
        </div>
        <ul id="lista-carrito">
        </ul>
        <article class="info">
          <p>TOTAL:<span class="icon" id="total-carrito">Total</span></p>
          <a class="boton" id="botonCompra" href="comprar.html">Comprar</a>
        </article>
      </aside>
    </header>