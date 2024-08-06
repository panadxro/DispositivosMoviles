<?php

class Usuario{
  // Atributos
  protected $id;
  protected $email;
  protected $nombre_usuario;	
  protected $nombre_completo;	
  protected $password;	
  protected $roles; 

  // Getters
  public function getId(){ return $this->id; }
  public function getEmail() { return $this->email; }
  public function getNombreUsuario() { return $this->nombre_usuario; }
  public function getNombreCompleto() { return $this->nombre_completo; }
  public function getPassword() { return $this->password; }
  public function getRoles() { return $this->roles; }

  // Setters
  public function setEmail($email): self  {
    $this->email = $email;
    return $this;
  }
  public function setNombreUsuario($nombre_usuario): self {
    $this->nombre_usuario = $nombre_usuario;
    return $this;
  }
  public function setNombreCompleto($nombre_completo): self {
    $this->nombre_completo = $nombre_completo;
    return $this;
  }
  public function setPassword($password): self {
    $this->password = $password;
    return $this;
  }
  public function setRoles($roles): self {
    $this->roles = $roles;
    return $this;
  }

  // Metodos
  public function catalogo_completo(): array
  {
      $catalogo = [];
      $conexion = Conexion::getConexion();
      $query = "SELECT * FROM usuarios";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
      $PDOStatement->execute();

      $catalogo = $PDOStatement->fetchAll();

      return $catalogo;
  }
  public function catalogo_x_id(int $id) {
    $usuarios = $this->catalogo_completo();
    foreach ($usuarios as $usuario) {
      if ($usuario->id == $id) {
        return $usuario;
      }
    }
    return [];
  }
	public function usuario_x_email(string $email){
		$conexion = Conexion::getConexion();
		$query = "SELECT * FROM usuarios WHERE email = :email";
		$PDOStatement = $conexion->prepare($query);
		$PDOStatement->setFetchMode(PDO::FETCH_CLASS,self::class);
		$PDOStatement->execute([
			"email" => $email
		]);
		$result = $PDOStatement->fetch();
		return $result;
	}

	public function insert(string $email, string $password, string $rol){
		$conexion = Conexion::getConexion();
		$query = "INSERT INTO usuarios VALUES (NULL, '$email', '$password', '$rol')";
		$PDOStatement = $conexion->prepare($query);
		$PDOStatement->execute();
    // return $conexion->lastInsertId();
	}
  public function edit($nombre, $id){
    $conexion = Conexion::getConexion();
    $query = "UPDATE usuarios SET email=:nombre WHERE id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
        "nombre" => htmlspecialchars($nombre),
        "id" => htmlspecialchars($id)
    ]);
  }
  public function delete(){
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM usuarios WHERE id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
        "id" => htmlspecialchars($this->id)
    ]);
  }
}
