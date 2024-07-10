<?php

    class Categoria{
        protected $id;
        protected $nombre;
        
        // Getters
        public function getId() { return $this->id; }
        public function getNombre() { return $this->nombre; }
        // Setters
        public function setId($id): self {
          $this->id = $id;
          return $this;
        }
        public function setNombre($nombre): self {
          $this->nombre = $nombre;
          return $this;
        }
        // Metodos
        public function get_x_id(int $id) :? self
        {
            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM categorias WHERE id = $id";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
            $resultado = $PDOStatement->fetch();
    
            return $resultado ? $resultado : null;
        }
        public function catalogo_completo(): array
        {
            $catalogo = [];
            $conexion = Conexion::getConexion();
            $query = "SELECT * FROM categorias";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
            $PDOStatement->execute();
    
            $catalogo = $PDOStatement->fetchAll();
    
            return $catalogo;
        }
        public function insert($nombre): void
        {
            try {
                $conexion = Conexion::getConexion();
                $query = "INSERT INTO categorias VALUES (null, :nombre )";
                $PDOStatement = $conexion->prepare($query);
                $PDOStatement->execute([
                    "nombre" => htmlspecialchars($nombre)
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        public function edit($nombre, $id){
          $conexion = Conexion::getConexion();
          $query = "UPDATE categorias SET nombre= :nombre WHERE id = :id";
          $PDOStatement = $conexion->prepare($query);
          $PDOStatement->execute([
              "nombre" => htmlspecialchars($nombre),
              "id" => htmlspecialchars($id)
          ]);
        }
        public function delete(){
          $conexion = Conexion::getConexion();
          $query = "DELETE FROM categorias WHERE id = :id";
          $PDOStatement = $conexion->prepare($query);
          $PDOStatement->execute(["id" => htmlspecialchars($this->id)]);
        }  
}