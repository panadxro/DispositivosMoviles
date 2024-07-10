<div class="row my-5 justify-content-center">
    <div class="col col-md-5">
        <h1 class="text-center mb-5 fw-bold">Inciar Sessión</h1>
 /* (new Alerta())->get_alertas() */ /* ?> */
        <form class="row g-3" action="admin/actions/auth_login.php" method="post">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input class="form-control" type="text" name="email">
            <label for="pass" class="form-label">Password</label>

            <input class="form-control" type="text" name="pass">
            <button class="btn btn-primary" type="submit">Login!</button>
            <a class="btn btn-secondary" href="index.php?sec=registro">Registrar</a>
        </form>
    </div>
</div>