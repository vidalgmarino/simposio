<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Token</title>
</head>
<body>
    <h2>Ingrese el Token de Recuperación</h2>
    <form action="nueva_contrasena.php" method="post">
        <label for="token">Ingrese el token recibido por correo:</label><br>
        <input type="text" id="token" name="token" required><br><br>
        <button type="submit" name="ingresarToken">Verificar Token</button>
    </form>
</body>
</html>
