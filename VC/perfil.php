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
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/site.css" asp-append-version="true" />
    <script src="../javascript/codigoJavascript.js" asp-append-version="true"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
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
    <!-- Contenido de perfil -->
    
    <div class="contenedor_datos_perfil">
        <h1>Datos personales: <?php echo $usuario; ?></h1>
        <br><br>
                <div class="QR">
                <?php
                  // Obtén el usuario que ha iniciado sesión
                  $usuario_sesion = $_SESSION['usuario'];
                  
                  $sql = "SELECT * FROM inscripciones";
                  $result = $conn->query($sql);
                  
                  // Verificar si se encontraron resultados
                  if ($result->num_rows > 0) {
                      // Mostrar los datos obtenidos
                      while ($row = $result->fetch_assoc()) {
                          // Obtener el usuario asociado a esta fila en la tabla de inscripciones
                          $usuario_inscripcion = $row['usuarioCarnet'];
                          
                          // Verificar si el usuario que ha iniciado sesión es el mismo que el usuario asociado a esta fila
                          if ($usuario_sesion === $usuario_inscripcion) {
                              // Obtener la URL de la imagen desde la columna 'qr'
                              $url_imagen = $row['qr'];
                              // Mostrar la imagen dentro de un div con estilo
                              echo "<div style='width: 100%; height: 100%;'><img src='$url_imagen' alt='QR Code' style='width: 100%; height: 100%;'></div>";
                          }
                      }
                  }
                    ?>
                </div>
        <?php
            include '../BD/obtenerDatos.php';
        ?>
   <br>
        <button onclick="mostrarModalEditarDatos()">Editar Datos</button>
         <br><br><br>

        <form action="../BD/cerrarsesion.php" method="post">
            <button type="submit" class="botonCerrarSesion">Cerrar Sesión</button>
        </form>
    </div>

 


<!-- Agrega esto al final del archivo, antes de </body> -->
<div id="modalEditarDatos" class="modalED">
  <div class="modalED-contenido editar-datos">
    <!-- Aquí va el formulario -->
    <form action="../BD/actualizar_datos_personales.php" method="post">
        <label class="label_de_edNombre" for="nombreEditar">Nombre Completo:</label>
        <input class="input_de_edNombre" type="text" id="nombreEditar" name="nombre" value="<?php echo $nombreCompleto; ?>"><br>

        <label class="label_de_edCorreo" for="correoEditar">Correo:</label>
        <input class="input_de_edCorreo" type="email" id="correoEditar" name="correo" value="<?php echo $correo; ?>"><br>

        <label class="label_de_edTelefono" for="telefonoEditar">Teléfono:</label>
        <input class="input_de_edTelefono" type="tel" id="telefonoEditar" name="telefono" value="<?php echo $telefono; ?>"><br>

        <button type="submit" name="guardar_datos">Guardar cambios</button>
        <button type="button" onclick="cerrarModalEditarDatos()">Cancelar</button>
    </form>
  </div>
</div>

<script>
// Función para mostrar el modal de editar datos
function mostrarModalEditarDatos() {
  var modalED = document.getElementById("modalEditarDatos");
  modalED.style.display = "block";
  modalED.classList.add("mostrar-modal");
}

// Función para cerrar el modal de editar datos
function cerrarModalEditarDatos() {
  var modalED = document.getElementById("modalEditarDatos");
  modalED.style.display = "none";
  modalED.classList.remove("mostrar-modal");
}
</script>



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
