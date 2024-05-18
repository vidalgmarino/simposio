<?php include 'BD/registroDatos.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/site.css" asp-append-version="true" />
</head>
<body>
<div class="divDeFondo">
    <img class="imgImagenFondo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg/2048px-Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg.png" alt="UMG">
    <div class="registro-box">
        <h2>Registro</h2>
        <form method="post" action="BD/registroDatos.php">
            <div class="input-box">
                <input class="inputsRegistro" type="text" id="nombreCompleto" name="nombreCompleto" required   placeholder="Nombre Completo"/>
            </div>
            
            <div class="input-box">
                <input class="inputsRegistro" type="email" id="correo" name="correo" required placeholder="correo"/>
            </div>

            <div class="input-box">
            <input class="inputsRegistro" type="text" id="carnet" name="carnet" required pattern="\d{4}-\d{2}-\d{1,7}|\d{4}-\d{5}-\d{4}" title="El formato debe ser '1234-12-12345' o '1234-12345-1234'." placeholder="Carneto o DPI"/>
            </div>

            <div class="input-box">
                <input class="inputsRegistro" type="tel" id="telefono" name="telefono" required pattern="[0-9]{8}" title="Número de teléfono: 8 números." placeholder="telefono" />       
            </div>

            <div class="input-box">
                <input class="inputsRegistro" type="password" id="contrasena" name="contrasena" required minlength="8" placeholder="contraseña" />
            </div>

            <button class="botonRegistrar" type="submit">Registrarme</button>
        </form>
        <a class="BotonCambiarAccion" style="text-decoration: none; font-family: Arial, sans-serif;" href="InicioSesion.php">Ya tengo una cuenta</a>
    </div>
</div>
</body>
</html>