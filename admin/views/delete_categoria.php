<?php
$id = $_GET['id'] ?? false;
$categoria = (new Categoria())->get_x_id($id);
?>

<div class="row my-5 g-3">
    <h1 class="text-center mt-5 mb-5 fw-bold">¿Desea Eliminar Categoria?</h1>
    <div class="row d-flex flex-column justify-content-center align-items-center">
      <div class="col-12 w-50">
        <h2 class="fs-6 text-center">Nombre de categoría</h2>
        <p class="text-center"><?= $categoria->getNombre() ?></p>
        <a class="d-block btn btn-sm btn-warning mt-4" href="index.php?sec=admin_categorias">Cancelar</a>
        <a class="d-block btn btn-sm btn-danger mt-4" href="actions/delete_categoria_acc.php?id=<?= $categoria->getId() ?>">Eliminar</a>
      </div>
    </div>
</div>
