<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once __DIR__.'/tabla.php';

        $tab1 = new tabla(2,3,'border: 5px solid; width: 30%; text-align: center;');
        //FIla 0
        $tab1->cargar(0,0,'A'); 
        $tab1->cargar(0,1,'B'); 
        $tab1->cargar(0,2,'C'); 
        //Fila 1
        $tab1->cargar(1,0,'D');
        $tab1->cargar(1,1,'E'); 
        $tab1->cargar(1,2,'F');  

        $tab1->graficar();
    ?>

</body>
</html>