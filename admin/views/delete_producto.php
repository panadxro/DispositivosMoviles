<?php
$id = $_GET['id'] ?? false;
$producto = (new Producto())->catalogo_x_id($id);
?>

<div class="row d-flex flex-column align-items-center my-5 g-3">
    <h1 class="text-center mt-5 mb-5 fw-bold">¿Desea Eliminar Producto?</h1>
    <div class="col-12 col-mb-6">
        <img class="img-fluid w-25 rounded shadow-sm d-block mx-auto mb-3"
            src="../img/covers/<?= $producto->getImagen() ?>" alt="">
    </div>
      <div class="col-6">
          <a class="d-block btn btn-sm btn-danger mt-2" href="actions/delete_producto_acc.php?id=<?= $producto->getId() ?>">Eliminar</a>
      </div>
      <div class="col-6">
          <a class="d-block btn btn-sm btn-warning mt-2" href="index.php?sec=dashboard">Cancelar</a>
      </div>

</div>
