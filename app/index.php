<?php
require_once ('Config/database.php');
require 'Config/database.php';
require 'controllers/UsuarioController.php';
session_start();




$controller = new UsuarioController($mysqli);
$controller->login();







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
   <form method="POST"  class="form-background  action="main.php">
				
        <h2><i class="fa fa-sign-in-alt"></i> Login de la App</h2>

        <label for="nombre_usuario"><i class="fa fa-envelope"></i> Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>

        <label for="password"><i class="fa fa-lock"></i> Password:</label>

        <input type="password" id="password" name="password" required>

        <input type="submit" name="submit_login" value="Iniciar Sesión">

       

<br>

<!-- Enlace para recuperar contraseña -->
<a href=""><i class="fa fa-question-circle"></i>¿Olvidaste tu contraseña?</a>

<!-- Enlace para mostrar el formulario de registro -->
<p>¿No tienes una cuenta? <a href="register.php" id="showRegister"><i class="fa fa-user-plus"></i>Regístrate aquí</a></p>
</form>
</div>

    


</body>
</html>
