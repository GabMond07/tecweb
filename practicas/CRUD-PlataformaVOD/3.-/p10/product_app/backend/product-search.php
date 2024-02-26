<?php
    use API\Leer\Leer;
    require_once __DIR__.'/API/start.php';

    $buscar = new Leer('plataformavod');
    $buscar->search( $_GET['search'] );
    echo $buscar->getResponse();
?>