<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once __DIR__.'/Operacion.php';

        $sum1 = new suma;       //se inicializa valor1 y valor2 con 0
        $sum1->setValor1(10);   //se usa metodo de superclase
        $sum1->setValor2(5);    //se usa metodo de superclase
        $sum1->operar();        //usa metodo propio
        echo '10 + 5 = '.$sum1->getResultado().'<br>';     //usa metodo

        $resta = new resta;
        $resta->setValor1(10);
        $resta->setValor2(5);
        $resta->operar();
        echo '10 - 5 = '.$resta->getResultado();     //usa metodo

        
    ?>
</body>
</html>