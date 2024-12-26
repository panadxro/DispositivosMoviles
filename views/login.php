<div class="row my-5 justify-content-center">
    <div class="col col-md-5">
        <h1 class="text-center mb-5 fw-bold">INICIAR SESIÓN</h1>
        <form class="form" action="admin/actions/auth_login.php" method="post">
          <fieldset>
            <div>
              <label for="username">Email</label>
              <input type="text" name="email" id="username" placeholder="Ingrese su email">
            </div>
            <div>
              <label for="pass">Contraseña</label>
              <input type="password" name="pass" id="pass" placeholder="Ingrese su contraseña">
            </div>
          </fieldset>
          <div class="boton">
            <input type="submit" value="Iniciar Sesión">
          </div>
          <a href="index.php?sec=registro">Registrar</a>
          </form>
          <?= (new Alerta())->get_alertas() ?>
    </div>
</div>