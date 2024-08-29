<?php
require_once('../../Controllers/UsuarioController.php');
require_once('../../Config/Sentencia.php');

// pregunta si el boton se presiono................
if (isset($_POST['submit'])) {

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['id_contacto'])) {

        //capturar los datos enviados POST.............
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $mensaje = $_POST['mensaje'];
        $estado = $_POST['estado'];
        $fecha = $_POST['fecha'];
        

        // Define la consulta SQL para insertar la tarea
        $insertarTarea = "INSERT INTO  contactos( nombre, email, mensaje, estado, fecha) VALUES ('$nombre', '$email', '$mensaje, '$estado',  '$fecha')";


        
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
    $consulta = "SELECT * FROM   contactos ORDER BY  id_contacto";
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Todo-Insert</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Incluimos el CSS de CKEditor -->
   <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
   <link href="../../public/css/style.css" type="text/css" rel="stylesheet">
</head>

<body>

    <div class= "container">

    <div class="formulario-insertar">

    <form action="" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Detalles de la Tarea</legend>

            <label for="nombre" class="formulario-field">Nombre:</label>
            <input type="text" name="nombre" class="formulario-input" required="required" placeholder="Ingresar nombre">

            <label for="email" class="formulario-field">Email:</label>
            <input type="email" name="email" class="formulario-input" required="required" placeholder="Ingresar email">

            <label for="categoria" class="formulario-field">Estado:</label>
            <select name="categoria" class="formulario-input" required="required">
                <option value="">Seleccionar...</option>
                <option value="sin contesta">Peticion</option>
                <option value="recepcion">Queja y/o reclamo/option>
                <option value="procesado">Informacion</option>
            </select>

            <label for="mensaje" class="formulario-field">Mensaje:</label>
            <textarea name="mensaje" rows="4" cols="50" required="required" placeholder="Mensaje" class="ckeditor"></textarea><br>

            <label for="fecha" class="formulario-field">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="formulario-input" required="required">
        </fieldset>

        <input type="submit" name="submit" value="submit" class="formulario-submit">
    </form>

<script>
    // Capturar la fecha actual
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    // Rellenar automáticamente el campo de fecha con la fecha actual
    document.getElementById('fecha').value = today;
</script>

    </div>
    </div>
    </div>
</div>
    <script>
        // Inicializamos CKEditor en el textarea con ID "descripcion"
        CKEDITOR.replace('mensaje');
        </script>
</body>

</html>