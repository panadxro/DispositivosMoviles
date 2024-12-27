<?php
$categorias = (new Categoria())->catalogo_completo();
$talles = (new Talle())->catalogo_completo();
$producto = (new Producto())->catalogo_x_id($_GET["id"]);
?>

<div class="row pt-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">EDITAR PRODUCTO</h1>
        <div class="row mb-5 d-flex justify-content-center align-items-center">
            <form class="row g-3" action="actions/edit_producto_acc.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $producto->getId() ?>">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre de producto</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $producto->getNombre() ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Alias</label>
                  <input class="form-control" type="text" name="alias" value="<?= $producto->getAlias() ?>">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Categoría</label>
                    <select class="form-select" name="categoria_id" id="categoria_id">
                      <option value="" selected disabled>Elija una opcion</option>
                      <?php foreach ($categorias as $categoria) { ?>
                        <option <?=$categoria->getId()== $producto->getCategoria_id() ? "selected" : "" ?> value="<?= $categoria->getId() ?>"><?= $categoria->getNombre() ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="">Imágenes del producto (Sólo formato png)</label>
                    <div class="contenedor-imagenes">
                        <?php 
                        $nombreProducto = str_replace(["'", "&", " "], "", $producto->getNombre());
                        for ($i = 1; $i <= 5; $i++): 
                            $rutaImagen = "../assets/products/$nombreProducto/{$nombreProducto}{$i}.png";
                        ?>
                            <div class="imagen-placeholder" data-index="<?= $i ?>">
                                <?php if (file_exists($rutaImagen)): ?>
                                    <img src="<?= $rutaImagen ?>" alt="Preview" class="preview" style="display: block;">
                                <?php else: ?>
                                    <img src="" alt="Preview" class="preview" style="display: none;">
                                <?php endif; ?>
                                <span class="texto-placeholder"><?= file_exists($rutaImagen) ? "Editar" : "+" ?></span>
                                <input type="file" name="imagenes[]" class="input-imagen" accept="image/*">
                                <input type="hidden" name="imagenes_existentes[]" value="<?= file_exists($rutaImagen) ? basename($rutaImagen) : "" ?>">
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="">Precio</label>
                    <input class="form-control" type="number" name="precio" value="<?= $producto->getPrecio() ?>">
                  </div>
                    <div class="col-md-6 mb-3">
                      <label class="mt-2 d-flex form-label" for="">Talles Disponibles</label>
                      <div>
                        <?php foreach ($talles as $talle) { 
                          $talle_seleccionado = explode(",",$producto->getTalles_id());        
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
                


                <div class="col-md-12 mb-3">
                    <label class="form-label" for="">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="7"><?=$producto->getDescripcion()?></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Cargar</button>
            </form>
        </div>
    </div>
</div>

<script>
  document.querySelectorAll('.imagen-placeholder').forEach((placeholder) => {
    const input = placeholder.querySelector('.input-imagen');
    const preview = placeholder.querySelector('.preview');
    const textoPlaceholder = placeholder.querySelector('.texto-placeholder');

    // Abrir el input al hacer clic en el placeholder
    placeholder.addEventListener('click', () => {
        input.click();
    });

    // Previsualizar la imagen cargada
    input.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                textoPlaceholder.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>

<style>
  .contenedor-imagenes {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.imagen-placeholder {
    width: 100px;
    height: 100px;
    background-color: #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    cursor: pointer;
    border: 1px dashed #ccc;
    overflow: hidden;
    border-radius: 5px;
}

.imagen-placeholder .texto-placeholder {
    font-size: 24px;
    color: #aaa;
}

.imagen-placeholder img.preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
}

.imagen-placeholder input.input-imagen {
    display: none;
}

</style>