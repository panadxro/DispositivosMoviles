<?php
    $id = $_GET['id'] ?? false;
    $usuario = (new Usuario())->catalogo_x_id($id);
?>

<div class="row pt-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">EDITAR USUARIO</h1>
        <div class="row mb-5 d-flex flex-column justify-content-center align-items-center">
            <form class="row g-3 w-50" action="actions/edit_usuario_acc.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $usuario->getId() ?>">
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label" for="email">Nombre de usuario</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $usuario->getEmail() ?>" id="email" disabled required>
                    <input class="form-control" type="hidden" name="email" value="<?= $usuario->getEmail() ?>" id="email" required>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label">Rol de usuario</label>
                    <div class="d-inline">
                      <input class="btn-check" type="radio" name="rol_id" id="usuario" value="usuario" <?= $usuario->getRoles() == "usuario" ? "checked" : "" ?>>
                      <label class="btn" for="usuario">Usuario</label>
                      <input class="btn-check" type="radio" name="rol_id" id="admin" <?= $usuario->getRoles() == "admin" ? "checked" : "" ?> value="admin">
                      <label class="btn" for="admin">Admin</label>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label" for="new_pass">Nueva contraseña</label>
                    <input class="form-control" type="password" name="new_pass" id="new_pass">
                </div>              
                <div class="d-flex align-items-center gap-3">
                    <label class="form-label" for="pass">Contraseña actual</label>
                    <input class="form-control" type="password" name="pass" id="pass" required>
                </div>                             
                <button class="btn btn-primary" type="submit">Aceptar</button>
                <?= (new Alerta())->get_alertas() ?>
            </form>
        </div>
    </div>
</div>
