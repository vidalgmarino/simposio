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

// Realiza la consulta para obtener los datos del usuario y su estado de inscripción
$sql = "SELECT u.nombreCompleto, u.correo, u.carnet, u.telefono, i.aprobado, i.notaderechazo
        FROM usuarios u 
        LEFT JOIN inscripciones i ON u.carnet = i.usuarioCarnet 
        WHERE u.carnet = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $carnet);
    $stmt->execute();
    $stmt->bind_result($nombreCompleto, $correo, $carnet, $telefono, $aprobado, $notaderechazo);

    if ($stmt->fetch()) {
        // Muestra los datos del usuario y su estado de inscripción en un formato HTML
        echo "<div class=\"divDeDatosEspecificos\">";
        echo "<p class=\"parrafoDeDatos\"><span class=\"nombreCampo\">Nombre Completo:</span> <span class=\"datosCampo\">" . $nombreCompleto . "</span></p>";
        echo "<p class=\"parrafoDeDatos\"><span class=\"nombreCampo\">Correo:</span> <span class=\"datosCampo\">" . $correo . "</span></p>";
        echo "<p class=\"parrafoDeDatos\"><span class=\"nombreCampo\">Carnet:</span> <span class=\"datosCampo\">" . $carnet . "</span></p>";
        echo "<p class=\"parrafoDeDatos\"><span class=\"nombreCampo\">Teléfono:</span> <span class=\"datosCampo\">" . $telefono . "</span></p>";
        echo "<p class=\"parrafoDeDatos\"><span class=\"nombreCampo\">Inscrito: </span> <span class=\"datosCampo\">";

        if ($aprobado === null) {
            echo "<span class=\"datosCampo\">Favor de enviar formulario de inscripción.</span>";
        } elseif ($aprobado == 0) {
            echo "<span class=\"datosCampo\" style=\"background-color: yellow; color: black;\">Pendiente de aprobacion</span>";
        } elseif ($aprobado == 1) {
            echo "<span class=\"datosCampo\" style=\"background-color: green;\">Aprobado</span>";
        } elseif ($aprobado == 2) {
            echo "<span class=\"datosCampo\" style=\"background-color: red;\">Rechazado: " . $notaderechazo . "</span>";
        } else {
            echo "<span class=\"datosCampo\">Desconocido</span>";
        }

        echo "</span></p>";
        echo "</div>";
    } else {
        echo "No se encontraron resultados.";
    }
} else {
    echo "Error en la preparación de la consulta: " . $conn->error;
}

// Cierra la conexión y la declaración preparada
$stmt->close();
$conn->close();
?>
