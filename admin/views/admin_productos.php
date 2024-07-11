<?php

$productos = (new Producto())->catalogo_completo();

?>

<div class="col pt-5">
    <h1 class="text-center mb-5 fw-bold">Administracion de Productos</h1>
    <div class="row mb-5 d-flex align-items-center">
        <table class="table">
            <thead>
                <tr>
                    <th class="w-25" scope="col">Imagen</th>
                    <th class="w-25" scope="col">Titulo</th>
                    <th class="w-25" scope="col">Alias</th>
                    <th class="w-25" scope="col">Categoria</th>
                    <th class="w-25" scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td class="w-25"> <img class="object-fit-contain border rounded" src="../img/covers/<?= $producto->getImagen() ?>" alt="Imagen del producto" class="img-fluid rounded shadow-sm"> </td>
                    <td class="w-25"><?= $producto->getNombre() ?> </td>
                    <td class="w-25"> <?= $producto->getAlias() ?> </td>
                    <td class="w-25"><?= $producto->getCategoria() ?></td>
                    <td class="w-25"><?= $producto->getPrecio() ?></td>
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
