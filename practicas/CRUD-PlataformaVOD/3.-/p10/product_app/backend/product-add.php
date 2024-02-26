<?php

use API\Crear\Crear;

require_once __DIR__.'/API/start.php';

    $Crear = new Crear('plataformavod');
    $Crear->add( json_decode( json_encode($_POST) ) );
    echo $Crear->getResponse();
?>