<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
    <title>Formulario</title>
</head>
<body>
    <h1>Datos Personales</h1>

    <form id="miFormulario" onsubmit="" method="post">
        <fieldset>
            <legend>Actualiza los datos personales de esta persoa:</legend>
            <ul>
                <li><label>Nombre:</label><input type="text" name="name" value="<?= !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] ?>"></li>
                <li><label>Marca:</label> <input type="text" name="marca" value="<?= !empty($_POST['marca'])?$_POST['marca']:$_GET['marca'] ?>"></li>
                <li><label>Modelo:</label><input type="text" name="modelo" value="<?= !empty($_POST['mdelo'])?$_POST['modelo']:$_GET['modelo'] ?>"></li>
                <li><label>Precio:</label> <input type="text" name="precio" value="<?= !empty($_POST['precio'])?$_POST['precio']:$_GET['precio'] ?>"></li>
                <li><label>Detalles:</label><input type="text" name="detalles" value="<?= !empty($_POST['detalles'])?$_POST['detalles']:$_GET['detalles'] ?>"></li>
                <li><label>Unidades:</label> <input type="text" name="unidades" value="<?= !empty($_POST['unidades'])?$_POST['unidades']:$_GET['unidades'] ?>"></li>
                <li><label>Imagen:</label><input type="text" name="imagen" value="<?= !empty($_POST['imagen'])?$_POST['imagen']:$_GET['imagen'] ?>"></li>
            </ul>
        </fieldset>
        <p>
            <input type="submit" value="ENVIAR">
        </p>
    </form>
</body>
</html>