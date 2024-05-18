<?php
// Incluir el archivo de conexión y otras configuraciones necesarias
include 'conexion.php';

// Verificar si se han enviado datos mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviarToken'])) {
    // Obtener el correo electrónico del formulario y aplicar filtrado
    $correo = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    // Verificar si el correo electrónico es válido
    if ($correo) {
        // Generar un token de recuperación aleatorio
        $token = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4);

        // Guardar el token en la base de datos junto con el correo electrónico del usuario
        $sql = "UPDATE usuarios SET token_recuperacion = ? WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $correo);
        $stmt->execute();

        // Enviar el token por correo electrónico (aquí deberías implementar tu lógica para enviar correos electrónicos)
        $mensaje = "Tu token de recuperación es: $token"; // Este es el mensaje que enviarás por correo electrónico

        // Aquí implementa la lógica para enviar el correo electrónico con el token
        // Puedes usar la función mail() de PHP o alguna biblioteca de correo electrónico como PHPMailer

        // Redirigir al usuario a la página para ingresar el token
        header("Location: ../VC/Recuperar_contrasena/Ingresar_token.php");
        exit();
    } else {
        // Correo electrónico inválido, redirigir al usuario de nuevo al formulario de solicitud de token
        header("Location: ../VC/Recuperar_contrasena/Recuperar_password.php");
        exit();
    }
}
?>
