<?php
require_once "./functions/autoload.php";

if (!isset($_SESSION["login"])) {
    header("Location: index.php?sec=login");
    exit();
}

$usuario_id = $_SESSION['login']['id'];
$compra_realizada = new Compra();
$compras= ($compra_realizada)->historial($usuario_id); 

$usuario = (new Usuario())->catalogo_x_id($_SESSION["login"]["id"]);
?>

<div class="seccion-productos mt-5 mb-5">
  <h1>PERFIL</h1>
  <?= (new Alerta())->get_alertas() ?>
  <div class="sect-comprar p-2 gap-4">
    <div class="p-3">
    <form class="row g-3 w-100" action="admin/actions/edit_mi_usuario_acc.php" method="post" enctype="multipart/form-data">
      <h2>Datos de usuario</h2>
                <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label">Nombre de usuario</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $usuario->getEmail() ?>" id="nombre" disabled required>
                    <input class="form-control" type="hidden" name="email" value="<?= $usuario->getEmail() ?>" id="email" required>
                </div>
                <?php if ($usuario->getRoles() === 'admin') { ?>
                    <div class="d-flex align-items-center gap-3">
                        <label class="form-label">Rol de usuario</label>
                        <div class="d-inline">
                            <input class="btn-check" type="radio" name="rol_id" id="usuario" value="usuario" <?= $usuario->getRoles() == "usuario" ? "checked" : "" ?>>
                            <label class="btn" for="usuario">Usuario</label>
                            <input class="btn-check" type="radio" name="rol_id" id="admin" value="admin" <?= $usuario->getRoles() == "admin" ? "checked" : "" ?>>
                            <label class="btn" for="admin">Admin</label>
                        </div>
                    </div>
                <?php } ?>  
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label" for="new_pass">Nueva contraseña</label>
                    <input class="form-control" type="password" name="new_pass" id="new_pass">
                </div>              
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label">Contraseña actual</label>
                    <input class="form-control" type="password" name="pass" required>
                </div>  
                <button class="btn btn-primary" type="submit">Guardar</button>
            </form>
          </div>
          <?php if( $compras ){ ?>
            <aside>
              <h2>Historial</h2>
              <ul id="lista-carrito">
              <?php foreach($compras as $compra) {?>
                <li class="compra-producto">
                  <figure class="descrip-car">
                    <img class="miniportada" src="../dropdead/img/covers/<?= $compra["imagen"]; ?>" alt="<?= $compra["producto"]; ?>">
                    <figcaption class="titulo-car"><?= $compra["producto"]; ?> - <?= $compra["talle"]; ?><p> $<?= $compra["precio"]; ?><span class="cantidad-prod">x<?= $compra["cantidad"]; ?></span></p></figcaption>
                  </figure>
                </li>
              <?php } ?> 
              </ul>
          </aside>
          <?php } ?>
  </div>
  <div class="d-flex gap-4">
  <?php if( $usuario->getRoles() != "usuario" ){ ?>
    <a class="boton" href="admin/index.php?sec=dashboard">Panel de control</a>
  <?php } ?>  
    <a class="boton" href="admin/actions/auth_logout.php">Cerra Sesión</a>
  </div>
</div>