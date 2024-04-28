<?php

class Producto{
    protected $id;                      
    protected $titulo;
    protected $subtitulo;
    protected $descripcion;
    protected $precio;
    protected $imagen;
    protected $categoria;

    //metodos
    public function catalogo_completo(){
        $catalogo = [];
        $productosStringJson = file_get_contents("includes/productos.json");
        $productosArray = json_decode($productosStringJson);        // -> un objeto de la clase stdClass

        foreach ($productosArray as $value) {

            //creo una instancia de producto -> ahora tengo un objeto comic
            $producto = new self();   //self
            //relleno los atributos
            $producto->id = $value->id;
            $producto->titulo = $value->titulo;
            $producto->subtitulo = $value->subtitulo;
            $producto->descripcion = $value->descripcion;
            $producto->precio = $value->precio;
            $producto->imagen = $value->imagen;
            $producto->categoria = $value->categoria;

            $catalogo []= $producto;

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

    public function filtrar_x_categoria($categoria){
        $productos = $this->catalogo_completo();
        $lista_productos = [];
    
        foreach ($productos as $producto) {
            if( $producto->categoria == $categoria ){
                $lista_productos []= $producto;
            }
        }
    
        return $lista_productos;
    }

    public function modificacionSerie(){
        //cambio el - por un " "
        $tituloConEspacio = str_replace("-", " ", $this->titulo);
        //explode divide por un caracter indicado
        $arrayTitulo = explode(" ", $tituloConEspacio);
        //paso ambas palabras a mayusculas
        for( $i = 0; $i < count($arrayTitulo) ; $i++ ){
            $arrayTitulo[$i] = ucfirst($arrayTitulo[$i]);
        }
        //implode lo une utilizando el caracter que le indicamos
        $tituloCorregido = implode(" ", $arrayTitulo);
        return $tituloCorregido;
    }

    public function getBajadaResumida( $cantidad = 20 ){
        //divido el texto usando explode 
        //str_word_count()
        $arrayTexto = explode(" ", $this->descripcion); //
        $textoResumido = [];

        foreach ($arrayTexto as $key => $value) {
            if( $key < $cantidad ){
                $textoResumido []= $value;
            }else{
                break;
            }
        }
        return implode(" ", $textoResumido)."...";
    }


    //get -> sirven para obtener el valor del atributo
    public function getId(){
        return $this->id;
    }
    public function getCategoria(){
        return $this->categoria;
    }
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getImagen()
    {
        return $this->imagen;
    }
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}