<?php

use API\Leer\Leer;

require_once __DIR__.'/API/start.php';

$single = new Leer('plataformavod');
$single->single($_POST['id']);
echo $single->getResponse();
