<?php

$servername = "localhost"; // Cambia esto si tu servidor de base de datos no está en localhost
 $username = "root"; // Nombre de usuario de tu base de datos
 $password = ""; // Contraseña de tu base de datos
 $database = "simposio"; // Nombre de la base de datos

 //Crear una conexión
 $conn = new mysqli($servername, $username, $password, $database);




// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// No se realizan consultas en este ejemplo

// Cerrar la conexión
 
?>
