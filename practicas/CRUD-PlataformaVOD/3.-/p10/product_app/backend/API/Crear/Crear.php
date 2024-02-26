<?php
namespace API\Crear;

use API\BD\DataBase;

require_once __DIR__ . '/../BD/DataBase.php';

class Crear extends DataBase
{

    public function add($jsonOBJ)
    {
        // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
        $this->response = array(
            'status'  => 'error',
            'message' => 'Ya existe ese titulo'
        );
        if (isset($jsonOBJ->titulo)) {
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM contenido WHERE titulo = '{$jsonOBJ->titulo}' AND eliminado = 0";
            $result = $this->conexion->query($sql);

            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO contenido VALUES (null, '{$jsonOBJ->tipo}', '{$jsonOBJ->region}', '{$jsonOBJ->genero}', '{$jsonOBJ->titulo}', '{$jsonOBJ->duracion}', 0 , 'gabcam071118.rg@gmail.com')";
                if ($this->conexion->query($sql)) {
                    $this->response['status'] =  "success";
                    $this->response['message'] =  "Agregado";
                } else {
                    $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }

            $result->free();
            // Cierra la conexion
            $this->conexion->close();
        }
    }
}
