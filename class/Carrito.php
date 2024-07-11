<?php

class Carrito{
    /**Agregar producto */

    public function add_item(int $id_producto, int $cantidad, $talle){
        $itemData = (new Producto())->catalogo_x_id($id_producto);
        if($itemData){
            $_SESSION["carrito"][$id_producto] = [
                "producto" => $itemData->getNombre(),
                "imagen" => $itemData->getImagen(),
                "precio" => $itemData->getPrecio(),
                "cantidad" => $cantidad,
                "talle" => $talle
            ];
        }
    }

    /**Mostrar productos */

    public function getCarrito(){
        if( !empty($_SESSION["carrito"]) ){
            return $_SESSION["carrito"];
        }
        return [];
    }
    /**Devolver el precio total */
    public function getTotal(){
        $total = 0;
        if( !empty($_SESSION["carrito"]) ){
            foreach( $_SESSION["carrito"] as $item ){
                $total += $item["precio"] * $item["cantidad"];
            }
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
    /**Finalizar compra*/

    public function finalizarCompra(){
        if( isset( $_SESSION["carrito"] ) && isset($_SESSION["login"]) ){
            foreach( $_SESSION["carrito"] as $id_producto => $producto ){
                $this->insert($id_producto, $_SESSION["login"]["id"], $producto["cantidad"]);
            }
        }
    } 

    public function insert(int $id_producto, int $id_usuario, int $cantidad){
        try {
            $conexion = Conexion::getConexion();
            $query = "INSERT INTO `carrito` (`id`, `id_comic`, `id_usuario`, `cantidad`) VALUES (NULL, :id_producto, :id_usuario, :cantidad)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "id_producto" => htmlspecialchars($id_producto),
                "id_usuario" => htmlspecialchars($id_usuario),
                "cantidad" => htmlspecialchars($cantidad),
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function borrarCarritosAnteriores(){
        try {
            $conexion = Conexion::getConexion();
            $query = "DELETE FROM `carrito` WHERE id_usuario = :id_usuario";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([
                "id_usuario" => htmlspecialchars($_SESSION["login"]["id"])
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}