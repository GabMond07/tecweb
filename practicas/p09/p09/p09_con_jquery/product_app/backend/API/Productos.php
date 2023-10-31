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

    public function add($producto) {
        $data = array(
            'status'  => 'error',
            'message' => 'Ya existe un producto con ese nombre'
        );

        if (!empty($producto)) {
            // SE TRANSFORMA EL STRING DEL JSON A UN OBJETO
            $jsonOBJ = json_decode($producto);

            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql); // Usa $this->conexion para acceder a la conexión

            if ($result !== false) {
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', '{$jsonOBJ->precio}', '{$jsonOBJ->detalles}', '{$jsonOBJ->unidades}', '{$jsonOBJ->imagen}', 0)";
                    if ($this->conexion->query($sql)) {
                        $data['status'] =  "success";
                        $data['message'] =  "Producto agregado";
                    } else {
                        $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                    }
                }

                $result->free();
            }
        }
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function delete($id) {

        $data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($_POST['id']) ) {
            $id = $_POST['id'];
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            if ($this->conexion->query($sql) ) {
                $data['status'] =  "success";
                $data['message'] =  "Producto eliminado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
        // SE HACE LA CONVERSIÓN DE ARRAY A JSON
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function edit($producto) {
        $data = array(
            'status'  => 'error',
            'message' => 'No es posible actualizar'
        );
        
        if (isset($producto)) {
        
            $jsonOBJ = json_decode($producto);
            $sql_1 = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' and marca = '{$jsonOBJ->marca}' and modelo = '{$jsonOBJ->modelo}' and precio = {$jsonOBJ->precio} and detalles = '{$jsonOBJ->detalles}' and unidades = {$jsonOBJ->unidades} and imagen = '{$jsonOBJ->imagen}'";
        
            $res = $this->conexion->query($sql_1);
        
            if ($res->num_rows == 0) {
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = '{$jsonOBJ->id}'";
                $result = $this->conexion->query($sql);
        
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $data['status'] =  "success";
                    $data['message'] =  "Producto actualizado";
                } else {
                    $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            } else {
                $data['status'] =  "success";
                $data['message'] =  "No se ha realizado ninguna actualizacion, los datos son los mismos";
            }
        
            $this->conexion->close();
        
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    public function list() {
    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
        // SE OBTIENEN LOS RESULTADOS
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        if(!is_null($rows)) {
            // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
            foreach($rows as $num => $row) {
                foreach($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }
        }
        $result->free();
    } else {
        die('Query Error: '.mysqli_error($this->conexion));
    }
    $this->conexion->close();
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
    }


    public function search($search) {
    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['search']) ) {
        $search = $_GET['search'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        if ( $result = $this->conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
			$rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
		$this->conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function single($id) {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $this->conexion->set_charset("utf8");
            $sql = "SELECT * from productos WHERE id = {$id}";
        
            $result = $this->conexion->query($sql);
        
            $json = array();
            while ($row = mysqli_fetch_array($result)) {
                $json[] = array(
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],
                    'imagen' => $row['imagen'],
                    'id' => $row['id']
                );
            }
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    }

    public function singleByName($nombre) {

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $this->conexion->set_charset("utf8");
            $sql = "SELECT * FROM productos WHERE eliminado = 0 AND nombre = '$nombre'";
        
            $result = $this->conexion->query($sql);
        
            $json = array();
            while ($row = mysqli_fetch_array($result)) {
                $json[] = array(
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],
                    'imagen' => $row['imagen'],
                    'id' => $row['id']
                );
            }
            $jsonstring = json_encode($json[0]);
            echo $jsonstring;
        }
    }
}
?>