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
                <div class="col mb-3">
                    <label class="form-label">Nombre</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $usuario->getEmail() ?>" required>
                </div>                
                <button class="btn btn-primary" type="submit">Aceptar</button>
            </form>
        </div>
    </div>
</div>
