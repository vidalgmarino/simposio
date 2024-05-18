
<?php
session_start();
include '../BD/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM admin WHERE nombre='$usuario' AND contra='$contraseña'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $usuario;
        header("Location: ../VA/Actualizar_tematicas.php");
        exit;
    } else {
        header("Location: ../VA/login.php");
    }
}

$conn->close();
?>
