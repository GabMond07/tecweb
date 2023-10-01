<?php
// Verifica que el formulario se haya enviado con el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene y valida los datos del formulario
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $detalles = $_POST["detalles"];
    $unidades = intval($_POST["unidades"]);
    $imagen = $_POST["imagen"];

    // Validación de datos
    $errores = [];

    if (empty($nombre) || empty($marca) || empty($modelo) || empty($detalles) || empty($imagen)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    if (!is_numeric($precio) || $precio <= 0) {
        $errores[] = "El precio debe ser un número positivo.";
    }

    if ($unidades <= 0) {
        $errores[] = "Las unidades deben ser un número positivo.";
    }

    if (empty($errores)) {
        // Conexión a la base de datos
        $link = new mysqli('localhost', 'root', 'Vetealaverga07&', 'marketzone');
        
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error);
        }
        
        // Prepara la consulta SQL e inserta el nuevo producto
        
       // $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
        
        // Prepara la consulta SQL e inserta el nuevo producto
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";


        if ($link->query($sql)) {
            echo "<h2>Resumen de Datos Insertados:</h2>";
            echo "<p>Nombre del Producto: $nombre</p>";
            echo "<p>Marca: $marca</p>";
            echo "<p>Modelo: $modelo</p>";
            echo "<p>Precio: $precio</p>";
            echo "<p>Detalles: $detalles</p>";
            echo "<p>Unidades: $unidades</p>";
            echo "<p>Imagen: $imagen</p>";
            echo "<p>Producto insertado con ID: " . $link->insert_id . "</p>";
        } else {
            echo "El Producto no pudo ser insertado =(";
        }
        
        $link->close();
    } else {
        // Muestra los errores
        echo "<h2>Error:</h2>";
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    // Si no se envió el formulario correctamente, muestra un mensaje de error
    echo "Error: El formulario no fue enviado correctamente.";
}
?>
