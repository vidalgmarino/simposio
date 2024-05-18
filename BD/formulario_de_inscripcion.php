<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.html");
    exit();
}

// Obtener el valor de la sesión y guardarlo en la variable $usuarioCarnet
$usuarioCarnet = $_SESSION['usuario'];

include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo_de_transaccion = $_POST['tipo_transaccion'];
    $Referencia_Bancaria = $_POST['referencia_bancaria'];
    $Monto_Transferido = $_POST['monto_transferido'];
    $banco_destino = $_POST['banco_destino'];
    $FechaInscripcion = $_POST['fecha_transferencia'];
    $cuenta_bancaria = $_POST['cuenta_bancaria'];
    $tipo_de_servicio = $_POST['tipo_servicio']; // Aquí obtenemos el valor del campo oculto tipo_servicio

    // Verificar si ya existe una referencia bancaria igual
    $sql_check_reference = "SELECT * FROM inscripciones WHERE Referencia_Bancaria = '$Referencia_Bancaria'";
    $result = $conn->query($sql_check_reference);
    if ($result->num_rows > 0) {
        echo "<script>alert('Ya existe una referencia bancaria igual a esta');  window.location.href = '../VC/inscripcion.php';</script>";
        exit(); // Salir del script si ya existe una referencia bancaria igual
    }
// Manejar la subida del archivo
$nombreArchivo = $_FILES['adjuntar_boleta']['name'];
$rutaTemporal = $_FILES['adjuntar_boleta']['tmp_name'];
$tamañoArchivo = $_FILES['adjuntar_boleta']['size']; // Obtener el tamaño del archivo en bytes
$limiteTamaño = 10 * 1024 * 1024; // 10 megabytes en bytes

// Verificar si el tamaño del archivo excede el límite
if ($tamañoArchivo > $limiteTamaño) {
    echo "";
    echo "<script>alert('El tamaño del archivo es demasiado grande. Por favor, sube una imagen de menos de 10 megabytes.'); window.location.href = '../VC/inscripcion.php';</script>";
    exit();
}

$rutaDestino = '../boletas/' . $nombreArchivo; // Ruta donde se guardará la imagen en el servidor
 

    // Verificar si ya existe un registro para este usuario y eliminarlo si es necesario
    $sql_delete = "DELETE FROM inscripciones WHERE usuarioCarnet = '$usuarioCarnet'";
    if ($conn->query($sql_delete) === FALSE) {
        echo "Error al eliminar el registro anterior: " . $conn->error;
    }

    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        // Insertar los datos en la tabla 'inscripciones' junto con la ruta de la imagen
        $sql_insert = "INSERT INTO inscripciones (usuarioCarnet, tipo_de_transaccion, Referencia_Bancaria, Monto_Transferido, banco_destino, FechaInscripcion, cuenta_bancaria, tipo_de_servicio, imagen) 
                VALUES ('$usuarioCarnet', '$tipo_de_transaccion', '$Referencia_Bancaria', '$Monto_Transferido', '$banco_destino', '$FechaInscripcion', '$cuenta_bancaria', '$tipo_de_servicio', '$rutaDestino')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>alert('el registro del recibo se a enviado'); window.location.href = '../VC/perfil.php';</script>";
        } else {
            echo "Error al registrar la transacción: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}

$conn->close();
?>
