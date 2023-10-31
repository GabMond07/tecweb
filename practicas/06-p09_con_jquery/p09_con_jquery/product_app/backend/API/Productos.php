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
        $data = array(
            'status' => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );
        
        // Verifica si se han enviado datos a través del formulario
        if (isset($_POST['nombre'])) {
            // Transforma los datos del POST a un objeto JSON
            $jsonOBJ = json_decode(json_encode($_POST));
        
            // Valida los datos antes de insertar
            $nombre = $jsonOBJ->nombre;
            $marca = $jsonOBJ->marca;
            $modelo = $jsonOBJ->modelo;
            $precio = $jsonOBJ->precio;
            $detalles = $jsonOBJ->detalles;
            $unidades = $jsonOBJ->unidades;
            $imagen = $jsonOBJ->imagen;
        
            if (empty($nombre) || empty($marca) || empty($modelo) || empty($precio) || empty($unidades)) {
                $data['message'] = 'Todos los campos requeridos deben estar llenos.';
            } else {
        
            if (empty($nombre) || strlen($nombre) > 100) {
                $data['message'] = 'El nombre debe ser requerido y tener 100 caracteres o menos.';
            } elseif ($marca === 'Seleccionar') {
                $data['message'] = 'Selecciona una marca válida.';
            } elseif (!preg_match('/^[a-zA-Z0-9\s-]{1,25}$/', $modelo)) {
                $data['message'] = 'El modelo debe ser requerido, texto alfanumérico y tener 25 caracteres o menos.';
            } elseif (!is_numeric($precio) || $precio <= 99.99) {
                $data['message'] = 'El precio debe ser requerido y mayor a 99.99.';
            } elseif (!is_numeric($unidades) || $unidades < 0) {
                $data['message'] = 'Las unidades deben ser requeridas y el número registrado debe ser mayor o igual a 0.';
            } elseif (strlen($detalles) > 250) {
                $data['message'] = 'Los detalles deben tener 250 caracteres o menos.';
            } else {
               
                $conexion->set_charset("utf8");
                $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
                $result = $conexion->query($sql);
        
                if ($result->num_rows == 0) {
                    $sql = "INSERT INTO productos VALUES (null, '$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";
                    if ($conexion->query($sql)) {
                        $data['status'] = "success";
                        $data['message'] = "Producto agregado";
                    } else {
                        $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
                    }
                }
        
                $result->free();
                $conexion->close();
            }
        }
        }
        
        // Convierte el array a JSON y lo envía como respuesta
        echo json_encode($data, JSON_PRETTY_PRINT);
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