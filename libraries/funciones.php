<?php

    function modificacionTitulo($titulo){
        //cambio el - por un " "
        $tituloConEspacio = str_replace("-", " ", $titulo);
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

    function recortarDescripcion($texto, $cantidad = 20){
        //divido el texto usando explode 
        //str_word_count()
        $arrayTexto = explode(" ", $texto); //
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
