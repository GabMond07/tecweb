<?php
// Función para comprobar si un número es múltiplo de 5 y 7
function esMultiploDe5Y7($numero) {
    if ($numero % 5 == 0 && $numero % 7 == 0) {
        return true;
    } else {
        return false;
    }
}


// Función para generar números aleatorios hasta obtener una secuencia deseada
function generarSecuencia($secuencia_deseada) {
    $matriz = array();
    $iteraciones = 0;

    while (true) {
        $numeros = array();

        for ($i = 0; $i < 3; $i++) {
            $numero = rand(1, 1000);
            $numeros[] = $numero;
        }

        if ($numeros == $secuencia_deseada) {
            return array('matriz' => $matriz, 'iteraciones' => $iteraciones);
        }

        $matriz[] = $numeros;
        $iteraciones++;
    }
}

// Función para encontrar el primer número entero múltiplo de un número dado
function encontrarMultiplo($numero_dado) {
    $encontrado = false;
    $aleatorio = 0;

    while (!$encontrado) {
        $aleatorio = rand(1, 1000);
        if ($aleatorio % $numero_dado == 0) {
            $encontrado = true;
        }
    }

    return $aleatorio;
}

// Función para crear un arreglo con letras de la 'a' a la 'z'
function crearArregloLetras() {
    $letras = array();
    for ($i = 97; $i <= 122; $i++) {
        $letras[$i] = chr($i);
    }
    return $letras;
}


// Función para identificar una persona por edad y sexo
function identificarPersona($edad, $sexo) {
    if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
        return "Bienvenida, usted está en el rango de edad permitido.";
    } else {
        return "Lo siento, no cumple con los requisitos.";
    }
}

?>