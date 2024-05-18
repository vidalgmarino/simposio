<?php

// Incluir el archivo de conexión
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

// Preparar la consulta SQL
$sql = "SELECT COUNT(*) FROM inscripciones WHERE usuarioCarnet = ?";

// Preparar la sentencia
$stmt = $conn->prepare($sql);

// Vincular parámetros
$stmt->bind_param("s", $usuario);

// Ejecutar la consulta
$stmt->execute();

// Vincular el resultado a una variable
$stmt->bind_result($num_rows);

// Obtener el resultado
$stmt->fetch();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripcion</title>
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

        <div class="botonesdeInscripcion">
            <a href="#" class="boton" id="abrirModal">Ver cuentas de bancos</a>
        </div>
            <div id="miModal" class="modalB">
            <div class="modal-contenidoB">
                <span class="cerrarB" id="cerrarModal">&times;</span>
                <h2>Cuentas de bancos</h2>
                <div class="ContenedorclaseCuentasDebanco">
                    <div class="cuentas">
                    <p style="color: #000; font-size: 20px;">Banrural-Ahorro</p>
                    <p style="color: #000; font-size: 20px;">123456789</p>
                    </div>
                    <br><br>
                    <div class="cuentas">
                    <p style="color: #000; font-size: 20px;">Industrial-Ahorro</p>
                    <p style="color: #000; font-size: 20px;">987654321</p>
                    </div>
                    <br><br>
                    <div class="cuentas">
                    <p style="color: #000; font-size: 20px;">G&T-Ahorro</p>
                    <p style="color: #000; font-size: 20px;">1213141516</p>
                    </div>
                </div>
                
            </div>
            </div>
<div class="contenedordeInscripcion">
    <h1>Formulario de Transacción</h1>
    <br>
    <form class="formDeInscripcicon" action="../BD/formulario_de_inscripcion.php" method="post" enctype="multipart/form-data">
        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="tipo_transaccion">Tipo de Transacción:</label>
            <select id="tipo_transaccion" name="tipo_transaccion" required>
                <option value="" disabled selected>Seleccione un tipo de transacción...</option>
                <option value="deposito">Depósito Bancario</option>
                <option value="transferencia">Transferencia Bancaria</option>
            </select>
        </div>


        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="referencia_bancaria">Autorizacion No:</label>
            <input type="number" id="referencia_bancaria" name="referencia_bancaria" inputmode="numeric" required>
        </div>


        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="tipo_servicio">Tipo de Servicio: </label>
            <label class="servicioFormularioInscrip">Inscripción SIMPOSIO</label>
            <input type="hidden" name="tipo_servicio" value="Inscripción SIMPOSIO">
        </div>

        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="monto_transferido">Monto Transferido:</label>
            <input type="number" id="monto_transferido" name="monto_transferido" step="0.01" required>
        </div>

        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="banco_destino">Banco Destino:</label>
            <select id="banco_destino" name="banco_destino" required onchange="seleccionarOpcion()">
                <option value="" disabled selected>Seleccione un banco...</option>
                <option value="industrial">Banco Industrial</option>
                <option value="banrural">Banco Banrural</option>
                <option value="G&T">G&T</option>
            </select>
        </div>


        <div class="ClaseLabelUnion">
    <label class="LabeldeTransaccion" for="fecha_transferencia">Fecha de Transferencia:</label>
    <input type="date" id="fecha_transferencia" name="fecha_transferencia" required>
</div>

        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="cuenta_bancaria">Cuenta Bancaria:</label>
            <select id="cuenta_bancaria" name="cuenta_bancaria" class="servicioFormularioInscrip2">
                <option value="">Cuenta Bancaria</option>
                <option value="123">123</option>
                <option value="456">456</option>
                <option value="789">789</option>
            </select>
        </div>



        <div class="ClaseLabelUnion">
            <label class="LabeldeTransaccion" for="adjuntar_boleta">Adjuntar Boleta de Depósito o Transferencia:</label>
            <input type="file" id="adjuntar_boleta" name="adjuntar_boleta" accept="image/*" required>
        </div>


        <div class="divbotondeEnviarInscripcion">
            <h1 class="mensajeDeadvertencia">    
                <?php 
                if ($num_rows > 0) {
                // Si hay resultados, el usuario está inscrito
                    echo "Ya enviaste el formulario una vez. Si fue aprobado y lo envías de nuevo, espera otra aprobación.";
                } else {
                    // Si no hay resultados, el usuario no está inscrito
                    echo "";
                }  $stmt->close(); ?>  
            </h1>
            <input class="boronEnviarFormulario" type="submit" value="Enviar">
        </div>
    </form>
</div>


<br><br><br><br>
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


    $(document).ready(function(){
        $('input[type="file"]').change(function(){
            if ($(this).val() !== "") {
                $(this).next('label').text($(this).val().replace(/C:\\fakepath\\/i, ''));
            } else {
                $(this).next('label').text('Subir imagen');
            }
        });
    });


    //modal para ver cuentas de bancos
    document.addEventListener('DOMContentLoaded', function() {
  var abrirModal = document.getElementById('abrirModal');
  var cerrarModal = document.getElementById('cerrarModal');
  var modal = document.getElementById('miModal');

  abrirModal.addEventListener('click', function() {
    modal.style.display = 'block';
  });

  cerrarModal.addEventListener('click', function() {
    modal.style.display = 'none';
  });

  window.addEventListener('click', function(event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  });
});

///
</script>


<script>
        function seleccionarOpcion() {
            var bancoDestino = document.getElementById("banco_destino").value;
            var cuentaBancaria = document.getElementById("cuenta_bancaria");

            switch (bancoDestino) {
                case "industrial":
                    cuentaBancaria.value = "123";
                    break;
                case "banrural":
                    cuentaBancaria.value = "456";
                    break;
                case "G&T":
                    cuentaBancaria.value = "789";
                    break;
                default:
                    cuentaBancaria.value = "";
                    break;
            }
        }
    </script>

<script>
    // Obtener la fecha actual en el formato requerido para el atributo "max"
    var fechaActual = new Date().toISOString().split('T')[0];

    // Establecer el atributo "max" del campo de fecha al día actual
    document.getElementById('fecha_transferencia').setAttribute('max', fechaActual);
</script>
</html>
