
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
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>


<div class="form-container">

<!-- formulario_recuperacion.php -->
<form action="routes.php" method="POST">
    <label for="token">Token:</label>
    <input type="text" id="token" name="token" required>

    <label for="nueva_contrasena">Nueva Contraseña:</label>
    <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>

    <input type="submit" name="submit_recuperacion" value="Cambiar Contrasena">
</form>
