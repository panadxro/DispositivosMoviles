<div class="inicio notfound">
  <article>
    <ul>
      <?php
      $email;
      $pais;
      $nombre;
      $apellido;
      $direccion;
      $ciudad;
      $postal;
      $telefono;

      if ($_POST['email']) {
        $email = $_POST['email'];

        echo "<li><p>Email: $email</p></li>";
      }

      if ($_POST['pais']) {
        $pais = $_POST['pais'];

        echo "<li><p>País: $pais</p></li>";
      }

      if ($_POST['nombre']) {
        $nombre = $_POST['nombre'];

        echo "<li><p>Nombre: $nombre</p></li>";
      }

      if ($_POST['apellido']) {
        $apellido = $_POST['apellido'];

        echo "<li><p>Apellido: $apellido</p></li>";
      }

      if ($_POST['direccion']) {
        $direccion = $_POST['direccion'];

        echo "<li><p>Dirección: $direccion</p></li>";
      }

      if ($_POST['ciudad']) {
        $ciudad = $_POST['ciudad'];

        echo "<li><p>Ciudad: $ciudad</p></li>";
      }

      if ($_POST['postal']) {
        $postal = $_POST['postal'];

        echo "<li><p>Código Postal: $postal</p></li>";
      }

      if ($_POST['telefono']) {
        $telefono = $_POST['telefono'];

        echo "<li><p>Teléfono: $telefono</p></li>";
      }
      
      if ($_POST['direccion']) {
        $direccion = $_POST['direccion'];

        echo "<li><p>Dirección: $direccion</p></li>";
      }

      ?>
      </ul>
    <a href="index.php?sec=home" class="boton">Volver al inicio</a>
  </article>
  <figure>
    <img src="assets/icon/faviconDrop.png" title="Logo Dropdead Clothing" alt="Logo Dropdead Clothing">
  </figure>
</div>