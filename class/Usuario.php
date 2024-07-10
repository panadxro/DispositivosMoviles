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

	public function insert(string $email, string $password){
		$conexion = Conexion::getConexion();
		$query = "INSERT INTO usuarios VALUES (NULL, '$email', '', '', '$password', 'usuario')";
		$PDOStatement = $conexion->prepare($query);
		$PDOStatement->execute();
	}
}