<?php

require_once __DIR__.'/DataBase.php';

class Producto extends DataBase {
    private $response = array();

    public function __construct($nameBD = 'marketzone') {
        parent::__construct($nameBD);

        $result = $this->conexion->query('SELECT * FROM Productos');
        if ($result) {
            $this->response = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            $this->response = array();
        }
    }
    public function getResponse() {
        return json_encode($this->response);
    }
    public function add($nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";

        if ($this->conexion->query($sql) === true) {
            $this->response = array(
                'status' => 'success',
                'message' => 'Producto agregado'
            );
        } else {
            $this->response = array(
                'status' => 'error',
                'message' => 'Error al agregar el producto: ' . $this->conexion->error
            );
        }
    }

    public function delete($id) {
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = $id";

        if ($this->conexion->query($sql) === true) {
            $this->response = array(
                'status' => 'success',
                'message' => 'Producto eliminado'
            );
        } else {
            $this->response = array(
                'status' => 'error',
                'message' => 'Error al eliminar el producto: ' . $this->conexion->error
            );
        }
    }

    public function edit($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        $sql = "UPDATE productos 
                SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', precio = $precio, 
                    detalles = '$detalles', unidades = $unidades, imagen = '$imagen' 
                WHERE id = $id";

        if ($this->conexion->query($sql) === true) {
            $this->response = array(
                'status' => 'success',
                'message' => 'Producto editado'
            );
        } else {
            $this->response = array(
                'status' => 'error',
                'message' => 'Error al editar el producto: ' . $this->conexion->error
            );
        }
    }

    public function listar() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0";

        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $productos = array();
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            $this->response = $productos;
        } else {
            $this->response = array(
                'status' => 'info',
                'message' => 'No se encontraron productos'
            );
        }
    }

    public function search($query) {
        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND (nombre LIKE '%$query%' OR marca LIKE '%$query%')";

        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $productos = array();
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            $this->response = $productos;
        } else {
            $this->response = array(
                'status' => 'info',
                'message' => 'No se encontraron productos que coincidan con la búsqueda'
            );
        }
    }

    public function single($id) {
        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND id = $id";

        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_assoc();
        } else {
            $this->response = array(
                'status' => 'info',
                'message' => 'No se encontró el producto con ID ' . $id
            );
        }
    }

    public function singleByName($nombre) {
        $sql = "SELECT * FROM productos WHERE eliminado = 0 AND nombre = '$nombre'";

        $result = $this->conexion->query($sql);

        if ($result->num_rows > 0) {
            $this->response = $result->fetch_assoc();
        } else {
            $this->response = array(
                'status' => 'info',
                'message' => 'No se encontró el producto con nombre ' . $nombre
            );
        }
    }

}

?>