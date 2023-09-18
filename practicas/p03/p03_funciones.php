<?php
// Función para comprobar si un número es múltiplo de 5 y 7
function esMultiploDe5Y7($numero) {
    if ($numero % 5 == 0 && $numero % 7 == 0) {
        return true;
    } else {
        return false;
    }
}
?>