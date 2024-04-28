<?php
  $alumnos = ( new Alumno() )->alumnos();
?>


<?php foreach ($alumnos as $alumno) { ?>

<div>
  <figure>
    <img src="<?= $alumno->getImagen() ?>" alt="Foto alumno">
  </figure>
  <article id="infoProducto">
    <h2 id="nombre-producto" class="titulo-2"><?= $alumno->getNombre() ?></h2>
    <span id="cat-producto"><?= $alumno->getEdad() ?></span>
    <p id="subtitulo-producto"><?= $alumno->getEmail() ?></p>
    <ul>
      <li><a href="<?= $alumno->getLinkedin() ?>" target="_blank" class="icon a-linkedin"><small>Linkedin</small></a></li>
      <li><a href="<?= $alumno->getGithub() ?>" target="_blank" class="icon a-github"><small>Github</small></a></li>
      <li><a href="<?= $alumno->getInstagram() ?>" target="_blank" class="icon a-insta"><small>Instagram</small></a></li>
    </ul>
  </article>

  <?php } ?>
</div>