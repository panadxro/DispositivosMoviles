<?php

class Carrito{
  protected $id;
  protected $usuario_id;
  protected $producto_id;
  protected $cantidad;
  protected $talle;

  // Contructor
/*   public function __construct() {
    // Validar si el usuario está logueado
    if (!isset($_SESSION['login']) || !isset($_SESSION['login']['id'])) {
        // Redirigir si no está logueado
        header("Location: ../../index.php?sec=home");
        exit;
    }

    $this->usuario_id = $_SESSION['login']['id'];
  } */
  // Metodos
  public function catalogo_completo(): array {
      $catalogo = [];
      $conexion = Conexion::getConexion();
      $query = "SELECT * FROM carritos_x_usuarios WHERE usuario_id = :id_usuario";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
      $PDOStatement->execute([
        "id_usuario" => htmlspecialchars($_SESSION["login"]["id"])
      ]);
      $catalogo = $PDOStatement->fetchAll();
      return $catalogo;
  }
  public function catalogo_x_id(int $id){
        $talles = $this->catalogo_completo();
        foreach ($talles as $talle) {
            if ($talle->usuario_id == $id) {
                return $talle;
            }
        }
        return [];
    }

    public function add_item(int $producto_id, int $cantidad, $talle){
        $itemData = (new Producto())->catalogo_x_id($producto_id);
        if($itemData){
            $_SESSION["carrito"][$producto_id] = [
                "producto" => $itemData->getNombre(),
                "imagen" => $itemData->getImagen(),
                "precio" => $itemData->getPrecio(),
                "cantidad" => $cantidad,
                "talle" => $talle
            ];
        }
    }
    public function getCarrito() {
      try {
          $conexion = Conexion::getConexion();
          $query = "SELECT c.id, c.usuario_id, c.producto_id, c.cantidad, c.talle, p.nombre as producto, p.imagen, p.precio 
                    FROM carritos_x_usuarios c 
                    JOIN productos p ON c.producto_id = p.id 
                    WHERE c.usuario_id = :id_usuario";
          $PDOStatement = $conexion->prepare($query);
          $PDOStatement->execute([
              "id_usuario" => htmlspecialchars($_SESSION["login"]["id"])
          ]);
          return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
      } catch (Exception $e) {
          echo $e->getMessage();
          return [];
      }
  }
    /**Devolver el precio total */
    public function getTotal() {
      $items = $this->getCarrito();
      $total = 0;
      foreach ($items as $item) {
          $total += $item['precio'] * $item['cantidad'];
      }
      return $total;
    }
    /**Vaciar carrito */
    public function vaciarCarrito(){
        $_SESSION["carrito"] = [];
    }
    /**Modificar Cantidad*/

    public function actualizarCantidades(array $cantidades){
        if( !empty($cantidades) ){
            foreach( $cantidades as $id => $cantidad ){
                if( isset( $_SESSION["carrito"][$id] ) ){
                    $_SESSION["carrito"][$id]["cantidad"] = $cantidad; 
                }
            }
        }
    }

    /**Eliminar item individual Cantidad*/
    public function removeItem(int $id){
        if( isset( $_SESSION["carrito"][$id] ) ){
            unset($_SESSION["carrito"][$id]);
            (new Alerta())->add_alerta("Producto eliminado", "success");
        }else{
            (new Alerta())->add_alerta("No se ha eliminado el producto", "danger");
        }
    }
    public function insert_item(int $id_usuario, int $id_producto, int $cantidad, string $talle){
        try {
            $conexion = Conexion::getConexion();
            $query = "INSERT INTO carritos_x_usuarios (`id`, `usuario_id`, `producto_id`, `cantidad`, `talle`) VALUES (NULL, :usuario_id, :producto_id, :cantidad, :talle)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "producto_id" => htmlspecialchars($id_producto),
                "usuario_id" => htmlspecialchars($id_usuario),
                "cantidad" => htmlspecialchars($cantidad),
                "talle" => htmlspecialchars($talle)
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function delete_item(int $id_producto){
      $conexion = Conexion::getConexion();
      $query = "DELETE FROM carritos_x_usuarios WHERE id = :id";
      $PDOStatement = $conexion->prepare($query);
      $PDOStatement->execute([
          "id" => htmlspecialchars($id_producto)
      ]);
      (new Alerta())->add_alerta("Producto eliminado", "success");
    }
    
    public function borrarCarritosAnteriores(){
        try {
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM `carritos_x_usuarios` WHERE usuario_id = :id_usuario";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "id_usuario" => htmlspecialchars($_SESSION["login"]["id"])
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /* Getters */
    public function getId() { return $this->id; }
    public function getUserId() { return $this->usuario_id; }
    public function getProductId() { return $this->producto_id; }
    public function getCantidad() { return $this->cantidad; }
    public function getTalle() { return $this->talle; }
    
    /* Setters */
}