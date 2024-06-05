<?php
require_once('../../Controllers/UsuarioController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura de datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico_registro = $_POST['correo_electronico_registro'];
    $contrasena_registro = $_POST['contrasena_registro'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Crear una instancia del controlador de usuario
    $usuarioController = new UsuarioController($insertarUsuario, $conexion);

    // Insertar el nuevo usuario
    $resultado = $usuarioController->insertarUsuario($nombre_usuario, $correo_electronico_registro, $contrasena_registro, $tipo_usuario);

    // Verificar si la inserción fue exitosa
    if ($resultado) {
        echo "Usuario insertado correctamente.";
    } else {
        echo "Error al insertar usuario.";
    }
}
?>
