<?php
require_once "../../functions/autoload.php";

// Inicia la sesión si aún no está iniciada
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION["login"])) {
    header("Location: ../../index.php?sec=login");
    exit();
}

// Obtén los datos enviados por POST
$email = $_POST["email"];
$pass = $_POST["pass"];
$id = $_POST["id"];

// Obtén el usuario que está intentando ser editado
$usuario_a_editar = (new Usuario())->catalogo_x_id($id);

// Verifica que el usuario exista
if (!$usuario_a_editar) {
    header("Location: ../index.php?sec=admin_usuarios&error=usuario_no_encontrado");
    exit();
}

// Obtén el usuario autenticado
$usuario_autenticado = (new Usuario())->usuario_x_email($_SESSION["login"]["email"]);

// Verifica que la contraseña actual sea correcta
if (!$usuario_autenticado || !password_verify($pass, $usuario_autenticado->getPassword())) {
    (new Alerta())->add_alerta("Contraseña actual incorrecta.", "danger");
    header("Location: ../index.php?sec=edit_usuario&id=$id");
    exit();
}

// Si el usuario autenticado no es administrador, ignora el cambio de rol
if ($usuario_autenticado->getRoles() !== 'admin') {
    unset($_POST["rol_id"]); // Elimina el rol enviado desde el formulario
}

// Obtén los datos para la actualización
$rol_id = $_POST["rol_id"] ?? $usuario_a_editar->getRoles(); // Mantén el rol actual si no se envió
$new_pass = $_POST["new_pass"] ?? null; // Nueva contraseña si se proporcionó

// Intenta realizar la actualización
try {
    $usuario_a_editar->edit(
        $id,
        $email,
        $rol_id,
        $new_pass
    );
    header("Location: ../index.php?sec=admin_usuarios&success=usuario_actualizado");
    exit();
} catch (Exception $e) {
    echo $e->getMessage();
    die("Error al editar usuario");
}
