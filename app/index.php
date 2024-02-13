<?php
 require_once('Config/database.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task-manager</title>
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
 
<!-- registro.html -->
<form action="routes.php" method="POST">
    <label for="nombre_usuario">Nombre del usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required>

    <label for="correo_electronico">Correo Electrónico:</label>
    <input type="email" id="correo_electronico" name="correo_electronico" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <label for="tipo_usuario">Tipo de Usuario:</label>
    <select id="tipo_usuario" name="tipo_usuario" required>
        <option value="administrador">Administrador</option>
        <option value="cliente">Cliente</option>
    </select>

    <input type="submit" name="submit_registro" value="Registrarse">
</form>

</div>


   <!-- login.html -->
<form action="routes.php" method="POST">
    <label for="correo_electronico">Correo Electrónico:</label>
    <input type="email" id="correo_electronico" name="correo_electronico" required>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <input type="submit" name="submit_login" value="Iniciar Sesión">
</form>




</form>
