<?php
include_once __DIR__.'/API/DataBase.php';
include_once __DIR__.'/API/Productos.php';

$id = $_POST['id'];
$conexion = new Producto('marketzone'); 
$conexion->delete($id);   
?>