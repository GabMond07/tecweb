<?php
include('autos.php'); // Incluye el archivo con el registro de autos

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['matricula'])) {
        $matricula = $_GET['matricula'];
        if (isset($parqueVehicular[$matricula])) {
            $auto = $parqueVehicular[$matricula]['Auto'];
            $propietario = $parqueVehicular[$matricula]['Propietario'];
            echo "Información del vehículo con matrícula $matricula:<br>";
            echo "<table border='1'>";
            echo "<tr><th>Detalle</th><th>Datos</th></tr>";
            echo "<tr><td>Marca</td><td>{$auto['marca']}</td></tr>";
            echo "<tr><td>Modelo</td><td>{$auto['modelo']}</td></tr>";
            echo "<tr><td>Tipo</td><td>{$auto['tipo']}</td></tr>";
            echo "<tr><td>Propietario</td><td>{$propietario['nombre']}</td></tr>";
            echo "<tr><td>Ciudad</td><td>{$propietario['ciudad']}</td></tr>";
            echo "<tr><td>Dirección</td><td>{$propietario['direccion']}</td></tr>";
            echo "</table>";
        } else {
            echo "No se encontró información para la matrícula $matricula.";
        }
    } elseif (isset($_GET['mostrar_todos'])) {
        echo "Información de todos los autos registrados:<br>";
        echo "<table border='1'>";
        echo "<tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th>Tipo</th><th>Propietario</th></tr>";
        foreach ($parqueVehicular as $matricula => $info) {
            $auto = $info['Auto'];
            $propietario = $info['Propietario'];
            echo "<tr>";
            echo "<td>$matricula</td>";
            echo "<td>{$auto['marca']}</td>";
            echo "<td>{$auto['modelo']}</td>";
            echo "<td>{$auto['tipo']}</td>";
            echo "<td>{$propietario['nombre']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>

