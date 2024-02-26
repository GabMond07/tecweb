<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
libxml_use_internal_errors(true);
$xml = new DOMDocument();
$documento = file_get_contents('serviciovod4.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);
// o usa $xml->load si prefieres usar la ruta del archivo
$xsd = 'serviciovod.xsd';
if (!$xml->schemaValidate($xsd))
// o usa $xml->schemaValidateSource si prefieres usar el xsd en format string
{
    $errors = libxml_get_errors();
    $noError = 1;
    $lista = '';
    foreach ($errors as $error) {
        $lista = $lista . '[' . ($noError++) . ']: ' . $error->message . ' ';
    }
    echo $lista;
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "Vetealaverga07&";
$dbname = "plataformavod";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Cargar el archivo XML
$xmlDoc = new DOMDocument();
$xmlDoc->load('serviciovod4.xml');

// Obtener las cuentas
$cuentas = $xmlDoc->getElementsByTagName('cuenta');

foreach ($cuentas as $cuenta) {
    // Obtener el correo de la cuenta
    $correo = $cuenta->getAttribute('correo');

    // Verificar si hay algún correo asociado a la cuenta en la base de datos
    $sqlCorreo = "SELECT correo FROM cuenta WHERE correo = '$correo'";
    $resultCorreo = $conn->query($sqlCorreo);

    if ($resultCorreo && $resultCorreo->num_rows == 0) { // Si el correo no existe, entonces se inserta
        // Insertar la cuenta
        $sqlCuenta = "INSERT INTO cuenta (id, correo, eliminado) VALUES (NULL, '$correo', 0)";
        $conn->query($sqlCuenta);

        // Obtener el ID de la cuenta recién insertada
        $idCuenta = $conn->insert_id;

        // Obtener los perfiles de la cuenta
        $perfiles = $cuenta->getElementsByTagName('perfil');

        foreach ($perfiles as $perfil) {
            // Obtener los atributos del perfil
            $usuario = $perfil->getAttribute('usuario');
            $idioma = $perfil->getAttribute('idioma');

            // Insertar el perfil asociado a la cuenta
            $sqlPerfil = "INSERT INTO perfiles (id_perfil, usuario, idioma, eliminado, id_cuenta) 
                          VALUES (NULL, '$usuario', '$idioma', 0, $idCuenta)";
            $conn->query($sqlPerfil);
        }
    } else {
        echo "La cuenta con correo $correo ya existe en la base de datos<br>";
    }
}

// Obtener el contenido
$contenidos = $xmlDoc->getElementsByTagName('contenido');

// Verificar si hay cuentas antes de proceder con el contenido
if (!empty($idCuenta)) {
    foreach ($contenidos as $item) {
        // Obtener el tipo y la región del contenido

        $peliculas = $xmlDoc->getElementsByTagName('peliculas');

        foreach ($peliculas as $pelicula) {
            $tipo_p = $pelicula->getAttribute('tipo');
            $region_p = $pelicula->getAttribute('region');
        
            // Obtener los elementos hijos (títulos) del contenido
            $titulos = $pelicula->getElementsByTagName('titulo');
        
            foreach ($titulos as $titulo) {
                // Obtener los atributos del título
                $duracion = $titulo->getAttribute('duracion');
                $genero = $titulo->parentNode->getAttribute('nombre');
                $nombreTitulo = $titulo->nodeValue;
        
                if ($tipo_p === "Peliculas") {
                    // Insertar el contenido
                    $sqlContenido = "INSERT INTO contenido (id, tipo, region, genero, titulo, duracion, eliminado, correo_cuenta) 
                                    VALUES (NULL, '$tipo_p', '$region_p', '$genero', '$nombreTitulo', '$duracion', 0, '$correo')";
                    if (!$conn->query($sqlContenido)) {
                        echo "Error al insertar contenido: " . $conn->error . "<br>";
                    }
                }
            }
        }
        
        $series = $xmlDoc->getElementsByTagName('series');
        
        foreach ($series as $serie) {
            $tipo_s = $serie->getAttribute('tipo');
            $region_s = $serie->getAttribute('region');
        
            // Obtener los elementos hijos (títulos) del contenido
            $titulos = $serie->getElementsByTagName('titulo');
        
            foreach ($titulos as $titulo) {
                // Obtener los atributos del título
                $duracion = $titulo->getAttribute('duracion');
                $genero = $titulo->parentNode->getAttribute('nombre');
                $nombreTitulo = $titulo->nodeValue;
        
                if ($tipo_s === "Series") {
                    $sqlContenido = "INSERT INTO contenido (id, tipo, region, genero, titulo, duracion, eliminado, correo_cuenta) 
                                    VALUES (NULL, '$tipo_s', '$region_s', '$genero', '$nombreTitulo', '$duracion', 0, '$correo')";
                    if (!$conn->query($sqlContenido)) {
                        echo "Error al insertar contenido: " . $conn->error . "<br>";
                    }
                }
            }
        }
    }
} else {
    echo "<br>";
}


// Cierra la conexión después de realizar todas las inserciones
$conn->close();
?>

<head>
    <title>Tablas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #141414;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            background-color: #000;
            padding: 20px 0;
            text-align: center;
        }

        .header img {
            width: 250px;
            height: 130px;
        }

        h2 {
            color: #fff;
        }

        table {
            width: 100%;
            margin-top: 20px;
            color: #fff;
        }

        th {
            background-color: #000;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        .table-warning {
            background-color: #E50914;
        }

        .table-info {
            background-color: #0047AB;
        }

        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <p style="text-align: center; font-size: 40px;"><img src="logo.jpg" alt="logo" class="rounded"></p>
    </div>

    <div class="container">
        <h2>Peliculas</h2>
        <table>
            <thead>
                <tr>
                    <th colspan="3">Peliculas</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-warning fw-bold">
                    <td>Titulo</td>
                    <td>Género</td>
                    <td>Duración</td>
                </tr>
                <?php
                $xmlDoc = new DOMDocument();
                $xmlDoc->load('serviciovod4.xml');

                $peliculas = $xmlDoc->getElementsByTagName('peliculas');

                foreach ($peliculas as $peliculas) {
                    $genero = $peliculas->getElementsByTagName('genero');

                    foreach ($genero as $genero) {
                        $titulo = $genero->getElementsByTagName('titulo');

                        foreach ($titulo as $titulo) {
                            echo "<tr class='table-warning'>";
                            echo "<td>" . $titulo->nodeValue . "</td>";
                            echo "<td>" . $genero->getAttribute('nombre') . "</td>";
                            echo "<td>" . $titulo->getAttribute('duracion') . "</td>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Series</h2>
        <table>
            <thead>
                <tr>
                    <th colspan="3">Series</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-info fw-bold">
                    <td>Titulo</td>
                    <td>Género</td>
                    <td>Duración</td>
                </tr>
                <?php
                $series = $xmlDoc->getElementsByTagName('series');

                foreach ($series as $series) {
                    $genero = $series->getElementsByTagName('genero');

                    foreach ($genero as $genero) {
                        $titulo = $genero->getElementsByTagName('titulo');

                        foreach ($titulo as $titulo) {
                            echo "<tr class='table-info'>";
                            echo "<td>" . $titulo->nodeValue . "</td>";
                            echo "<td>" . $genero->getAttribute('nombre') . "</td>";
                            echo "<td>" . $titulo->getAttribute('duracion') . "</td>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
