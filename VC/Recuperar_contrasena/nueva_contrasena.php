<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
</head>
<body>
    <h2>Ingrese una Nueva Contraseña</h2>
    <form action="../../BD/actulizar_contrasena.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_POST['token']; ?>">
        <label for="password">Nueva Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit" name="actualizarContraseña">Actualizar Contraseña</button>
    </form>
</body>
</html>
