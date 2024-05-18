<?php
// Incluir el archivo de conexión y otras configuraciones necesarias
include 'conexion.php';

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizarContraseña'])) {
    // Obtener el token y la nueva contraseña del formulario
    $token = $_POST['token'];
    $nuevaContraseña = $_POST['password'];

    // Hash de la nueva contraseña
    $hashedPassword = password_hash($nuevaContraseña, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE usuarios SET contrasena = ?, token_recuperacion = NULL WHERE token_recuperacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashedPassword, $token);
    $stmt->execute();

    // Verificar si se actualizó la contraseña correctamente
    if ($stmt->affected_rows > 0) {
        // Contraseña actualizada con éxito, redirigir al usuario a la página de inicio de sesión
        header("Location: ../InicioSesion.php");
        exit();
    } else {
        // Error al actualizar la contraseña, redirigir al usuario al formulario para ingresar el token nuevamente
        header("Location: ../InicioSesion.php");
        exit();
    }
}
?>
