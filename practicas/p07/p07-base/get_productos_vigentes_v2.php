<?php
header("Content-Type: text/html; charset=UTF-8");

$data = array();

// Create a MySQLi connection
@$link = new mysqli('localhost', 'root', 'Vetealaverga07&', 'marketzone');

// Check the connection
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// Create a table that doesn't return a result set
if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
    // Fetch all rows as an associative array
    $row = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($row as $num => $registro) {
        foreach ($registro as $key => $value) {
            $data[$num][$key] = utf8_encode($value);
        }
    }

    // Free the memory associated with the result
    $result->free();
}

// Close the MySQLi connection
$link->close();

echo <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS</h3>
    <br/>

HTML;

if (!empty($data)) {
    echo <<<HTML
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio</th>
                <th scope="col">Unidades</th>
                <th scope="col">Detalles</th>
                <th scope="col">Imagen</th>
            </tr>
        </thead>
        <tbody>
HTML;

    foreach ($data as $row) {
        echo <<<HTML
        <tr>
            <th scope="row">{$row['id']}</th>
            <td>{$row['nombre']}</td>
            <td>{$row['marca']}</td>
            <td>{$row['modelo']}</td>
            <td>{$row['precio']}</td>
            <td>{$row['unidades']}</td>
            <td>{$row['detalles']}</td>
            <td><img src={$row['imagen']} ></td>
        </tr>
HTML;
    }

    echo <<<HTML
        </tbody>
    </table>
HTML;
} else {
    echo "<p>No hay productos disponibles.</p>";
}

echo <<<HTML
</body>
</html>
HTML;
?>

