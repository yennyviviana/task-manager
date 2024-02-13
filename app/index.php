<?php
 require_once('Config/database.php');


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tu Página</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>


<div class="container">
   


    <!-- Formulario de Login -->
    <form action="main.php" method="POST"  class="form-background">
        <h2><i class="fa fa-sign-in-alt"></i>Login de la App</h2>
        <label for="correo_electronico"><i class="fa fa-envelope"></i>Correo Electrónico:</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>

        <label for="contrasena"><i class="fa fa-lock"></i>Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>

        <input type="submit" name="submit_login" value="Iniciar Sesión">

        <!-- Enlace para recuperar contraseña -->
        <a href="recuperacion_contraseña.php"><i class="fa fa-question-circle"></i>¿Olvidaste tu contraseña?</a>

        <!-- Enlace para mostrar el formulario de registro -->
        <p>¿No tienes una cuenta? <a href="#" id="showRegister"><i class="fa fa-user-plus"></i>Regístrate aquí</a></p>
    </form>
</div>

    <!-- Formulario de Registro -->
    <form action="routes.php" method="POST" id="registerForm" style="display: none;">
        <label for="nombre_usuario"><i class="fa fa-user"></i>Nombre del usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>

        <label for="correo_electronico"><i class="fa fa-envelope"></i>Correo Electrónico:</label>
        <input type="email" id="correo_electronico_registro" name="correo_electronico" required>

        <label for="contrasena_registro"><i class="fa fa-lock"></i>Contraseña:</label>
        <input type="password" id="contrasena_registro" name="contrasena" required>

        <label for="tipo_usuario"><i class="fa fa-users"></i>Tipo de Usuario:</label>
        <select id="tipo_usuario" name="tipo_usuario" required>
            <option value="administrador">Administrador</option>
            <option value="cliente">Cliente</option>
        </select>

        <input type="submit" name="submit_registro" value="Registrarse">
    </form>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        var showRegisterLink = document.getElementById("showRegister");
        var registerForm = document.getElementById("registerForm");

        showRegisterLink.addEventListener("click", function (event) {
            event.preventDefault();
            if (registerForm.style.display === "none") {
                registerForm.style.display = "block";
            } else {
                registerForm.style.display = "none";
            }
        });
    });
</script>
</body>
</html>
