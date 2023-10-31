<?php
abstract class DataBase{
    protected $conexion;

    public function __construct($nameBD) {
        $this->conexion = new mysqli('localhost', 'root', 'Vetealaverga07&', $nameBD);
    }
}
?>