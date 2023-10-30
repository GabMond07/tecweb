<?php
include_once __DIR__ . '/database.php';

$data = array('exists' => false);

if (isset($_POST['name'])) {
    $nombre = $_POST['name'];
    $nombre = mysqli_real_escape_string($conexion, $nombre);

    $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $data['exists'] = true;
    }
}

echo json_encode($data);
?>
