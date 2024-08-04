<div class="row pt-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">AGREGAR USUARIO</h1>
        <div class="row mb-5 d-flex justify-content-center align-items-center">
            <form class="row g-3" action="actions/add_usuario_acc.php" method="post" enctype="multipart/form-data">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre de usuario</label>
                    <input class="form-control" type="text" name="email" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contraseña</label>
                    <input class="form-control" type="text" name="pass" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Rol</label>
                    <select class="form-select" name="rol_id" id="rol_id" required>
                        <option value="" selected disabled>Elija una opcion</option>
                        <option value="admin">Admin</option>
                        <option value="usuario">User</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Cargar</button>
            </form>
        </div>
    </div>
</div>