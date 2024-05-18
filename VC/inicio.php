<?php
include '../BD/conexion.php';
// Inicia la sesión para acceder a las variables de sesión
session_start();

// Verifica si la variable de sesión 'usuario' está establecida
if (!isset($_SESSION['usuario'])) {
    // Si no está establecida, redirige al usuario al índice
    header("Location: ../index.html");
    exit(); // Es importante terminar el script después de redirigir
}
$usuario = $_SESSION['usuario'];
// El usuario ha iniciado sesión, puedes mostrar el contenido de la página a continuación
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../css/site.css" asp-append-version="true" />
    <script src="../javascript/codigoJavascript.js" asp-append-version="true"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<div class="page-wrapper">
    <div class="nav-wrapper">
        <div class="grad-bar"></div>
        <nav class="navbar">
            <img class="ImagenLogo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg/2048px-Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg.png" alt="Company Logo">
            
            <div class="menu-toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <ul class="nav no-search">
        
                <li class="nav-item"><a href="inicio.php">Inicio</a></li>
                <li class="nav-item"><a href="tematicas.php">Temáticas</a></li>
                <li class="nav-item"><a href="inscripcion.php">Inscripcion</a></li>
                <li class="nav-item"><a href="perfil.php"><?php echo $usuario; ?></a></li>
              
            </ul>
        </nav>
    </div>
</div>

<body>
    <?php

                  
// Consulta SQL para obtener los datos de la tabla
$sql = "SELECT * FROM datos_pagina";
$resultado = $conn->query($sql);
// Mostrar los datos obtenidos
if ($resultado->num_rows > 0) {
    // Output data of each row
    while($fila = $resultado->fetch_assoc()) {
                  ?>

        <div class="cabezeradeInicio">
            <h1 class="h1EnCabesasoInicio"><?php echo $fila["titulo_inicio"]; ?></h1>
        </div>
   
        <div class="divCentrador">
            <img class="imgImagenFondo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg/2048px-Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg.png" alt="UMG">
                <!-- un maximo de 430 caracteres-->
            <div class="divcentrados">
            <textarea class="textareatituloInicio" readonly> <?php echo $fila["subtitulo1"]; ?> </textarea>
            <textarea class="textareaContenidoInicio" readonly> <?php echo $fila["contenido1"]; ?> </textarea>
            </div>
            <div class="divcentrados">
            <textarea class="textareatituloInicio" readonly><?php echo $fila["subtitulo2"]; ?> </textarea>
            <textarea class="textareaContenidoInicio" readonly><?php echo $fila["contenido2"]; ?></textarea>
            </div>
            <div class="divcentrados">
            <textarea class="textareatituloInicio" readonly><?php echo $fila["subtitulo3"]; ?> </textarea>
            <textarea class="textareaContenidoInicio" readonly><?php echo $fila["contenido3"]; ?></textarea>
            </div>
        </div>

        <div class="botonesdeInicio">
            <a href="inscripcion.php" class="boton">Inscríbete ahora</a>
            <a href="tematicas.php" class="boton">Conoce los temas</a>
        </div>

        <div class="divCentrador2">
            <div class="divcentradosImagen">
            <img class="imagenDeinicio" src="<?php echo $fila["url_imagen"]; ?>" alt="UMG">
            </div>
            <div class="divcentradosTexto">
            <textarea class="textareaDeImagen" readonly><?php echo $fila["contenidoDeImagen"]; ?></textarea>
            </div>
        </div>
        
        
        <div class="PiedePagina">
            <p>&copy; 2024 UMG. Todos los derechos reservados. Política de privacidad | Términos y condiciones</p>
        </div>
        <?php
        }
            }
    ?>
<br><br><br>
</body>
<script>
$(document).ready(function () {
    $("#search-icon").click(function () {
        $(".nav").toggleClass("search");
        $(".nav").toggleClass("no-search");
        $(".search-input").toggleClass("search-active");
    });

    $('.menu-toggle').click(function () {
        $(".nav").toggleClass("mobile-nav");
        $(this).toggleClass("is-active");
    });
});

</script>
</html>