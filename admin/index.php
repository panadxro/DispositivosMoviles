<?php require_once '../functions/autoload.php';

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
      'titulo' => 'Eliminar Producto'
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
      'titulo' => 'Eliminar Categoría'
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
      'titulo' => 'Eliminar Talle'
    ]
];

$seccion = $_GET['sec'] ?? 'dashboard';
(new Autenticacion())->verify();

if (!array_key_exists($seccion, $secciones_validas)) {
    $vista = '404';
    $titulo = '404 - Página no encontrada';
} else {
    $vista = $seccion;
    $titulo = $secciones_validas[$seccion]['titulo'];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Tiendita de Comics :: <?= $titulo ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

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
      <h1><a class="a-logo" href="../index.php">DROPDEAD</a></h1>
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
          <li><a class="nav-link active" href="index.php?sec=dashboard">DASHBOARD</a></li>
          <li><a class="nav-link" href="index.php?sec=admin_productos">PRODUCTOS</a></li>
          <li><a class="nav-link" href="index.php?sec=admin_categorias">CATEGORIAS</a></li>
          <li><a class="nav-link" href="index.php?sec=admin_talles">TALLES</a></li>
          <li><a class="nav-link" href="actions/auth_logout.php">SALIR</a></li>
          <?php }else{ ?>
          <li><a class="nav-link" href="../index.php?sec=login">LOGIN</a></li>
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
