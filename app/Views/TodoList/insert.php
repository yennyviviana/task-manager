<?php
require_once('Controllers/UsuarioController.php');
require_once('Config/Sentencia.php');

// pregunta si el boton se presiono................
if (isset($_POST['submit'])) {

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['ID'])) {

        //capturar los datos enviados POST.............
        $titulo = $_POST['Titulo'];
        $Descripcion = $_POST['Descripcion'];
        $Fecha_creacion = $_POST['Fecha_creacion'];
        $Fecha_vencimiento = $_POST['Fecha_vencimiento'];
        $completada = isset($_POST['completada']) ? 1 : 0;
        $Categoria = $_POST['Categoria'];

        // Define la consulta SQL para insertar la tarea
        $insertarTarea = "INSERT INTO tareas( Titulo, Descripcion, Fecha_creacion, Fecha_vencimiento, completada, Categoria) VALUES ('$Titulo', '$Descripcion', '$Fecha_creacion', '$Fecha_vencimiento', '$completada','$Categoria')";


        
       // Verificar si las constantes ya están definidas antes de definirlas
       if (!defined('db_host')) {
        define('db_host', 'localhost');
    }
    if (!defined('db_username')) {
        define('db_username', 'root');
    }
    if (!defined('db_password')) {
        define('db_password', '');
    }
    if (!defined('db_dbname')) {
        define('db_dbname', 'tareas');
    }
    
    try {
        /// Conectar a MySQL y seleccionar la base de datos
        $mysqli = mysqli_connect(db_host, db_username, db_password, db_dbname);
    
    
    // Verificar que la conexión sea exitosa
    if (!$mysqli) {
        die('Error al conectarse a MySQL: ' . mysqli_connect_error());
    }
    
    // Establecer juego de caracteres UTF-8
    mysqli_set_charset($mysqli, 'utf8');
    
    // Realizar la consulta a la base de datos
    $consulta = "SELECT * FROM  tareas ORDER BY ID";
    $resultado = $mysqli->query($consulta);
    
    // Verificar que la consulta sea exitosa
    if (!$resultado) {
        die('Error en la consulta: ' . $mysqli->error);
    }

      
        
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

                <label for="categoria" class="formulario-field">Categoría:</label>
<select name="categoria" class="formulario-input" required="required">
    <option value="">Seleccionar categoría</option>
    <option value="escolar">Escolar</option>
    <option value="trabajo">Trabajo</option>
    <option value="area">Area</option>
    <option value="tiempo">Tiempo</option>
    <option value="proyecto">Proyecto</option>
</select>

            </select>
        </fieldset>

            </fieldset>

            <input type="submit" name="submit" value="submit" class="formulario-submit">
        </form>
    </div>

</body>

</html>