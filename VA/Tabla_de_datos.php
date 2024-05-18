<?php
include '../BD/conexion.php';
include '../qr/barcode.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Manejar la acción de Aceptar o Rechazar
if(isset($_POST['action']) && isset($_POST['usuarioCarnet'])) {
  $action = $_POST['action'];
  $usuarioCarnet = $_POST['usuarioCarnet'];
  
  // Obtener el estado actual de la inscripción
  $estado_actual_sql = "SELECT aprobado FROM inscripciones WHERE usuarioCarnet = '$usuarioCarnet'";
  $estado_actual_resultado = mysqli_query($conn, $estado_actual_sql);
  $estado_actual = mysqli_fetch_assoc($estado_actual_resultado)['aprobado'];

  // Actualizar el campo 'aprobado' en la base de datos según la acción
  if($action === "aceptar" && $estado_actual != 1) {
      $estado = 1;
      // Consulta para actualizar el estado en la base de datos
      $update_sql = "UPDATE inscripciones SET aprobado = $estado WHERE usuarioCarnet = '$usuarioCarnet'";
      mysqli_query($conn, $update_sql);
      
      // Generar el código QR SVG
      $generator = new barcode_generator();
      $qr_code_svg = $generator->render_svg("qr", $usuarioCarnet,"");

      // Convertir el código QR SVG a imagen PNG
      $image = $generator->render_image("qr", $usuarioCarnet, "");

      // Guardar la imagen en el servidor
      $qr_image_path = "../CodigosQR/" . $usuarioCarnet . ".png"; // Asegúrate de que el directorio "boletas" exista
      imagepng($image, $qr_image_path);

      // Destruir la imagen para liberar memoria
      imagedestroy($image);

      // Guardar la ruta de la imagen en la base de datos si es necesario
      $update_qr_sql = "UPDATE inscripciones SET qr = '$qr_image_path' WHERE usuarioCarnet = '$usuarioCarnet'";
      mysqli_query($conn, $update_qr_sql);

  } elseif ($action === "rechazar") {
      $estado = 2;
      // Obtener la nota de rechazo del formulario
      $notaRechazo = mysqli_real_escape_string($conn, $_POST['notaRechazo']);
      // Consulta para actualizar el estado y la nota de rechazo en la base de datos
      $update_sql = "UPDATE inscripciones SET aprobado = $estado, notaderechazo = '$notaRechazo' WHERE usuarioCarnet = '$usuarioCarnet'";
      mysqli_query($conn, $update_sql);
  }
}



