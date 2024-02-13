

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
    <title>Página de salida</title>
</head>
<body>

<!-- Contenido de la página -->
<div class="contenido">
    <h1>Página Actual</h1>
    <!-- Tu contenido aquí -->
    <p>Saliste de la Task-manager</p>
    
    <!-- Botón para volver al índice -->
<a href="/proyectos/task-manager/app" class="boton-volver">Volver al Índice</a>

</div>

</body>
</html>


<?php


session_start();

$_SESSION['usuario']="";
session_destroy();

header("Location../index.php");

?>
