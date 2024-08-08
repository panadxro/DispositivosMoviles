<?php

$usuarios = (new Usuario())->catalogo_completo();
$miCompra = new Compra();

?>

<div class="col pt-5">
      <h1 class="text-center mb-5 fw-bold">ADMINISTRACIÓN DE USUARIOS</h1>
      <div class="row mb-5 d-flex align-items-center">
          <table class="table">
              <thead>
                  <tr>
                      <th class="fw-bold" scope="col">Nombre</th>
                      <th class="fw-bold" scope="col">Compras realizadas</th>
                      <th class="fw-bold" scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($usuarios as $usuario) { ?>
                  <tr>
                      <td class="d-flex align-items-center fw-bold "><?= $usuario->getEmail() ?> </td>
                      <td>
                      <?php
                      $items = ($miCompra)->historial($usuario->getId());
                      foreach ($items as $item) { ?>
                        <span id="cat-producto"><?= $item["producto"] ?> - <?= $item["talle"] ?> x <?= $item["cantidad"] ?></span>
                      <?php } ?>
                      </td>
                      <td>
                          <a href="index.php?sec=edit_usuario&id=<?= $usuario->getId() ?>" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                          <a href="index.php?sec=delete_usuario&id=<?= $usuario->getId() ?>" class="d-block btn btn-sm btn-danger">Eliminar</a>
                      </td>
                  </tr>
                  <?php } ?>
              </tbody>
          </table>

          <a href="index.php?sec=add_usuario" class="btn btn-primary mt-5">Agregar Usuario</a>

      </div>
  </div>
