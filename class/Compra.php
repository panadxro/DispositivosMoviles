<?php

class Compra{
  protected $id;
  protected $usuario_id;
  protected $producto_id;
  protected $cantidad;
  protected $talle;

  /* Metodos */
  public function historial($usuario_id) {
    $conexion = Conexion::getConexion();
    $query = "SELECT c.id, c.producto_id, c.cantidad, c.talle, p.nombre as producto, p.imagen, p.precio 
              FROM compras c 
              JOIN productos p ON c.producto_id = p.id 
              WHERE c.usuario_id = :usuario_id";
    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->execute([
        "usuario_id" => htmlspecialchars($usuario_id)
    ]);
    $compras = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
    return $compras;
  }
  public function getTotal($usuario_id) {
    $items = $this->historial($usuario_id);
    $total = 0;
    foreach ($items as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }
    return $total;
  }
  public function comprar(int $usuario_id) {
    try {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM carritos_x_usuarios WHERE usuario_id = :usuario_id";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([
            "usuario_id" => htmlspecialchars($usuario_id)
        ]);
        $items = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

        $queryCompra = "INSERT INTO compras (usuario_id, producto_id, cantidad, talle) 
                        VALUES (:usuario_id, :producto_id, :cantidad, :talle)";
        $PDOStatementCompra = $conexion->prepare($queryCompra);

        foreach ($items as $item) {
            $PDOStatementCompra->execute([
                "usuario_id" => $item['usuario_id'],
                "producto_id" => $item['producto_id'],
                "cantidad" => $item['cantidad'],
                "talle" => $item['talle']
            ]);
        }

/*           // Vaciar el carrito
        $queryVaciar = "DELETE FROM carritos_x_usuarios WHERE usuario_id = :usuario_id";
        $PDOStatementVaciar = $conexion->prepare($queryVaciar);
        $PDOStatementVaciar->execute([
            "usuario_id" => htmlspecialchars($usuario_id)
        ]); */

    } catch (Exception $e) {
        echo $e->getMessage();
    }
  }
  public function cargarDatosComprador(int $id ,string $direccion, string $email){
    $_SESSION["datos_comprador"][$id]["direccion"] = $direccion; 
    $_SESSION["datos_comprador"][$id]["email"] = $email; 
  }
}