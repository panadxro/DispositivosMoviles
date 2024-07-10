<?php

$productos = (new Producto())->catalogo_completo();

?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Administracion de Productos</h1>
        <div class="row mb-5 d-flex align-items-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Alias</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td> <img src="../img/covers/<?= $producto->getImagen() ?>" alt="Imagen del producto" class="img-fluid rounded shadow-sm"> </td>
                        <td><?= $producto->getNombre() ?> </td>
                        <td> <?= $producto->getAlias() ?> </td>
                        <td><?= $producto->getCategoria() ?></td>
                        <td><?= $producto->getPrecio() ?></td>
                        <td>
                            <a href="index.php?sec=edit_producto&id=<?= $producto->getId() ?>" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                            <a href="index.php?sec=delete_producto&id=<?= $producto->getId() ?>" class="d-block btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_producto" class="btn btn-primary mt-5">Agregar producto</a>

        </div>
    </div>
</div>
