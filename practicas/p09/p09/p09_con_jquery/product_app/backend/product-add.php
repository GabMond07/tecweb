<?php
include_once __DIR__.'/API/DataBase.php';
include_once __DIR__.'/API/Productos.php';

$producto = file_get_contents('php://input');
$conexion = new Producto('marketzone'); 
$conexion->add($producto);
$conexion->getResponse($producto);
?>