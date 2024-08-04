<?php
$id = $_GET['id'] ?? false;
$usuario = (new Usuario())->catalogo_x_id($id);
?>

<div class="row my-5 g-3">
    <h1 class="text-center mt-5 mb-5 fw-bold">¿Desea Eliminar Usuario <?= $usuario->getEmail() ?>?</h1>
    <div class="row d-flex flex-column justify-content-center align-items-center">
      <div class="col-12 w-50">
        <a class="d-block btn btn-sm btn-warning mt-4" href="index.php?sec=admin_usuarios">Cancelar</a>
        <a class="d-block btn btn-sm btn-danger mt-4" href="actions/delete_usuario_acc.php?id=<?= $usuario->getId() ?>">Eliminar</a>
      </div>
    </div>
</div>