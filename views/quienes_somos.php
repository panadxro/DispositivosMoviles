<?php
  $alumnos = ( new Alumno() )->alumnos();
?>


<section class="seccion-alumnos">
<?php foreach ($alumnos as $alumno) { ?>
  <div class="portada-alumno">
    <figure>
      <img src="<?= $alumno->getImagen() ?>" alt="Foto alumno">
    </figure>
  </div>
  <article id="infoProducto">
    <h2 id="nombre-alumno" class="titulo-2"><?= $alumno->getNombre() ?></h2>
    <span id="cat-alumno"><?= $alumno->getEdad() ?> años</span>
    <p id="correo-alumno"><?= $alumno->getEmail() ?></p>
    <ul id="redes-sociales">
      <li><a href="<?= $alumno->getLinkedin() ?>" target="_blank" class="icon a-linkedin"><small>Linkedin</small></a></li>
      <li><a href="<?= $alumno->getGithub() ?>" target="_blank" class="icon a-github"><small>Github</small></a></li>
      <li><a href="<?= $alumno->getInstagram() ?>" target="_blank" class="icon a-instagram"><small>Instagram</small></a></li>
    </ul>
  </article>

  <?php } ?>
</section>