// Consulta para obtener los datos de la tabla 'inscripciones'
$sql = "SELECT * FROM inscripciones";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla Bootstrap con Opciones</title>
  <!-- Incluye los estilos de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
  <a class="boton" href="Actualizar_tematicas.php">Ir a editar tematicas</a>
  <a class="boton" href="Actulizar_inicio.php">Ir a editar INICIO</a><br><br>
  
    <h1>Tabla con Opciones</h1>
    <!-- Aquí está tu tabla -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Carnet</th>
          <th scope="col">Ver Recibo</th>
          <th scope="col">Aceptar</th>
          <th scope="col">Rechazar</th>
          <th scope="col">Estado</th> <!-- Nueva columna -->
        </tr>
      </thead>
      <tbody>
      <?php
      $contador = 1;
      // Verifica si la consulta fue exitosa
      if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Mientras haya filas en el resultado, obtén cada fila como un arreglo asociativo
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $estado = ''; // Inicializamos la variable estado
    
            // Determinamos el estado según el valor de $aprobado
            if ($fila['aprobado'] == 0) {
                $estado = 'Pendiente';
                $badge_color = 'warning'; // Color amarillo para estado pendiente
            } elseif ($fila['aprobado'] == 1) {
                $estado = 'Aceptado';
                $badge_color = 'success'; // Color verde para estado aceptado
            } elseif ($fila['aprobado'] == 2) {
                $estado = 'Rechazado';
                $badge_color = 'danger'; // Color rojo para estado rechazado
            }
      ?>
        <tr>
          <th scope="row"><?php echo $contador; ?></th>
          <td><?php echo $fila['usuarioCarnet']; ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reciboModal<?php echo $contador; ?>">Ver Recibo</button>
          </td>
          <td>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detallesReciboModal<?php echo $contador; ?>">Detalles del recibo</button>
        </td>
          <td>
            <form method="post">
              <input type="hidden" name="action" value="aceptar">
              <input type="hidden" name="usuarioCarnet" value="<?php echo $fila['usuarioCarnet']; ?>">
              <button type="submit" class="btn btn-success">Aceptar</button>
            </form>
          </td>
          
          <td>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rechazoModal<?php echo $contador; ?>">Rechazar</button>
          </td>
          <td> <!-- Nueva columna -->
            <span class="badge bg-<?php echo $badge_color; ?>"><?php echo $estado; ?></span>
          </td>
        </tr>
        <!-- Modales para mostrar las imágenes -->
        <div class="modal fade" id="reciboModal<?php echo $contador; ?>" tabindex="-1" aria-labelledby="reciboModalLabel<?php echo $contador; ?>" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reciboModalLabel<?php echo $contador; ?>"><?php echo $fila['usuarioCarnet']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <img src="<?php echo $fila['imagen']; ?>" class="img-fluid" alt="<?php echo $fila['usuarioCarnet']; ?>">
              </div>
            </div>
          </div>
        </div>
        
        <!-- Modal para nota de rechazo -->
        <div class="modal fade" id="rechazoModal<?php echo $contador; ?>" tabindex="-1" aria-labelledby="rechazoModalLabel<?php echo $contador; ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="rechazoModalLabel<?php echo $contador; ?>">Nota de Rechazo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form id="rechazoForm<?php echo $contador; ?>" method="post">
                  <input type="hidden" name="action" value="rechazar">
                  <input type="hidden" name="usuarioCarnet" value="<?php echo $fila['usuarioCarnet']; ?>">
                  <div class="mb-3">
                    <label for="notaRechazo<?php echo $contador; ?>" class="form-label">Nota de Rechazo:</label>
                    <textarea class="form-control" id="notaRechazo<?php echo $contador; ?>" name="notaRechazo" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-danger">Enviar Nota de Rechazo</button>
                </form>
              </div>
            </div>
          </div>
        </div>

                <!-- Modal para detalles del recibo -->
        <div class="modal fade" id="detallesReciboModal<?php echo $contador; ?>" tabindex="-1" aria-labelledby="detallesReciboModalLabel<?php echo $contador; ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detallesReciboModalLabel<?php echo $contador; ?>">Detalles del recibo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <h8>Carnet o DDPI: <?php echo $fila['usuarioCarnet']; ?> </h8><br>
                    <h8>Tipo de transaccion: <?php echo $fila['tipo_de_transaccion']; ?></h8><br>
                    <h8>Tipo de servicio: <?php echo $fila['tipo_de_servicio']; ?></h8><br>
                    <h8>Banco destino: <?php echo $fila['Banco_destino']; ?> </h8><br>
                    <h8>Cuenta bancaria: <?php echo $fila['cuenta_bancaria']; ?></h8><br>
                    <h8>No de autorizacion: <?php echo $fila['Referencia_Bancaria']; ?> </h8><br>
                    <h8>Monto transferido: <?php echo $fila['Monto_Transferido']; ?></h8><br>
                    <h8>Fecha de transferencia: <?php echo $fila['FechaInscripcion']; ?> </h8><br>
                    <h8>Nota de rechazo: <?php echo $fila['notaderechazo']; ?></h8><br>
                    <h8>Código QR:</h8> <img src="<?php echo $fila['qr']; ?>" alt="Código QR">
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <?php
          $contador++;
        }
      }
      ?>
      <!-- Agrega más filas según sea necesario -->
      </tbody>
    </table>
  </div>

  <!-- Incluye los scripts de Bootstrap (jQuery requerido) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script para manejar el envío del formulario de rechazo -->
  <script>
  $(document).ready(function(){
    $('form[id^="rechazoForm"]').submit(function(event){
      event.preventDefault(); // Evita la acción predeterminada del formulario
      
      var form = $(this);
      var formData = form.serialize(); // Obtiene los datos del formulario
      
      $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: formData,
        success: function(response){
          // Actualiza la página si es necesario
          location.reload();
        }
      });
    });
  });
  </script>
</body>
</html>
