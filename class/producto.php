<?php

class Producto{
  // Atributos
  protected $id;                      
  protected $nombre;
  protected $alias;
  protected $descripcion;
  protected $precio;
  protected $imagen;
  protected $categoria;
  protected $talles_ids;
  protected $talles;
  protected static $valores = ["id", "nombre", "alias", "descripcion", "precio", "imagen"];

  // Metodos
  public function mapear($productoArrayAsociativo) : self {
    $producto = new self();
    foreach (self::$valores as $valor) {
      $producto->{$valor} = $productoArrayAsociativo[$valor];
    }
    $producto->categoria = (new Categoria())->get_x_id($productoArrayAsociativo["categoria_id"]);
    $Tids = explode(",", $productoArrayAsociativo["talles"]);
    $talles_array = [];
    foreach ($Tids as $Tid) {
      $talles_array []= (new Talle())->catalogo_x_id(intval($Tid));
    }
    $producto->talles = $talles_array;
    $producto->talles_ids = $productoArrayAsociativo["talles"];
    // $producto->talles_ids = $Tids;
    return $producto;
  }


  public function mapearCat($productoArrayAsociativo) : self {
    $producto = new self();
    foreach (self::$valores as $valor) {
        $producto->{$valor} = $productoArrayAsociativo[$valor];
    }
    $producto->categoria = (new Categoria())->get_x_id($productoArrayAsociativo["categoria_id"]);
    return $producto;
  }
  public function catalogo_completo() {
    $catalogo = [];
    $conexion = Conexion::getConexion();
    $query = 'SELECT productos.*, GROUP_CONCAT(productos_x_talles.talle_id) AS talles FROM productos 
    LEFT JOIN productos_x_talles ON productos.id = productos_x_talles.producto_id 
    GROUP BY productos.id';
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute();
    while ($producto = $PDOStatement->fetch()) {
      $catalogo[] = $this->mapear($producto);
    }
    return $catalogo;
  }
  public function catalogo_x_id($id){
    $productos = $this->catalogo_completo();
    foreach ($productos as $producto) {
      if( $producto->id == $id ){
        return $producto;
      }
    }
    return [];
  }
  public function catalogo_x_categoria(int $categoria_id): array {
    $personajes = [];
    $conexion = Conexion::getConexion();
    $query = "SELECT productos.*, categorias.nombre AS categoria FROM productos 
    JOIN categorias ON productos.categoria_id = categorias.id 
    WHERE categorias.id = $categoria_id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute();
    while ($producto = $PDOStatement->fetch()) {
      $personajes[] = $this->mapearCat($producto);
    }
    return $personajes;
  }
  public function insert($nombre, $alias, $categoria_id, $descripcion, $imagen, $precio): int {
    try {
      $conexion = Conexion::getConexion();
      $query = "INSERT INTO `productos` (`id`, `nombre`, `alias`, `categoria_id`, `descripcion`, `imagen`, `precio`) VALUES (NULL, :nombre, :alias, :categoria_id, :descripcion, :imagen, :precio)";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute([
        'nombre' => htmlspecialchars($nombre),
        'alias' => htmlspecialchars($alias),
        'categoria_id' => htmlspecialchars($categoria_id),
        'descripcion' => htmlspecialchars($descripcion),
        'imagen' => htmlspecialchars($imagen),
        'precio' => htmlspecialchars($precio),
      ]);
      return $conexion->lastInsertId();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
  public function edit($nombre, $alias, $categoria_id, $descripcion, $precio, $id){
    $conexion = Conexion::getConexion();
    $query = "UPDATE `productos` SET `nombre` = :nombre, `alias` = :alias, `categoria_id` = :categoria_id, `descripcion` = :descripcion, `precio` = :precio WHERE `productos`.`id` = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
      'nombre' => htmlspecialchars($nombre),
      'alias' => htmlspecialchars($alias),
      'categoria_id' => htmlspecialchars($categoria_id),
      'descripcion' => htmlspecialchars($descripcion),
      'precio' => htmlspecialchars($precio),
      "id" => htmlspecialchars($id)
    ]);
  }
  public function delete(){
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM productos WHERE id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
      "id" => htmlspecialchars($this->id)
    ]);
  }
  public function reemplazarImagen($imagen, $id){
    $conexion = Conexion::getConexion();
    $query = "UPDATE productos SET imagen=:imagen WHERE id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
      "imagen" => $imagen,
      "id" => $id
    ]);
  }
  public function add_talles($producto_id, $talle_id){
    $conexion = Conexion::getConexion();
    $query = "INSERT INTO `productos_x_talles` (`id`, `producto_id`, `talle_id`) VALUES (NULL, :producto_id, :talle_id)";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
      "producto_id" => $producto_id,
      "talle_id" => $talle_id
    ]);
  }
  public function clear_talles($id){
    $conexion = Conexion::getConexion();
    $query = "DELETE FROM productos_x_talles WHERE producto_id = :id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
      "id" => $id,
    ]);
  }
  // Getters
  public function getId() { return $this->id; }
  public function getAlias() { return $this->alias; }
  public function getCategoria() { return $this->categoria->getNombre(); }
  public function getCategoria_id() { return $this->categoria->getId(); }
  public function getNombre() { return $this->nombre; }
  public function getDescripcion() { return $this->descripcion; }
  public function getImagen() { return $this->imagen; }
  public function getPrecio() { return $this->precio; }
  public function getTalles() { return $this->talles; }
  public function getTalles_id() { return $this->talles_ids; }

  /**
   * Set the value of editorial
   *
   * @return  self
   */

  // Setters
  public function setId($id) {
    $this->id = $id;
    return $this;
  }
}