<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        ol, ul { 
            list-style-type: none;
        }
    </style>
    <title>Formulario</title>
</head>
<body>
    <h1>Modificar Producto</h1>

    <?php
    // Verificar si se han enviado datos por POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Realizar la conexión a la base de datos
        $link = new mysqli('localhost', 'root', 'Vetealaverga07&', 'marketzone');

        // Comprobar la conexión
        if ($link->connect_errno) {
            die('Falló la conexión: ' . $link->connect_error . '<br/>');
        }

        // Obtener los datos enviados por POST
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $precio = $_POST['precio'];
        $unidades = $_POST['unidades'];
        $detalles = $_POST['detalles'];
        $imagen = $_POST['imagen'];

        // Realizar la consulta SQL para actualizar los datos del producto
        $sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio='$precio', detalles='$detalles', unidades='$unidades', imagen='$imagen' WHERE id = " . $_GET['id'];

        // Ejecutar la consulta
        if ($link->query($sql) === TRUE) {
            echo "Los datos del producto se han actualizado correctamente.";
            echo '<script>window.location.href = "get_productos_xhtml_v2.php";</script>'; // Redirige después de mostrar el mensaje de éxito
        } else {
            echo "Error al actualizar los datos del producto: " . $link->error;
        }

        // Cerrar la conexión
        $link->close();
    }
    ?>

    <form id="miFormulario" method="post">
        <fieldset>
            <legend>Actualiza los datos del producto:</legend>
            <ul>
                <li><label>Nombre:</label> <input type="text" name="nombre" value="<?= !empty($_GET['nombre']) ? $_GET['nombre'] : '' ?>"></li>
                <li><label>Marca:</label> <input type="text" name="marca" value="<?= !empty($_GET['marca']) ? $_GET['marca'] : '' ?>"></li>
                <li><label>Modelo:</label> <input type="text" name="modelo" value="<?= !empty($_GET['modelo']) ? $_GET['modelo'] : '' ?>"></li>
                <li><label>Precio:</label> <input type="text" name="precio" value="<?= !empty($_GET['precio']) ? $_GET['precio'] : '' ?>"></li>
                <li><label>Unidades:</label> <input type="text" name="unidades" value="<?= !empty($_GET['unidades']) ? $_GET['unidades'] : '' ?>"></li>
                <li><label>Detalles:</label> <input type="text" name="detalles" value="<?= !empty($_GET['detalles']) ? $_GET['detalles'] : '' ?>"></li>
                <li><label>Imagen:</label> <input type="text" name="imagen" value="<?= !empty($_GET['imagen']) ? $_GET['imagen'] : '' ?>"></li>
            </ul>
        </fieldset>
        <p>
            <input type="submit" value="Actualizar">
        </p>
    </form>
</body>
</html>

