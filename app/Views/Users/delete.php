<?php
require_once  ("../../Config/db.php");


// Obteniendo los parámetros de la solicitud GET
$llave = $_GET['lla'];

// Preparar la consulta SQL para eliminar el registro de la base de datos
$borrarConsulta = "DELETE FROM usuarios WHERE id_usuario = $llave";

// Crear la conexión a la base de datos
$conexion = new mysqli($host, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


// Ejecutar la consulta para eliminar el registro
if ($conexion->query($borrarConsulta) === TRUE) {
    // Imprimir un mensaje de confirmación
    echo "Usuario eliminado correctamente.";
} else {
    // Imprimir mensaje de error si la consulta de eliminación falla
    echo "Error al intentar eliminar el registro: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
