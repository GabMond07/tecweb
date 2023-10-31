<?php
include_once __DIR__.'/API/DataBase.php';
include_once __DIR__.'/API/Productos.php';

$search = $_GET['search'];
$conexion = new Producto('marketzone'); 
$conexion->search($search);
?>