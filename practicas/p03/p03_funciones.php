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

?>