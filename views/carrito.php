<?php
// echo "<pre>";
// print_r($_SESSION["carrito"]);
// echo "</pre>";
$miCarrito = new Carrito();
$items = ($miCarrito)->getCarrito();
?>


<div class="seccion-productos">
  <h1 class="mt-5 titulo-2" id="tit-categoria">Carrito de compras</h1>
    <?= (new Alerta())->get_alertas() ?>
    <?php if( count($items) ){ ?>
    <form class="container-sm mb-5" action="admin/actions/update_carrito_acc.php" method="get">
        <table>
            <thead>
                <tr>
                    <th class="w-25" scope="col" >Imagen</th>
                    <th class="text-center w-100" scope="col">Datos del producto</th>
                    <th scope="col" >Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $items as $key => $item ) {?>
                    <tr>
                        <td class="w-25"><img class="img-fluid rounded shadow-sm" src="../dropdead/img/covers/<?php echo $item["imagen"]; ?>" alt="<?php echo $item["producto"]; ?>" width="50"></td>
                        <td class="text-center w-100 align-middle d-flex flex-column justify-content-center gap-2">
                            <p class="h5">Nombre: <?php echo $item["producto"]; ?></p>
                            <input type="number" value="<?php echo $item["cantidad"]; ?>" name="c[<?= $key ?>]" class="text-center form-control">
                            <p class="h5 py-3">Talle: <?php echo $item["talle"]; ?>
                            <p class="h5 py-3">Precio: $<?php echo $item["precio"]; ?>
                            <p class="h5 py-3">Subtotal: $<?php echo $item["precio"] * $item["cantidad"]; ?> </p>
                        </td>
                        <td class="text-end align-middle">
                            <a class="btn btn-danger" href="admin/actions/remove_item_acc.php?id=<?= $key ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?> 
                <tr>
                    <td class="w-25 text-end">
                        <h2 class="h5 py-3">Total: </h2>
                    </td>
                    <td>
                        <p class="h5 py-3"><?= $miCarrito->getTotal() ?></p>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 d-flex justify-content-center gap-2">
            <a class="btn btn-warning" href="index.php?sec=productos">Volver</a>
            <input type="submit" value="Actualizar" class="btn btn-primary">
            <a class="btn btn-danger"  href="admin/actions/vaciar_carrito_acc.php">Vaciar</a>
            <a class="btn btn-success"  href="index.php?sec=envios">Comprar</a>
        </div>
    </form>
    <?php }else{ ?>
        <p>No hay productos en el carrito</p>
        <a class="mb-4 btn btn-warning" href="index.php?sec=productos">Seguir Comprando</a>
    <?php } ?>
</div>
