<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registro de Productos</title>
</head>
<body>
    <h1>Registro de Productos</h1>
    <form action="set_producto_v2.php" method="post" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre del Producto:</label>
        <input type="text" name="nombre" required><br><br>
        
        <label for="marca">Marca:</label>
        <select name="marca" required>
            <option value="">Selecciona una marca</option>
            <option value="Marca1">LG</option>
            <option value="Marca2">Logitech</option>
            <option value="Marca2">Samsung</option>
            <option value="Marca2">JBL</option>
            <option value="Marca2">Epson</option>
            <option value="Marca2">Lenovo</option>
            <option value="Marca2">Apple</option>
            <option value="Marca2">Sony</option>
            <option value="Marca2">HP</option>


        </select><br><br>
        
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo"><br><br>
        
        <label for="precio">Precio:</label>
        <input type="number" name="precio" step="0.01" required><br><br>
        
        <label for="detalles">Detalles:</label><br>
        <textarea name="detalles" rows="4" cols="50" maxlength="250"></textarea><br><br>
        
        <label for="unidades">Unidades:</label>
        <input type="number" name="unidades" required><br><br>
        
        <label for="imagen">Imagen:</label>
        <input type="text" name="imagen"><br><br>

        <input type="submit" value="Registrar Producto">
    </form>

    <script>
        function validarFormulario() {

            var nombre = document.querySelector('input[name="nombre"]');
            var marca = document.querySelector('select[name="marca"]');
            var modelo = document.querySelector('input[name="modelo"]');
            var precio = document.querySelector('input[name="precio"]');
            var detalles = document.querySelector('textarea[name="detalles"]');
            var unidades = document.querySelector('input[name="unidades"]');
            var imagen = document.querySelector('input[name="imagen"]');

            // Validar nombre
            if (nombre.value.length === 0 || nombre.value.length > 100) {
                alert("El nombre debe ser requerido y tener 100 caracteres o menos.");
                return false;
            }

            // Validar marca
            if (marca.value === "") {
                alert("Debes seleccionar una marca.");
                return false;
            }

            // Validar modelo
            if (modelo.value.length === 0 || modelo.value.length > 25 || !/^[a-zA-Z0-9]+$/.test(modelo.value)) {
                alert("El modelo debe ser requerido, texto alfanumérico y tener 25 caracteres o menos.");
                return false;
            }

            // Validar precio
            if (parseFloat(precio.value) <= 99.99) {
                alert("El precio debe ser mayor a 99.99.");
                return false;
            }

            // Validar detalles (opcional)
            if (detalles.value.length > 250) {
                alert("Los detalles deben tener 250 caracteres o menos.");
                return false;
            }

            // Validar unidades
            if (parseInt(unidades.value) < 0) {
                alert("Las unidades deben ser un número mayor o igual a 0.");
                return false;
            }

            // Validar imagen 
            if (imagen.value === "") {
                alert("Ruta por defecto para el producto img/ruta_por_defecto.jpg");
                imagen.value = "img/ruta_por_defecto.jpg";
            }
            return true;
        }
    </script>
</body>
</html>

