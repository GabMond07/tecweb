<?php
//Funcion para saber si es multiplo de 5 y 7
function esMultiploDe5Y7($numero) {
    return ($numero % 5 == 0) && ($numero % 7 == 0);
}


// Función para generar números aleatorios hasta obtener una secuencia deseada


function generarSecuencia($filas) {
    $matriz = array();
    $iteraciones = 0;
    $numerosGenerados = 0;

    while ($numerosGenerados < $filas * 3) {
        $secuencia = array();
        
        while (count($secuencia) < 3) {
            $numero = rand(1, 1000); // Generar números aleatorios del 1 al 1000
            $secuencia[] = $numero;
            $numerosGenerados++;

            // Verificar si la secuencia actual es impar, par, impar
            if (count($secuencia) == 3 && $secuencia[0] % 2 != 0 && $secuencia[1] % 2 == 0 && $secuencia[2] % 2 != 0) {
                $matriz[] = $secuencia;
            }
        }
        $iteraciones++;
    }

    return array($matriz, $iteraciones, $numerosGenerados);
}



// Función para encontrar el primer número entero múltiplo de un número dado
function encontrarPrimerMultiplo($numeroDado) {
    do {
        $aleatorio = rand(1, 1000);
    } while ($aleatorio % $numeroDado != 0);

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