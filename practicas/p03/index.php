<!DOCTYPE html>
<html>
<head>
    <title>Prueba Ejercicios</title>
</head>
<body>
    <?php
    include('p03_funciones.php');

    // Prueba de la función para comprobar si un número es múltiplo de 5 y 7
    $numero1 = 10;
    echo "¿$numero1 es múltiplo de 5 y 7? " . (esMultiploDe5Y7($numero1) ? "Sí" : "No") . "<br>";


    ?>
</body>
</html>