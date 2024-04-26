<?php

class Comic{
    //atributos
    protected $id;                      //solo pueden acceder los metodos de la propia clase y los metodos de los hijos de esa clase
    protected $personaje;
    protected $serie;
    protected $volumen;
    protected $numero;
    protected $titulo;
    protected $publicacion;
    protected $guion;
    protected $arte;
    protected $bajada;
    protected $portada;
    protected $precio;
    //metodos
    public function catalogo_completo(){
        $catalogo = [];
        $productosStringJson = file_get_contents("includes/productos.json");
        $productosArray = json_decode($productosStringJson);        // -> un objeto de la clase stdClass

        foreach ($productosArray as $value) {

            //creo una instancia de comic -> ahora tengo un objeto comic
            $comic = new self();   //self
            //relleno los atributos
            $comic->id = $value->id;
            $comic->personaje = $value->personaje;
            $comic->serie = $value->serie;
            $comic->volumen = $value->volumen;
            $comic->titulo = $value->titulo;
            $comic->publicacion = $value->publicacion;
            $comic->guion = $value->guion;
            $comic->arte = $value->arte;
            $comic->bajada = $value->bajada;
            $comic->portada = $value->portada;
            $comic->precio = $value->precio;
            $catalogo []= $comic;

        }
        return $catalogo;
    }
    public function catalogo_x_id($id){
        $comics = $this->catalogo_completo();
    
        foreach ($comics as $comic) {
            if( $comic->id == $id ){
                return $comic;
            }
        }
    
        return [];
    }

    public function catalogo_x_personaje($personaje){
        $comics = $this->catalogo_completo();
        $personajes = [];
    
        foreach ($comics as $comic) {
            if( $comic->personaje == $personaje ){
                $personajes []= $comic;
            }
        }
    
        return $personajes;
    }

    public function modificacionSerie(){
        //cambio el - por un " "
        $tituloConEspacio = str_replace("-", " ", $this->serie);
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
        $arrayTexto = explode(" ", $this->bajada); //
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
    public function getPersonaje(){
        return $this->personaje;
    }
    //set -> sirver para cambiar el valor del atributo

    /**
     * Get the value of volumen
     */ 
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * Get the value of serie
     */ 
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the value of publicacion
     */ 
    public function getPublicacion()
    {
        return $this->publicacion;
    }

    /**
     * Get the value of guion
     */ 
    public function getGuion()
    {
        return $this->guion;
    }

    /**
     * Get the value of arte
     */ 
    public function getArte()
    {
        return $this->arte;
    }

    /**
     * Get the value of bajada
     */ 
    public function getBajada()
    {
        return $this->bajada;
    }

    /**
     * Get the value of portada
     */ 
    public function getPortada()
    {
        return $this->portada;
    }

    /**
     * Get the value of precio
     */ 
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