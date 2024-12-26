<div class="row my-5 justify-content-center">
    <div class="col col-md-5">
        <h1 class="text-center mb-5 fw-bold">REGISTRAR USUARIO</h1>
        <form class="form" action="admin/actions/registrar_usuario_acc.php" method="post">
          <fieldset>
            <div>
              <label for="username">Email</label>
              <input type="text" name="email" id="username" placeholder="Ingrese su email">
            </div>
            <div>
              <label for="pass">Password</label>
              <input type="password" name="pass" id="pass" placeholder="Ingrese su contraseña">
            </div>
          </fieldset>
          <div class="boton">
            <input type="submit" value="Registrar">
          </div>
        <a href="index.php?sec=login">Login</a>
        </form>
        <?= (new Alerta())->get_alertas() ?>
    </div>
</div>