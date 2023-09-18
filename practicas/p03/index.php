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

    // Prueba de la función para generar números aleatorios hasta obtener una secuencia deseada
    $secuencia_deseada = array('impar', 'par', 'impar');
    $resultados = generarSecuencia($secuencia_deseada);
    echo "Secuencia deseada obtenida:<br>";
    foreach ($resultados['matriz'] as $row) {
        echo implode(', ', $row) . "<br>";
    }
    echo "Número de iteraciones: " . $resultados['iteraciones'] . "<br>";

    // Prueba de la función para encontrar el primer número entero múltiplo de un número dado
    $numero2 = 7;
    echo "El primer número entero múltiplo de $numero2 es: " . encontrarMultiplo($numero2) . "<br>";

    // Prueba de la función para crear un arreglo con letras de la 'a' a la 'z'
    $letras = crearArregloLetras();
    echo "<table border='1'>";
    foreach ($letras as $key => $value) {
        echo "<tr><td>[$key]</td><td>$value</td></tr>";
    }
    echo "</table><br>";

    // Prueba de la función para identificar una persona por edad y sexo
    if (isset($_POST['edad']) && isset($_POST['sexo'])) {
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        echo identificarPersona($edad, $sexo);
    }

    ?>
</body>
</html>