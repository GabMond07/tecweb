<?php
    use API\Actualizar\Actualizar;
    require_once __DIR__.'/API/start.php';

    $actualizar = new Actualizar('plataformavod');
    $actualizar->edit( json_decode( json_encode($_POST) ) );
    echo $actualizar->getResponse();
?>