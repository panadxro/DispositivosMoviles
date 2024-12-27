<?php

$productos = (new Producto())->catalogo_completo();

?>

<div class="col pt-5">
    <h1 class="text-center mb-5 fw-bold">ADMINISTRACIÓN DE PRODUCTOS</h1>
    <div class="row mb-5 d-flex align-items-center">
        <a href="index.php?sec=add_producto" class="btn btn-primary mb-5">Agregar producto</a>
        <table class="table">
            <thead>
                <tr>
                    <th class="fw-bold w-25" scope="col">IMAGEN</th>
                    <th class="fw-bold w-25" scope="col">TITULO</th>
                    <th class="fw-bold w-25" scope="col">ALIAS</th>
                    <th class="fw-bold w-25" scope="col">CATEGORIA</th>
                    <th class="fw-bold w-25" scope="col">PRECIO</th>
                    <th class="fw-bold" scope="col">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td class="w-25"> <img class="object-fit-contain border rounded" src="../assets/products/<?= str_replace([" ", "'", "&", "#039;", "amp;"], '', $producto->getNombre()) ?>/<?= $producto->getImagen() ?>"
                    alt="<?= $producto->getNombre() ?>" class="img-fluid rounded shadow-sm"> </td>
                    <td class="d-flex align-items-center w-25"><?= $producto->getNombre() ?> </td>
                    <td class="d-flex align-items-center w-25"> <?= $producto->getAlias() ?> </td>
                    <td class="d-flex align-items-center w-25"><?= $producto->getCategoria() ?></td>
                    <td class="d-flex align-items-center w-25">$<?= $producto->getPrecio() ?></td>
                    <td>
                        <a href="index.php?sec=edit_producto&id=<?= $producto->getId() ?>" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                        <a href="index.php?sec=delete_producto&id=<?= $producto->getId() ?>" class="d-block btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
