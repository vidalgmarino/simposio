<?php
include '../BD/conexion.php';
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
 <link rel="stylesheet" href="../css/site.css" asp-append-version="true" />
 <br>
<h1>estamos editando TEMATICAS</h1>
<a class="boton" href="Actulizar_inicio.php">Ir a editar INICIO</a>
<a class="boton" href="Tabla_de_datos.php">TABLA REGISTROS</a><br><br>
<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar_datos'])) {
    // Procesar los datos del formulario de actualización aquí
    $titulo1 = $_POST['titulo1'];
    $descripcionR1 = $_POST['descripcionR1'];
    $titulo2 = $_POST['titulo2'];
    $descripcionR2 = $_POST['descripcionR2'];
    $titulo3 = $_POST['titulo3'];
    $descripcionR3 = $_POST['descripcionR3'];
    $titulo4 = $_POST['titulo4'];
    $descripcionR4 = $_POST['descripcionR4'];
    $titulo5 = $_POST['titulo5'];
    $descripcionR5 = $_POST['descripcionR5'];
    $titulo6 = $_POST['titulo6'];
    $descripcionR6 = $_POST['descripcionR6'];
    $descripcionC1 = $_POST['descripcionC1'];
    $expositor1 = $_POST['expositor1'];
    $descripcionC2 = $_POST['descripcionC2'];
    $expositor2 = $_POST['expositor2'];
    $descripcionC3 = $_POST['descripcionC3'];
    $expositor3 = $_POST['expositor3'];
    $descripcionC4 = $_POST['descripcionC4'];
    $expositor4 = $_POST['expositor4'];
    $descripcionC5 = $_POST['descripcionC5'];
    $expositor5 = $_POST['expositor5'];
    $descripcionC6 = $_POST['descripcionC6'];
    $expositor6 = $_POST['expositor6'];

    $sql = "UPDATE datos_pagina SET 
            titulo1 = '$titulo1',
            descripcionR1 = '$descripcionR1',
            titulo2 = '$titulo2',
            descripcionR2 = '$descripcionR2',
            titulo3 = '$titulo3',
            descripcionR3 = '$descripcionR3',
            titulo4 = '$titulo4',
            descripcionR4 = '$descripcionR4',
            titulo5 = '$titulo5',
            descripcionR5 = '$descripcionR5',
            titulo6 = '$titulo6',
            descripcionR6 = '$descripcionR6',
            descripcionC1 = '$descripcionC1',
            expositor1 = '$expositor1',
            descripcionC2 = '$descripcionC2',
            expositor2 = '$expositor2',
            descripcionC3 = '$descripcionC3',
            expositor3 = '$expositor3',
            descripcionC4 = '$descripcionC4',
            expositor4 = '$expositor4',
            descripcionC5 = '$descripcionC5',
            expositor5 = '$expositor5',
            descripcionC6 = '$descripcionC6',
            expositor6 = '$expositor6'";
    
    if (mysqli_query($conn, $sql)) {
        // Si la actualización fue exitosa, redirige o muestra un mensaje de éxito
        echo "Los cambios se han guardado correctamente.";
        // Puedes redirigir al usuario a otra página después de mostrar el mensaje
        // header("Location: otra_pagina.php");
        // exit();
    } else {
        // Si hubo un error en la actualización, muestra un mensaje de error
        echo "Error al actualizar los datos: " . mysqli_error($conn);
    }
}

// Consulta SQL para obtener todos los datos de la tabla "datos_pagina"
$sql = "SELECT * FROM datos_pagina";
$resultado = mysqli_query($conn, $sql);

// Verifica si la consulta fue exitosa
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Mientras haya filas en el resultado, obtén cada fila como un arreglo asociativo
    while ($fila = mysqli_fetch_assoc($resultado)) {
        // Muestra un formulario para cada fila
        echo '<form action="" method="post">';

        echo '<label style="color: white; font-size: 25px;">titulo 1:</label>';
        echo '<input type="text" name="titulo1" value="' . $fila['titulo1'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">descripcion Resumida 1:</label>';
        echo '<input type="text" name="descripcionR1" value="' . $fila['descripcionR1'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">titulo 2:</label>';
        echo '<input type="text" name="titulo2" value="' . $fila['titulo2'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">descripcion Resumida 2:</label>';
        echo '<input type="text" name="descripcionR2" value="' . $fila['descripcionR2'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">titulo 3:</label>';
        echo '<input type="text" name="titulo3" value="' . $fila['titulo3'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">descripcion Resumida 3:</label>';
        echo '<input type="text" name="descripcionR3" value="' . $fila['descripcionR3'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">titulo 4:</label>';
        echo '<input type="text" name="titulo4" value="' . $fila['titulo4'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">descripcion Resumida 4:</label>';
        echo '<input type="text" name="descripcionR4" value="' . $fila['descripcionR4'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">titulo 5:</label>';
        echo '<input type="text" name="titulo5" value="' . $fila['titulo5'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">descripcion Resumida 5:</label>';
        echo '<input type="text" name="descripcionR5" value="' . $fila['descripcionR5'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">titulo 6:</label>';
        echo '<input type="text" name="titulo6" value="' . $fila['titulo6'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">descripcion Resumida 6:</label>';
        echo '<input type="text" name="descripcionR6" value="' . $fila['descripcionR6'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">descripcion Completo 1:</label>';
        echo '<input type="text" name="descripcionC1" value="' . $fila['descripcionC1'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Expositor 1:</label>';
        echo '<input type="text" name="expositor1" value="' . $fila['expositor1'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">descripcion Completo 2:</label>';
        echo '<input type="text" name="descripcionC2" value="' . $fila['descripcionC2'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Expositor 2:</label>';
        echo '<input type="text" name="expositor2" value="' . $fila['expositor2'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">descripcion Completo 3:</label>';
        echo '<input type="text" name="descripcionC3" value="' . $fila['descripcionC3'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Expositor 3:</label>';
        echo '<input type="text" name="expositor3" value="' . $fila['expositor3'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">descripcion Completo 4:</label>';
        echo '<input type="text" name="descripcionC4" value="' . $fila['descripcionC4'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Expositor 4:</label>';
        echo '<input type="text" name="expositor4" value="' . $fila['expositor4'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">descripcion Completo 5:</label>';
        echo '<input type="text" name="descripcionC5" value="' . $fila['descripcionC5'] . '" style="width: 50%;"><br> >';
        echo '<label style="color: white; font-size: 25px;">Expositor 5:</label>';
        echo '<input type="text" name="expositor5" value="' . $fila['expositor5'] . '" style="width: 50%;"><br><br><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">descripcion Completo 6:</label>';
        echo '<input type="text" name="descripcionC6" value="' . $fila['descripcionC6'] . '" style="width: 50%;"><br> ';
        echo '<label style="color: white; font-size: 25px;">Expositor 6:</label>';
        echo '<input type="text" name="expositor6" value="' . $fila['expositor6'] . '" style="width: 50%;"><br><br><br><br>';



         
        echo '<button type="submit" name="guardar_datos">Guardar cambios</button>';
        echo '</form>';
    }
} else {
    // Maneja el caso en que no se encuentren datos en la tabla
    echo "No se encontraron datos para mostrar.";
}
?>
