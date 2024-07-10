<?php
    class Imagen{
        public function subirImagen($directorio, $datosImagen){
            if( !empty($datosImagen["tmp_name"]) ){
                $tmp_name = $datosImagen["tmp_name"];
                $name =  uniqid()."-".$datosImagen["name"];
                $fileUpload = move_uploaded_file($tmp_name, "$directorio/$name");
                if(!$fileUpload){
                    throw new Exception("No se pudo subir la imagen");
                }else{
                    return $name;
                }
            }
        }
        public function borrarImagen($imagen){
            if( file_exists($imagen) ){
                $fileDelete = unlink($imagen);
                if( $fileDelete ){
                    return true;
                }else{
                    throw new Exception("No se pudo borrar imagen");
                }
            }
        }
    }