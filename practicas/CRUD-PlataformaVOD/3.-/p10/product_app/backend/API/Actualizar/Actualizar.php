<?php

namespace API\Actualizar;

use API\BD\DataBase;

require_once __DIR__ . '/../BD/DataBase.php';

class Actualizar extends DataBase
{

    public function edit($jsonOBJ)
    {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->response = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if (isset($jsonOBJ->id)) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql =  "UPDATE contenido SET tipo='{$jsonOBJ->tipo}', region='{$jsonOBJ->region}',";
            $sql .= "genero='{$jsonOBJ->genero}', duracion='{$jsonOBJ->duracion}' WHERE id={$jsonOBJ->id}";

            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->response['status'] =  "success";
                $this->response['message'] =  "Actualizado correctamente";
            } else {
                $this->response['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }
}
