<div class="row my-5 justify-content-center">
    <div class="col col-md-5">

        <h1 class="text-center mb-5 fw-bold">REGISTRAR USUARIO</h1>
        <form class="row g-3" action="admin/actions/registrar_usuario.php" method="post">
        <label for="username" class="form-label">Email</label>
            <input class="form-control" type="text" name="email">
            <label for="pass" class="form-label">Password</label>
            <input class="form-control" type="text" name="pass">
            <button class="btn btn-primary" type="submit">Registrar</button>
            <a class="btn btn-secondary" href="index.php?sec=login">Login</a>
        </form>
    </div>
</div>