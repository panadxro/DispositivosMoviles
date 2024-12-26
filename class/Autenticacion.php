<?php

class Autenticacion
{
    public function log_out(): void
    {
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }
    }
    /**
     * @param string $email El nombre de email
     * @param string $pass El password del usuario ingresado
     * @return bool Devuelve un TRUE en caso que se haya logueado
     */
    public function log_in(string $email, string $pass): bool
    {
        $usuario = (new Usuario())->usuario_x_email($email);
        if ($usuario) {
            if (password_verify($pass, $usuario->getPassword())) {
                $datosLogin['username'] = $usuario->getNombreUsuario();
                $datosLogin['id'] = $usuario->getId();
                $datosLogin['roles'] = $usuario->getRoles();
                $datosLogin['email'] = $usuario->getEmail();

                $_SESSION['login'] = $datosLogin;
                return true;
            }
        }
        return false;
    }

    public function verify() {
      if (isset($_SESSION['login'])) {
          // Actualiza la información del usuario desde la base de datos
          $usuario = (new Usuario())->usuario_x_email($_SESSION['login']['email']);
          if ($usuario) {
              $_SESSION['login']['roles'] = $usuario->getRoles();
          }
          return true;
      } else {
          header('Location: ../index.php?sec=login');
          exit;
      }
  }

    public function isAdmin(): bool {
      return isset($_SESSION['login']['roles']) && $_SESSION['login']['roles'] === 'admin';
  }
  
  
}
