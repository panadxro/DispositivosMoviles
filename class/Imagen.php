<?php
class Imagen{
    public function subirImagenes($directorioBase, $nombreProducto, $imagenes) {
        // Crear la carpeta del producto si no existe
        $directorioProducto = "$directorioBase/$nombreProducto";
        if (!is_dir($directorioProducto)) {
            mkdir($directorioProducto, 0777, true);
        }

        $nombresImagenes = [];

        foreach ($imagenes["tmp_name"] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                // Validar que el archivo sea PNG
                $extension = strtolower(pathinfo($imagenes["name"][$key], PATHINFO_EXTENSION)); // Obtener extensión en minúscula
                if ($extension !== "png") {
                    throw new Exception("Error: El archivo '{$imagenes["name"][$key]}' no es un PNG. Solo se permiten imágenes en formato PNG.");
                }

                // Construir el nombre de la imagen usando el nombre del producto y un índice
                $indice = $key + 1; // Índice basado en la posición en el array
                $nombreImagen = "$nombreProducto$indice.$extension"; // Ejemplo: "nombre-producto1.png"
                $rutaDestino = "$directorioProducto/$nombreImagen";

                if (!move_uploaded_file($tmp_name, $rutaDestino)) {
                    throw new Exception("No se pudo subir la imagen: $nombreImagen");
                }
                $nombresImagenes[] = $nombreImagen;
            }
        }

        // Validar que se subieron hasta 5 imágenes
        if (count($nombresImagenes) > 5) {
            throw new Exception("Se permiten un máximo de 5 imágenes por producto.");
        }

        return $nombresImagenes;
    }

      
/*         public function subirImagen($directorio, $datosImagen){
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
        } */
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