<?php
$categorias = (new Categoria())->catalogo_completo();
$talles = (new Talle())->catalogo_completo();
?>

<div class="row pt-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">AGREGAR PRODUCTO</h1>
        <div class="row mb-5 d-flex justify-content-center align-items-center">
            <form class="row g-3" action="actions/add_producto_acc.php" method="post" enctype="multipart/form-data">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre de producto</label>
                    <input class="form-control" type="text" name="nombre" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Alias</label>
                    <input class="form-control" type="text" name="alias" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Categoría</label>
                    <select class="form-select" name="categoria_id" id="categoria_id" required>
                        <option value="" selected disabled>Elija una opcion</option>
                        <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria->getId() ?>"><?= $categoria->getNombre() ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3 flex-col">
                  <label class="form-label">Imágenes del producto (Solo formato png)</label>
                  <div class="contenedor-imagenes">
                      <?php for ($i = 0; $i < 5; $i++): ?>
                          <div class="imagen-placeholder" data-index="<?= $i ?>">
                              <img src="" alt="Preview" class="preview" style="display: none;">
                              <span class="texto-placeholder">+</span>
                              <input type="file" name="imagenes[]" class="input-imagen" accept="image/*">
                          </div>
                      <?php endfor; ?>
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="">Precio</label>
                    <input class="form-control" type="number" name="precio" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="mt-2 d-flex form-label" for="">Talles Disponibles</label>
                    <?php foreach ($talles as $talle) { ?>
                    <div class="d-inline">
                        <input class="btn-check" type="checkbox" name="talles[]"
                            id="talle<?= $talle->getId() ?>"
                            value="<?= $talle->getId() ?>"
                        >
                        <label class="btn" for="talle<?= $talle->getId() ?>">
                            <?= $talle->getNombre() ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label" for="">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="7" required></textarea>
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