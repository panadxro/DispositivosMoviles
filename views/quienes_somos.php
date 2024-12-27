<?php
  $alumnos = ( new Alumno() )->alumnos();
  $fecha_nacimiento = new DateTime('2000-07-15');
  $hoy = new DateTime();
  $edad = $hoy->diff($fecha_nacimiento)->y;
?>


<section class="seccion-alumnos">
<?php foreach ($alumnos as $alumno) { ?>
  <div class="portada-alumno">
    <figure class="overflow-hidden w-50">
      <img src="<?= $alumno->getImagen() ?>" alt="Foto alumno">
    </figure>
  </div>
  <article id="infoProducto">
    <h2 id="nombre-alumno" class="titulo-2"><?= $alumno->getNombre() ?></h2>
    <span id="cat-alumno"><?= $edad ?> años</span>
    <p><?= $alumno->getDescripcion() ?></p>
    <p id="correo-alumno"><?= $alumno->getEmail() ?></p>
    <ul id="redes-sociales">
      <li><a href="<?= $alumno->getLinkedin() ?>" target="_blank" class="icon a-linkedin"><small>Linkedin</small></a></li>
      <li><a href="<?= $alumno->getGithub() ?>" target="_blank" class="icon a-github"><small>Github</small></a></li>
      <li><a href="<?= $alumno->getInstagram() ?>" target="_blank" class="icon a-instagram"><small>Instagram</small></a></li>
    </ul>
  </article>

  <?php } ?>
</section>