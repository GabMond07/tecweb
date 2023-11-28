<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once __DIR__.'/pagina.php';

        $pag1 = new pagina('El callejon del beso', 'El sotano del programador');
        
        for ($i=0; $i < 15; $i++) { 
            $pag1->insertar_cuerpo('Este es el parrafo No. '.($i+1).' que debe aparecer en la página');
        }
        $pag1->graficar();
    ?>
</body>
</html>