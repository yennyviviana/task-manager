<?php
require_once('../../Controllers/UsuarioController.php');

// pregunta si el boton se presiono................
if (isset($_POST['submit'])) {

    // Verifica si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario_id'])) {

        //capturar los datos enviados POST.............
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo_electronico_registro = $_POST[''];
        $contrasena_registro = $_POST['contrasena_registro'];
        $tipo_usuario = $_POST['tipo_usuario'];

        // Define la consulta SQL para insertar la tarea
        $insertarTarea = "INSERT INTO usuarios( nombre_usuario, correo_electronico_registro, contrasena_registro, tipo_usuario) VALUES ('$titulo', '$descripcion', '$fecha_creacion', '$fecha_vencimiento', '$completada','$categoria')";

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
            $ins->insertarUsuario();
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
?>


