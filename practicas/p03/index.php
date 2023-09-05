<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Practica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
    $_myvar;
    $_7var; 
    //myvar;          Invalida 
    $myvar; 
    $var7; 
    $_element1; 
    //$house*5;       Invalida 
    echo '<ul>';
    echo  '<li> <b>_myvar</b> es válida porque inicia con guión bajo </li>';
    echo  '<li> <b>_7var</b> es válida porque inicia con guión bajo </li>';
    echo  '<li> <b>myvar</b> es válida porque inicia con una letra</li>';
    echo  '<li> <b>var7</b> es válida porque inicia con una letra </li>';
    echo  '<li> <b>_element1</b> es válida porque inicia con guión bajo </li>';
    echo '</ul>';
    ?>



</body>
</html>

