<?php
    $id = $_GET['id'] ?? false;
    $categoria = (new Categoria())->get_x_id($id);
?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Editar artista</h1>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/edit_categoria_acc.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $categoria->getId() ?>">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $categoria->getNombre() ?>">
                </div>                
                <button class="btn btn-primary" type="submit">Editar</button>
            </form>
        </div>
    </div>
</div>
