<?php
$nombre = 'David';
$edad = 18;
$estatura = 1.8;
$soltero = true;

echo 'Nombre: '.$nombre;
echo '<br>';
echo 'Edad: '.$edad;
echo '<br>';
echo "Estatura: $estatura";
echo '<br>';

if ($soltero)
{
    echo "Estado civil: soltero";
}
else
{
    echo "Estado civil: casado";
}
echo '<br>';

$foo = 'Juan';
$bar = &$foo;
$bar = "Mi nombre es $bar";

echo $foo;
echo '<br>';
echo $bar;
echo '<br>';

$variable;

if(isset($variable))
{
    echo 'El valor de $variable es:'.$variable;    
}
else
{
    echo 'La variable no ha sido inicialidada';
}
?>