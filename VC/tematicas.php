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
    <title>Tematicas</title>
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
    <main>
    <?php

                  
// Consulta SQL para obtener los datos de la tabla
$sql = "SELECT * FROM datos_pagina";
$resultado = $conn->query($sql);
// Mostrar los datos obtenidos
if ($resultado->num_rows > 0) {
    // Output data of each row
    while($fila = $resultado->fetch_assoc()) {
                  ?>
        <nav2 class='nav2'>
            <ion-icon class='btn prev' name="arrow-back-outline"></ion-icon>
            <ion-icon class='btn next' name="arrow-forward-outline"></ion-icon>
        </nav2>
        <ul class='slider'>
            <li class='item' style="background-image: url('https://cdn03.blog.ostwestfalen.ihk.de/wp-content/uploads/2019/09/AdobeStock_263697323-1131x720.jpeg')">
                <div class='content'>
                    <h2 class='title'><?php echo $fila["titulo1"]; ?></h2>
                    <p class='description'><?php echo $fila["descripcionR1"]; ?> </p>
                    <button onclick="openModal(1)">Mas Información</button>
                </div>
            </li>
            <li class='item' style="background-image: url('https://teinco.edu.co/wp-content/uploads/2018/03/img_enfingsis.jpg')">
                <div class='content'>
                    <h2 class='title'><?php echo $fila["titulo2"]; ?></h2>
                    <p class='description'><?php echo $fila["descripcionR2"]; ?></p>
                    <button onclick="openModal(2)">Mas Información</button>
                </div>
            </li>
            <li class='item' style="background-image: url('https://th.bing.com/th/id/R.58f007f446732e258b11ceffa0e253b9?rik=g77sp0o%2fKXoCTg&pid=ImgRaw&r=0.jpg')">
                <div class='content'>
                    <h2 class='title'><?php echo $fila["titulo3"]; ?></h2>
                    <p class='description'><?php echo $fila["descripcionR3"]; ?></p>
                    <button onclick="openModal(3)">Mas Información</button>
                </div>
            </li>
            <li class='item' style="background-image: url('https://th.bing.com/th/id/R.56fd3ed1e0c51306a8deadd1933f7185?rik=OrYi67i%2bB75hhQ&pid=ImgRaw&r=0.jpg')">
                <div class='content'>
                    <h2 class='title'><?php echo $fila["titulo4"]; ?></h2>
                    <p class='description'><?php echo $fila["descripcionR4"]; ?></p>
                    <button onclick="openModal(4)">Mas Información</button>
                </div>
            </li>
            <li class='item' style="background-image: url('https://www.vsoftconsulting.com/wp-content/uploads/2019/09/SAVE_20190930_190013.jpg')">
                <div class='content'>
                    <h2 class='title'><?php echo $fila["titulo5"]; ?></h2>
                    <p class='description'><?php echo $fila["descripcionR5"]; ?></p>
                    <button onclick="openModal(5)">Mas Información</button>
                </div>
            </li>
            <li class='item' style="background-image: url('https://th.bing.com/th/id/R.d4b76713e39bef3ff17cdce0a955b98d?rik=pjJ9nRgxtEavUw&pid=ImgRaw&r=0')">
                <div class='content'>
                    <h2 class='title'><?php echo $fila["titulo6"]; ?></h2>
                    <p class='description'><?php echo $fila["descripcionR6"]; ?> </p>
                    <button onclick="openModal(6)">Mas Información</button>
                </div>
            </li>
        </ul>
        <!-- Modales -->
        <!-- Modales -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(1)">&times;</span>
                <h2 class="tituloModal"><?php echo $fila["titulo1"]; ?></h2>
                <p><?php echo $fila["descripcionC1"]; ?>.</p><br><br>
                <p><?php echo $fila["expositor1"]; ?></p>
            </div>
        </div>
 
        <div id="modal2" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(2)">&times;</span>
                <h2 class="tituloModal"><?php echo $fila["titulo2"]; ?></h2>
                <p><?php echo $fila["descripcionC2"]; ?>.</p><br><br>
                <p><?php echo $fila["expositor2"]; ?></p>
            </div>
        </div>
 
        <div id="modal3" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(3)">&times;</span>
                <h2 class="tituloModal"><?php echo $fila["titulo3"]; ?></h2>
                <p><?php echo $fila["descripcionC3"]; ?></p><br><br>
                <p><?php echo $fila["expositor3"]; ?></p>
            </div>
        </div>
 
        <div id="modal4" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(4)">&times;</span>
                <h2 class="tituloModal"><?php echo $fila["titulo4"]; ?></h2>
                <p><?php echo $fila["descripcionC4"]; ?></p><br><br>
                <p><?php echo $fila["expositor4"]; ?></p>
            </div>
        </div>
 
        <div id="modal5" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(5)">&times;</span>
                <h2 class="tituloModal"><?php echo $fila["titulo5"]; ?></h2>
                <p class="parrafoModal"><?php echo $fila["descripcionC5"]; ?></p><br><br>
                <p><?php echo $fila["expositor5"]; ?></p>
            </div>
        </div>
 
        <div id="modal6" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal(6)">&times;</span>
                <h2 class="tituloModal"><?php echo $fila["titulo6"]; ?></h2>
                <p><?php echo $fila["descripcionC6"]; ?></p><br><br>
                <p><?php echo $fila["expositor6"]; ?></p>
            </div>
        </div>
        <?php
        }
            }
    ?>
    </main>  
</body>
</html>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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


const slider = document.querySelector('.slider');

function activate(e) {
    const items = document.querySelectorAll('.item');
    e.target.matches('.next') && slider.append(items[0])
    e.target.matches('.prev') && slider.prepend(items[items.length - 1]);
}

document.addEventListener('click', activate, false);


//modal
// Función para abrir un modal específico
function openModal(modalNum) {
    var modal = document.getElementById('modal' + modalNum);
    modal.style.display = "block";
}

// Función para cerrar un modal específico
function closeModal(modalNum) {
    var modal = document.getElementById('modal' + modalNum);
    modal.style.display = "none";
}
</script>