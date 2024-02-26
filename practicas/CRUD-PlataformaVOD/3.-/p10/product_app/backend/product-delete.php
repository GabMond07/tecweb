<?php
    use API\Eliminar\Eliminar;
    require_once __DIR__.'/API/start.php';

    $eliminar = new Eliminar('plataformavod');
    $eliminar->delete( $_POST['id'] );
    echo $eliminar->getResponse();
?>