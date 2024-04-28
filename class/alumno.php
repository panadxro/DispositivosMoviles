<?php

class Alumno{
    protected $nombre;                      
    protected $edad;
    protected $email;
    protected $imagen;
    protected $linkedin;
    protected $github;
    protected $instagram;


public function alumnos(){
    $alumnos = [];
    $alumnosStringJson = file_get_contents("includes/alumnos.json");
    $alumnosArray = json_decode($alumnosStringJson);        // -> un objeto de la clase stdClass

    foreach ($alumnosArray as $value) {

        //creo una instancia de comic -> ahora tengo un objeto comic
        $alumno = new self();   //self
        //relleno los atributos
        $alumno->nombre = $value->nombre;
        $alumno->edad = $value->edad;
        $alumno->email = $value->email;
        $alumno->imagen = $value->imagen;
        $alumno->linkedin = $value->linkedin;
        $alumno->github = $value->github;
        $alumno->instagram = $value->instagram;
        $alumnos []= $alumno;

    }
    return $alumnos;
}

public function getNombre(){
    return $this->nombre;
}
public function getEdad(){
    return $this->edad;
}
public function getEmail(){
    return $this->email;
}
public function getImagen(){
    return $this->imagen;
}
public function getLinkedin(){
    return $this->linkedin;
}
public function getGithub(){
    return $this->github;
}
public function getInstagram(){
    return $this->instagram;
}

}

