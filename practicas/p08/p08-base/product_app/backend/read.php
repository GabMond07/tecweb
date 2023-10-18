<?php
include_once __DIR__ . '/database.php';

// Se crea el arreglo que se va a devolver en forma de JSON
$data = array();

if (isset($_POST['id'])) {
    $search = $_POST['id'];

    // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
    $result = $conexion->query("SELECT * FROM productos WHERE id = '$search' OR
        nombre LIKE '%$search%' OR
        marca LIKE '%$search%' OR
        detalles LIKE '%$search%'");

    if ($result) {
        $data = array(); // Inicializamos el arreglo de datos

        while ($row = $result->fetch_assoc()) {
            // Se codifican a UTF-8 los datos y se mapean al arreglo de respuesta
            $producto = array();
            foreach ($row as $key => $value) {
                $producto[$key] = utf8_encode($value);
            }
            $data[] = $producto; // Agregamos el producto al arreglo de datos
        }

        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }
    $conexion->close();
}

// Se hace la conversión del arreglo a JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>

