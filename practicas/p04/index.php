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
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numero'])) {
      $numero = $_POST['numero'];
      if (esMultiploDe5Y7($numero)) {
          echo "$numero es múltiplo de 5 y 7.";
      } else {
          echo "$numero no es múltiplo de 5 y 7.";
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numero'])) {
      $numero = $_GET['numero'];
      if (esMultiploDe5Y7($numero)) {
          echo "$numero es múltiplo de 5 y 7.";
      } else {
          echo "$numero no es múltiplo de 5 y 7.";
      }
  }
  ?>

  <h2>Inserta un número</h2>
  <form method="post">
      Número: <input type="number" name="numero">
      <input type="submit" value="Comprobar">
  </form>

  <?php
    $filas = 4; 
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
   
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['numero'])) {
      $numeroDado = $_GET['numero'];
      $primerMultiplo = encontrarPrimerMultiplo($numeroDado);
      echo "El primer número entero múltiplo de $numeroDado es: $primerMultiplo";
  }
  ?>
  

  <h2>Encontrar Primer Múltiplo</h2>
  <form method="get">
      Número para encontrar múltiplo: <input type="number" name="numero">
      <input type="submit" value="Encontrar">
  </form>

<?php


    // Prueba de la función para crear un arreglo con letras de la 'a' a la 'z'
    $letras = crearArregloLetras();
    echo "<table border='1'>";
    foreach ($letras as $key => $value) {
        echo "<tr><td>[$key]</td><td>$value</td></tr>";
    }
    echo "</table><br>";

    // Prueba de la función para identificar una persona por edad y sexo
 ?>

<h2>Formulario de Identificación</h2>
    <form method="post" action="Respuesta.php">
        Edad: <input type="number" name="edad" required><br>
        Sexo:
        <select name="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
        </select><br>
        <input type="submit" value="Enviar">
    </form>

    <h2>Consulta de Vehículos</h2>
    <form method="get" action="consulta.php">
        Consultar por Matrícula: <input type="text" name="matricula">
        <input type="submit" value="Consultar">
    </form>
    <form method="get" action="consulta.php">
        Mostrar todos los autos registrados:
        <input type="hidden" name="mostrar_todos" value="1">
        <input type="submit" value="Mostrar Todos">
    </form>




      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>