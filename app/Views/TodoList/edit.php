<?php
require_once('Controllers/UsuarioController.php');
require_once('Config/Sentencia.php');

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
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit; // Salir del script si hay un error de conexión
}

// Asumiendo que $conexion es una conexión PDO, ajusta según sea necesario
$llave = $_GET['lla'];

$consulta = "SELECT * FROM tareas WHERE id = $llave";
$consultaNueva = new Sentencia($consulta, $conexion);
$consultaNueva->ejecutarConsulta();
$tarea = $consultaNueva->get_result();

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Todo-Edit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div class="formulario-insertar">
        <form action="main.php?da=3&lla=<?php echo $llave; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="llave" value="<?php echo $llave; ?>">
            <fieldset>
                <legend>Detalles de la Tarea</legend>

                <label for="titulo" class="formulario-field">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo isset($tarea['titulo']) ? $tarea['titulo'] : ''; ?>" required="required" placeholder="Ingresar título">

                <textarea id="descripcion" name="descripcion" rows="4" cols="50" required="required" placeholder="Descripción" class="ckeditor"><?php echo isset($tarea['descripcion']) ? $tarea['descripcion'] : ''; ?></textarea><br>

                <label for="fecha_creacion" class="formulario-field">Fecha de Creación:</label>
                <input type="date" id="fecha_creacion" name="fecha_creacion" value="<?php echo isset($tarea['fecha_creacion']) ? $tarea['fecha_creacion'] : ''; ?>" required="required">

                <label for="fecha_vencimiento" class="formulario-field">Fecha de Vencimiento:</label>
                <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo isset($tarea['fecha_vencimiento']) ? $tarea['fecha_vencimiento'] : ''; ?>" required="required">

                <label for="completada" class="formulario-field">Completada:</label>
                <input type="checkbox" id="completada" name="completada" <?php echo isset($tarea['completada']) && $tarea['completada'] ? 'checked' : ''; ?>>
            </fieldset>

            <label for="categoria" class="formulario-field">Categoría:</label>
            <select name="categoria" class="formulario-input" required="required">
                <option value="">Seleccionar categoría</option>
                <option value="">Escolar</option>
                <option value="">Trabajo</option>
                <option value="">Area</option>
                <option value="">Tiempo</option>
                <option value="">Proyecto</option>

            <input type="submit" name="submit" value="submit" class="formulario-submit">
        </form>
    </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $llave = $_POST['llave'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $completada = isset($_POST['completada']) ? 1 : 0;
    $categoria = $_POST['categoria'];

    $editar = "UPDATE tareas SET titulo = '$titulo', descripcion = '$descripcion', fecha_creacion = '$fecha_creacion', fecha_vencimiento = '$fecha_vencimiento', completada = $completada, categoria = $categoria WHERE id = $llave";

    $edicion = new Sentencia($editar, $conexion);
    $edicion->insertarTarea();

    header("location: main.php?da=1");
    exit; // Importante salir del script después de redireccionar
}

?>
