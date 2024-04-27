<?php



class Comic{
    //atributos
    //solo pueden acceder los metodos de la propia clase y los metodos de los hijos de esa clase
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

            //creo una instancia de comic -> ahora tengo un objeto comic
            $comic = new self();   //self
            //relleno los atributos
            $comic->id = $value->id;
            $comic->titulo = $value->titulo;
            $comic->subtitulo = $value->subtitulo;
            $comic->descripcion = $value->descripcion;
            $comic->precio = $value->precio;
            $comic->imagen = $value->imagen;
            $comic->categoria = $value->categoria;
            // $comic->volumen = $value->volumen;
            // $comic->publicacion = $value->publicacion;
            // $comic->guion = $value->guion;
            // $comic->arte = $value->arte;
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

    public function catalogo_x_personaje($categoria){
        $comics = $this->catalogo_completo();
        $personajes = [];
    
        foreach ($comics as $comic) {
            if( $comic->categoria == $categoria ){
                $personajes []= $comic;
            }
        }
    
        return $personajes;
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