<?php
require_once('Controllers/UsuarioController.php');

// pregunta si el boton se presiono................
if (isset($_POST['submit'])) {

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario_id'])) {

        //capturar los datos enviados POST.............
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha_creacion = $_POST['fecha_creacion'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $completada = isset($_POST['completada']) ? 1 : 0;

        // Define la consulta SQL para insertar la tarea
        $insertarTarea = "INSERT INTO tareas( titulo, descripcion, fecha_creacion, fecha_vencimiento, completada) VALUES ('$titulo', '$descripcion', '$fecha_creacion', '$fecha_vencimiento', '$completada')";

        // Asegurémonos de usar una conexión PDO
        $host = 'localhost';
        $dbname = 'tareas';
        $username = 'root';
        $password = '';

        try {
            // Crear una instancia de PDO
            $conexion = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);

            // Configurar el modo de errores para lanzar excepciones en lugar de advertencias
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Imprimir mensaje si la conexión es exitosa (puedes comentar o eliminar esta línea)
            // echo "Conexión exitosa usando PDO";

            // Asumiendo que $conexion es una conexión PDO, ajusta según sea necesario
            $ins = new Sentencia($insertarTarea, $conexion);
            $ins->insertarTarea();
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
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
    <title>Todo-Insert</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>

<body>

    <div class="formulario-insertar">

        <form action="main.php?da=2" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Detalles de la Tarea</legend>

                <label for="titulo" class="formulario-field">Título:</label>
                <input type="text" name="titulo" class="formulario-input" required="required"
                    placeholder="Ingresar título">

                <textarea name="descripcion" rows="4" cols="50" required="required" placeholder="Descripcion"
                    class="ckeditor"> </textarea><br>

                <label for="fecha_creacion" class="formulario-field">Fecha de Creación:</label>
                <input type="date" name="fecha_creacion" class="formulario-input" required="required">

                <label for="fecha_vencimiento" class="formulario-field">Fecha de Vencimiento:</label>
                <input type="date" name="fecha_vencimiento" class="formulario-input" required="required">

                <label for="completada" class="formulario-field">Completada:</label>
                <input type="checkbox" name="completada" class="formulario-input">

            </fieldset>

            <input type="submit" name="submit" value="submit" class="formulario-submit">
        </form>
    </div>

</body>

</html>
