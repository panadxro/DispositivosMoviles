<?php

class Talle
{
    //atributos
    protected $id;
    protected $nombre;

    //metodos
    public function catalogo_completo(): array
    {
        $catalogo = [];
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM talles";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();

        $catalogo = $PDOStatement->fetchAll();

        return $catalogo;
    }

    public function catalogo_x_id(int $id)
    {
        $talles = $this->catalogo_completo();

        foreach ($talles as $talle) {
            if ($talle->id == $id) {
                return $talle;
            }
        }

        return [];
    }
    public function insert($nombre): void
    {
        try {
            $conexion = Conexion::getConexion();
            $query = "INSERT INTO talles VALUES (null, :nombre )";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "nombre" => htmlspecialchars($nombre)
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function delete(){
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM talles WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "id" => htmlspecialchars($this->id)
        ]);
    }

    public function edit($nombre, $id){
        $conexion = Conexion::getConexion();
        $query = "UPDATE talles SET nombre=:nombre WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "nombre" => htmlspecialchars($nombre),
            "id" => htmlspecialchars($id)
        ]);
    }

    public function reemplazarImagen($imagen, $id){
        $conexion = Conexion::getConexion();
        $query = "UPDATE personajes SET imagen=:imagen WHERE id = :id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "imagen" => $imagen,
            "id" => $id
        ]);
    }

    // Getters
    public function getNombre() { return $this->nombre; }
    public function getId() { return $this->id; }

    // Setters
    public function setNombre($nombre): self {
        $this->nombre = $nombre;
        return $this;
    }
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }
}
