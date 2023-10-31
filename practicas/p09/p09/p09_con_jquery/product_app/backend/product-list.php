<?php
include_once __DIR__.'/API/DataBase.php';
include_once __DIR__.'/API/Productos.php';
    
$conexion = new Producto('marketzone'); 
$conexion->list();
?>