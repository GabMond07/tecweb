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
    function test1(){    
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
    }

    test1();
    
    ?>
    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
verificar la evolución del tipo de estas variables (imprime todos los componentes de los
arreglo):</p>
    <ul>
        <li> $a = “PHP5”;</li>
        <li> $z[] = &$a;</li>
        <li> $b = “5a version de PHP”;</li>
        <li> $c = $b*10;</li>
        <li> $a .= $b;</li>
        <li> $b *= $c;</li>
        <li> $z[0] = “MySQL”;</li>
    </ul>
    <?php
        $a = 'PHP5';
        $z[] = &$a;
        $b = '5a version de PHP';
        @$c = $b*10;
        $a .= $b;
        @$b *= $c;
        $z[0] = 'MySQL';     
        echo '<ul>';
            echo ($a);
            echo '</br>';
            echo print_r ($z);
            echo '</br>';
            print_r ($b);
            echo '</br>';
            print_r ($c);
            echo '</br>';
            echo ($a);
            echo '</br>';
            print_r ($b);
            echo '</br>';
            print_r ($z);
        echo '</ul>';
    ?>
     <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
    function test2() {  
         echo '<ul>';
             echo $GLOBALS['a'];
             echo '</br>';
             echo print_r($GLOBALS['z']);
             echo '</br>';
             echo $GLOBALS['b'];
             echo '</br>';
             echo print_r ($GLOBALS['c']);
             echo '</br>';
             echo $GLOBALS['a'];
             echo '</br>';
             echo print_r($GLOBALS['b']);
             echo '</br>';
             echo print_r($GLOBALS['z']);
         echo '</ul>';
    }
    test2();
    ?>
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <ul>
        <li>$a = “7 personas”;</li>
        <li>$b = (integer) $a;</li>
        <li>$a = “9E3”;</li>
        <li>$c = (double) $a;</li>
    </ul>
    <?php
    $a = "7 personas";
    $b = (integer)$a;
    $a = "9E3";
    $c = (double)$a;

    echo "a: $a<br>"; // a: 9E3
    echo "b: $b<br>"; // b: 7
    echo "c: $c<br>"; // c: 9000
    ?>

   



</body>
</html>

