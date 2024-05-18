<?php
// Verifica si la sesión no está iniciada antes de iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si la variable de sesión 'usuario' está establecida
if (!isset($_SESSION['usuario'])) {
    // Si no está establecida, redirige al usuario al índice
    header("Location: ../index.html");
    exit(); // Es importante terminar el script después de redirigir
}

// Incluye el archivo de conexión a la base de datos
include 'conexion.php';

// Obtén el carnet del usuario desde la sesión
$carnet = $_SESSION['usuario'];

// Obtén los datos enviados por el formulario de edición
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

// Actualiza los datos del usuario en la base de datos
$sql = "UPDATE usuarios SET nombreCompleto=?, correo=?, telefono=? WHERE carnet=?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssss", $nombre, $correo, $telefono, $carnet);
    $stmt->execute();

    // Redirige al usuario de vuelta a la página principal o a donde desees
    header("Location: ../VC/perfil.php");
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cierra la conexión y la declaración preparada
$stmt->close();
$conn->close();
?>
