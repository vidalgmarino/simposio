<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Array para almacenar el mensaje de respuesta
$response = array();

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y aplicar filtrado
    $nombreCompleto = filter_input(INPUT_POST, 'nombreCompleto', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $carnet = filter_input(INPUT_POST, 'carnet', FILTER_SANITIZE_STRING);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $contrasena = $_POST['contrasena']; // No filtramos la contraseña porque se va a hashear

    // Hash de la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta para verificar si el carnet ya existe
    $consulta = "SELECT carnet FROM usuarios WHERE carnet = ?";
    $stmtConsulta = $conn->prepare($consulta);
    $stmtConsulta->bind_param("s", $carnet);
    $stmtConsulta->execute();
    $stmtConsulta->store_result();

    // Verificar si el carnet ya existe
    if ($stmtConsulta->num_rows > 0) {
        if ($stmtConsulta->num_rows > 0) {
            // El carnet ya existe, mostrar una alerta de JavaScript
            echo "<script>alert('El carnet o DPI ya existe'); window.location.href = '../registro.php';</script>";
          
        }
        
    }
     else {
        // Preparar la consulta SQL con una declaración preparada
        $sql = "INSERT INTO usuarios (nombreCompleto, correo, carnet, telefono, contrasena) 
                VALUES (?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Vincular parámetros y ejecutar la consulta
            $stmt->bind_param("sssss", $nombreCompleto, $correo, $carnet, $telefono, $hashedPassword);
            if ($stmt->execute()) {
                // Registro exitoso
                $response['success'] = true;
                // Mostrar mensaje de éxito
                echo "<script>alert('¡Te has registrado correctamente! Ahora puedes iniciar sesión.');";
                // Redireccionar a la página de inicio de sesión después de mostrar el mensaje
                echo "window.location.href = '../InicioSesion.php';</script>";
                exit(); 
            } else {
                // Error en la ejecución de la consulta
                $response['success'] = false;
                $response['message'] = "Error al registrar usuario: " . $stmt->error;
                echo json_encode($response);
            }
        } else {
            // Error en la preparación de la consulta
            $response['success'] = false;
            $response['message'] = "Error en la preparación de la consulta: " . $conn->error;
            echo json_encode($response);
        }

        // Cerrar la declaración y la conexión
        $stmt->close();
    }
    $stmtConsulta->close();
    $conn->close();
}
?>
