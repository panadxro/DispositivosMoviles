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
      <h1><a class="a-logo" href="index.php">DROPDEAD</a></h1>
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
          <li><a class="nav-link active" href="index.php?sec=home">INICIO</a></li>
          <li class="dropdown">
            <a class="nav-link" data-bs-toggle="collapse" 
            href="#dropdown-categoria" role="button" aria-expanded="false" aria-controls="dropdown-categoria">CATEGORIAS</a>
            <ul class="collapse" id="dropdown-categoria">
              <li><a href="index.php?sec=catalogo">TODO</a></li>
              <li><a href="index.php?sec=categoria&cat=Remeras">REMERAS</a></li>
              <li><a href="index.php?sec=categoria&cat=Buzos">BUZOS</a></li>
              <li><a href="index.php?sec=categoria&cat=Camperas">CAMPERAS</a></li>
              <li><a href="index.php?sec=categoria&cat=Pantalones">PANTALONES</a></li>
              <li><a href="index.php?sec=categoria&cat=Accesorios">ACCESORIOS</a></li>
            </ul>
          </li>
          <li><a class="nav-link" href="index.php?sec=envios">COMPRAR</a></li>
          <li class="dropdown">
            <a class="nav-link" data-bs-toggle="collapse" 
            href="#dropdown-cuenta" role="button" aria-expanded="false" aria-controls="dropdown-cuenta">CUENTA</a>
            <ul class="collapse" id="dropdown-cuenta">
              <?php if( isset($_SESSION["login"]) ){ ?>       
              <li><a href="admin/actions/auth_logout.php">SALIR</a></li>
              <?php }else{ ?>
              <li><a href="index.php?sec=login">LOGIN</a></li>
              <?php } ?>                              
            </ul>
          </li>
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
    </header>