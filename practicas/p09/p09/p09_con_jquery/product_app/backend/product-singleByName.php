<?php
include_once __DIR__.'/API/DataBase.php';
include_once __DIR__.'/API/Productos.php';

$nombre = $_POST['nombre'];
$conexion = new Producto('marketzone'); 
$conexion->singleByName($nombre);
?>