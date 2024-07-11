<?php

$talles = (new Talle())->catalogo_completo();

?>

<div class="col pt-5">
      <h1 class="text-center mb-5 fw-bold">ADMINISTRACIÓN DE TALLES</h1>
      <div class="row mb-5 d-flex align-items-center">
          <table class="table">
              <thead>
                  <tr>
                      <th class="fw-bold" scope="col">Nombre</th>
                      <th class="fw-bold" scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($talles as $talle) { ?>
                  <tr>
                      <td class="d-flex align-items-center fw-bold" w-100"><?= $talle->getNombre() ?> </td>
                      <td>
                          <a href="index.php?sec=edit_talle&id=<?= $talle->getId() ?>" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                          <a href="index.php?sec=delete_talle&id=<?= $talle->getId() ?>" class="d-block btn btn-sm btn-danger">Eliminar</a>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>

          <a href="index.php?sec=add_talle" class="btn btn-primary mt-5">Agregar Talle</a>

      </div>
  </div>
