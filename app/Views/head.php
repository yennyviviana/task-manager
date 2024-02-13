<?php
require_once('Config/database.php');
require_once('Config/sentencia.php');
session_start();

// Verifica si el usuario está autenticado
if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
    // Obtén los datos del usuario desde la base de datos
    $consulta = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $conexion->prepare($consulta);
    $stmt->bindParam(':id', $_SESSION['usuario']);
    $stmt->execute();

    // Verifica si se encontraron datos del usuario
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $username = isset($usuario['nombre']) ? $usuario['nombre'] : '';
    } else {
        // Podrías redirigir a la página de inicio si no se encuentra el usuario en la base de datos
        // header("Location: index.php");
        // exit;
    }
} else {
    // Si no hay sesión activa, podrías redirigir a la página de inicio
    
    //header("Location: index.php");
    // exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do-list</title>
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
    <script src="public/Library/ckeditor/ckeditor.js"></script>
</head>
<body>



<div class="container">
       
    <div id="cerrar">
        <?php if (isset($username) && !empty($username)) : ?>
           <h3>Bienvenido: <?php echo $username; ?>&nbsp;<br></h3>
            <!-- Enlace para cerrar sesión -->
            <a href="Config/cerrar_session.php">Cerrar Sesión</a>
        <?php else : ?>
            <!-- Podrías mostrar un mensaje o redirigir a la página de inicio si el usuario no se encuentra -->
            <!-- header("Location: index.php"); exit; -->
        <?php endif; ?>
    </div>
     </div>
</body>
</html>
