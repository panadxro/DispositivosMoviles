<?php
$categorias = (new Categoria())->catalogo_completo();
$talles = (new Talle())->catalogo_completo();
$producto = (new Producto())->catalogo_x_id($_GET["id"]);
?>

<div class="row pt-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">EDITAR PRODUCTO</h1>
        <div class="row mb-5 d-flex align-items-center">
            <form class="row g-3" action="actions/edit_producto_acc.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                <div class="col-md-6 mb-3 d-flex flex-column gap-4">
                  <div class="d-flex flex-column gap-2">
                    <label class="form-label">Nombre de producto</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $producto->getNombre() ?>">
                  </div>
                  <div class="d-flex flex-column gap-2">
                    <label class="form-label">Alias</label>
                  <input class="form-control" type="text" name="alias" value="<?= $producto->getAlias() ?>">
                  </div>
                  <div class="d-flex flex-column gap-2">
                    <label class="form-label">Categoría</label>
                    <select class="form-select" name="categoria_id" id="categoria_id">
                      <option value="" selected disabled>Elija una opcion</option>
                      <?php foreach ($categorias as $categoria) { ?>
                        <option <?=$categoria->getId()== $producto->getCategoria_id() ? "selected" : "" ?> value="<?= $categoria->getId() ?>"><?= $categoria->getNombre() ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="d-flex flex-column gap-2">
                    <label class="form-label" for="">Precio</label>
                    <input class="form-control" type="number" name="precio" value="<?= $producto->getPrecio() ?>">
                  </div>
                    <div class="d-flex flex-column gap-2">
                      <label class="mt-2 d-flex form-label" for="">Talles Disponibles</label>
                      <div>
                        <?php foreach ($talles as $talle) { 
                          $talle_seleccionado = explode(",",$producto->getTalles());        
                        ?>
                        <div class="d-inline">
                            <input class="btn-check" type="checkbox" name="talles[]"
                                id="talle<?= $talle->getId() ?>"
                                <?= in_array( $talle->getId(), $talle_seleccionado) ? "checked" : ""  ?>
                                value="<?= $talle->getId() ?>"
                                >
                            <label class="btn" for="talle<?= $talle->getId() ?>">
                                <?= $talle->getNombre() ?>
                            </label>
                        </div>
                        <?php } ?>
                      </div>
                  </div>
                </div>
                
                <div class="col-md-6 mb-3 d-flex flex-column gap-2">
                  <div>
                    <label class="form-label" for="">Imagen</label>
                    <img class="img-fluid rounded shadow-sm d-block" src="../img/covers/<?= $producto->getImagen() ?>" alt="">
                    <input class="form-control" type="hidden" name="imagen_original" value="<?= $producto->getImagen() ?>">
                  </div>
                  <div>
                    <input class="form-control" type="file" name="imagen" >
                  </div>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label" for="">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="7"><?=$producto->getDescripcion()?></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Cargar</button>
            </form>
        </div>
    </div>
</div>
