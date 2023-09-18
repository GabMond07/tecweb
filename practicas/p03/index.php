<!doctype html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<html lang="en">
  <head>
    <title>index</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

  <?php
    // Incluir el archivo de funciones
    include('p03_funciones.php');

    // Prueba de la función para comprobar si un número es múltiplo de 5 y 7
    $numero1 = 10;
    echo "¿$numero1 es múltiplo de 5 y 7? " . (esMultiploDe5Y7($numero1) ? "Sí" : "No") . "<br>";

    // Prueba de la función para generar números aleatorios hasta obtener una secuencia deseada
    $filas = 4; // Cambiar el número de filas según sea necesario
    list($matriz, $iteraciones, $numerosGenerados) = generarSecuencia($filas);

    echo "<p>Matriz generada:</p>";
    echo "<table border='1'>";
    foreach ($matriz as $fila) {
        echo "<tr>";
        foreach ($fila as $numero) {
            echo "<td>$numero</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    echo "<p>Número de iteraciones: $iteraciones</p>";
    echo "<p>Cantidad de números generados: $numerosGenerados</p>";
    

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














      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>