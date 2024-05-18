<?php
// Inicia la sesión
session_start();

// Destruye todas las variables de sesión
session_unset();

// Finaliza la sesión
session_destroy();

// Redirige al usuario al index
header("Location: ../index.html");
exit(); // Asegúrate de terminar el script después de redirigir
?>
