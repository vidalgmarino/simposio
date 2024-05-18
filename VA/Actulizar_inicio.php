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
<h1>estamos editando Pagina de Inicio</h1>
<a class="boton" href="Actualizar_tematicas.php">Ir a editar tematicas</a>
<a class="boton" href="Tabla_de_datos.php">TABLA REGISTROS</a>
<br>
<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar_datos'])) {
    // Procesar los datos del formulario de actualización aquí
    $nuevoTitulo = $_POST['nuevo_titulo'];
    $nuevoSubtitulo1 = $_POST['nuevo_subtitulo1'];
    $nuevoContenido1 = $_POST['nuevo_contenido1'];
    $nuevoSubtitulo2 = $_POST['nuevo_subtitulo2'];
    $nuevoContenido2 = $_POST['nuevo_contenido2'];
    $nuevoSubtitulo3 = $_POST['nuevo_subtitulo3'];
    $nuevoContenido3 = $_POST['nuevo_contenido3'];
    $nuevoContenidoImagen = $_POST['nuevo_contenido_imagen'];
    $nuevoUrlImagen = $_POST['nuevo_url_imagen'];

    $sql = "UPDATE datos_pagina SET 
            titulo_inicio = '$nuevoTitulo',
            subtitulo1 = '$nuevoSubtitulo1',
            contenido1 = '$nuevoContenido1',
            subtitulo2 = '$nuevoSubtitulo2',
            contenido2 = '$nuevoContenido2',
            subtitulo3 = '$nuevoSubtitulo3',
            contenido3 = '$nuevoContenido3',
            contenidoDeImagen = '$nuevoContenidoImagen',
            url_imagen = '$nuevoUrlImagen'";
    
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
        echo '<label style="color: white; font-size: 25px;">Titulo principal:</label>';
        echo '<input type="text" name="nuevo_titulo" value="' . $fila['titulo_inicio'] . '" style="width: 50%;"><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">Subtitulo 1:</label>';
        echo '<input type="text" name="nuevo_subtitulo1" value="' . $fila['subtitulo1'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Contenido 1:</label>';
        echo '<input type="text" name="nuevo_contenido1" value="' . $fila['contenido1'] . '" style="width: 50%;"><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">Subtitulo 2:</label>';
        echo '<input type="text" name="nuevo_subtitulo2" value="' . $fila['subtitulo2'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Contenido 2:</label>';
        echo '<input type="text" name="nuevo_contenido2" value="' . $fila['contenido2'] . '" style="width: 50%;"><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">Subtitulo 3:</label>';
        echo '<input type="text" name="nuevo_subtitulo3" value="' . $fila['subtitulo3'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">Contenido 3:</label>';
        echo '<input type="text" name="nuevo_contenido3" value="' . $fila['contenido3'] . '" style="width: 50%;"><br><br>';
    
        echo '<label style="color: white; font-size: 25px;">Contenido de imagen:</label>';
        echo '<input type="text" name="nuevo_contenido_imagen" value="' . $fila['contenidoDeImagen'] . '" style="width: 50%;"><br>';
        echo '<label style="color: white; font-size: 25px;">URL de la imagen:</label>';
        echo '<input type="text" name="nuevo_url_imagen" value="' . $fila['url_imagen'] . '" style="width: 50%;"><br><br>';
        
        echo '<button type="submit" name="guardar_datos">Guardar cambios</button>';
        echo '</form>';
    }
} else {
    // Maneja el caso en que no se encuentren datos en la tabla
    echo "No se encontraron datos para mostrar.";
}
?>
