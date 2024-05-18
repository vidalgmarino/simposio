<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario de inicio de sesión y aplicar filtrado
    $carnet = filter_input(INPUT_POST, 'carnet', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];

    // Realizar la consulta SQL para obtener el hash de la contraseña del usuario
    $sql = "SELECT contrasena FROM usuarios WHERE carnet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $carnet);
    $stmt->execute();
    
    // Vincular variables a los resultados
    $stmt->bind_result($contrasena);

    // Obtener resultados
    $stmt->fetch();

    // Verificar si se encontró un usuario con el carnet proporcionado
    if ($contrasena !== null) {
        // Verificar la contraseña utilizando password_verify
        if (password_verify($password, $contrasena)) {
            // Iniciar la sesión
            session_start();

            // Establecer la variable de sesión 'usuario' con el carnet del usuario
            $_SESSION['usuario'] = $carnet;

            // Redirigir al usuario a la página de inicio
            header("Location: ../VC/inicio.php");
            exit(); // Es importante terminar el script después de redirigir al usuario
        } else {
            // Contraseña incorrecta, devolver un mensaje de error
            echo "<script>alert('Credenciales inválidas. Por favor, inténtelo de nuevo.'); window.location='../InicioSesion.php';</script>";
            exit();
        }
    } else {
        // No se encontró ningún usuario con el carnet proporcionado, devolver un mensaje de error
        echo "<script>alert('El carnet o DPI aun no esta registrado.'); window.location='../registro.php';</script>";
        exit();
    }
}
?>
