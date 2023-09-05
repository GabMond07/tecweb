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
    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <ul>
        <li>$a = “ManejadorSQL”;</li>
        <li>$b = 'MySQL’;</li>
        <li>$c = &$a;</li>
    </ul>
    <?php
    $a = 'ManejadorSQL';
    $b = 'MySQL';
    $c = &$a;
    echo 'Ahora muestra el contenido de cada variable';
    echo '<ul>';
        echo '<li>', $a ,'</li>';
        echo '<li>', $b ,'</li>';
        echo '<li>', $c ,'</li>';
    echo '</ul>';
    echo 'Agrega al código actual las siguientes asignaciones:';
    echo '<ul>';
        echo '<li> $a = “PHP server”;  </li>';
        echo '<li> $b = &$a; </li>';
    echo '</ul>';
    $a = 'PHP server';  
    $b = &$a;
    echo 'Vuelve a mostrar el contenido de cada uno: ';
    echo '<ul>';
        echo '<li>', $a ,'</li>';
        echo '<li>', $b ,'</li>';
    echo '</ul>';
    echo 'Se mostró la nueva asignación de las variables, la cúal la variable $b se le asignó $a';
    ?>





</body>
</html>

