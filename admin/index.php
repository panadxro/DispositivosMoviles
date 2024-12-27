<?php
require_once '../functions/autoload.php';

$auth = new Autenticacion();

$secciones_validas = [
    'dashboard' => [
        'titulo' => 'Panel de control',
    ],
    'admin_productos' => [
        'titulo' => 'Administración de Productos',
    ],
    'add_producto' => [
        'titulo' => 'Agregar Producto',
    ],
    'edit_producto' => [
        'titulo' => 'Editar Producto',
    ],
    'delete_producto' => [
        'titulo' => 'Eliminar Producto',
    ],
    'admin_categorias' => [
        'titulo' => 'Administración de Categorías',
    ],
    'add_categoria' => [
        'titulo' => 'Agregar Categoría',
    ],
    'edit_categoria' => [
        'titulo' => 'Editar Categoría',
    ],
    'delete_categoria' => [
        'titulo' => 'Eliminar Categoría',
    ],
    'admin_talles' => [
        'titulo' => 'Administración de Talles',
    ],
    'add_talle' => [
        'titulo' => 'Agregar Talle',
    ],
    'edit_talle' => [
        'titulo' => 'Editar Talle',
    ],
    'delete_talle' => [
        'titulo' => 'Eliminar Talle',
    ],
    'admin_usuarios' => [
        'titulo' => 'Administración de Usuarios',
    ],
    'add_usuario' => [
        'titulo' => 'Agregar Usuario',
    ],
    'edit_usuario' => [
        'titulo' => 'Editar Usuario',
    ],
    'delete_usuario' => [
        'titulo' => 'Eliminar Usuario',
    ],
];

$seccion = $_GET['sec'] ?? 'dashboard';

// Verificar si el usuario está autenticado
$auth->verify();

// Verificar si el usuario es administrador
if (!$auth->isAdmin()) {
    $vista = '404';
    $titulo = '404 - Página no encontrada';
} else {
    if (!array_key_exists($seccion, $secciones_validas)) {
        $vista = '404';
        $titulo = '404 - Página no encontrada';
    } else {
        $vista = $seccion;
        $titulo = $secciones_validas[$seccion]['titulo'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?> | DROPDEAD</title>
    <link rel="shortcut icon" href="../assets/icon/faviconDrop.png">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
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
      <h1><a class="a-logo" href="../index.php?sec=home">DROPDEAD</a></h1>
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
        <?php if( isset($_SESSION["login"]) ) { ?>
          <li><a class="nav-link <?= $_GET["sec"] == "dashboard" ? "active" : "" ?>" href="index.php?sec=dashboard">DASHBOARD</a></li>
          <li><a class="nav-link <?= $_GET["sec"] == "admin_productos" ? "active" : "" ?>" href="index.php?sec=admin_productos">PRODUCTOS</a></li>
          <li><a class="nav-link <?= $_GET["sec"] == "admin_categorias" ? "active" : "" ?>" href="index.php?sec=admin_categorias">CATEGORIAS</a></li>
          <li><a class="nav-link <?= $_GET["sec"] == "admin_talles" ? "active" : "" ?>" href="index.php?sec=admin_talles">TALLES</a></li>
          <li><a class="nav-link <?= $_GET["sec"] == "admin_usuarios" ? "active" : "" ?>" href="index.php?sec=admin_usuarios">USUARIOS</a></li>
          <li><a class="nav-link" href="actions/auth_logout.php">SALIR</a></li>
          <?php }else{ ?>
          <li><a class="nav-link <?= $_GET["sec"] == "login" ? "active" : "" ?>" href="../index.php?sec=login">LOGIN</a></li>
          <?php } ?>                              
        </ul>
      </nav>
    </header>
    
    <main class="container mt-5">
        <?php require file_exists("views/$vista.php") ? "views/$vista.php" : 'views/404.php'; ?>

    </main>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>
