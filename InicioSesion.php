<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="css/site.css" asp-append-version="true" />
</head>
<body>
    
<div class="divDeFondo">
    <img class="imgImagenFondo" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg/2048px-Escudo_de_la_universidad_Mariano_G%C3%A1lvez_Guatemala.svg.png" alt="UMG">
    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form id="loginForm" action="BD/iniciosesionDatos.php" method="post">
            <div class="user-box">
            <input type="text" name="carnet" required pattern="\d{4}-\d{2}-\d{1,7}|\d{4}-\d{5}-\d{4}" title="El formato debe ser Carnet:'1234-12-12345' o DPI:'1234-12345-1234'." placeholder="Ingrese su carnet o DPI">

            </div>
            <div class="user-box">
                <input type="password" name="password" required  placeholder="Ingrese su contraseña">

            </div>
            <button class="botonEntrar" type="submit" id="btnEntrar">Entrar</button>
        </form>
        <a class="BotonCambiarAccion" href="VC/Recuperar_contrasena/Recuperar_password.php" style="text-decoration: none; font-family: Arial, sans-serif;">Olvidé mi contraseña</a> <br /><br />
        <a class="BotonCambiarAccion" href="registro.php" style="text-decoration: none; font-family: Arial, sans-serif;">Quiero registrarme</a>
    </div>
</div>

</body>
<script>
            document.getElementById('loginForm').addEventListener('submit', function (event) {
                var form = event.target;
                var isValid = form.checkValidity();
                if (!isValid) {
                    alert('Por favor, complete todos los campos correctamente.');
                    event.preventDefault(); // Evita que el formulario se envíe
                }
            });
        </script>
</html> 