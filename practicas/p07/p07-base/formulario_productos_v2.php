<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Productos</title>
</head>
<body>
    <h1>Registro de Productos</h1>
    <form action="set_producto_v2.php" method="post">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required><br><br>
        
        <label for="marca">Marca:</label>
        <input type="text" name="marca" required><br><br>
        
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" required><br><br>
        
        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br><br>
        
        <label for="detalles">Detalles:</label><br>
        <textarea name="detalles" rows="4" cols="50" required></textarea><br><br>
        
        <label for="unidades">Unidades:</label>
        <input type="number" name="unidades" required><br><br>
        
        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen" required><br><br>


        <input type="submit" value="Registrar Producto">
    </form>
</body>
</html>
