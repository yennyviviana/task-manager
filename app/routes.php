
<?php

require_once('Config/database.php');
require_once('Models/UsuarioModel.php');
require_once('Controllers/UsuarioController.php');

$usuarioController = new UsuarioController($conexion);

if (isset($_POST['submit_recuperacion'])) {
    $correo_recuperacion = $_POST['correo_recuperacion'];
    $usuarioController->solicitarRecuperacionContrasena($correo_recuperacion);
}

else if (isset($_GET['token'])) {
    $token_recuperacion = $_GET['token'];
    $usuarioController->mostrarFormularioRecuperacion($token_recuperacion);
}

else if (isset($_POST['submit_cambio_contrasena'])) {
    $token_recuperacion = $_POST['token_recuperacion'];
    $nueva_contraseña = $_POST['nueva_contraseña'];
    $usuarioController->cambiarContrasena($token_recuperacion, $nueva_contraseña);
}

// Resto de tu código...

if (isset($_POST['submit_registro'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico_registro = $_POST['correo_electronico_registro'];
    $contrasena_registro = $_POST['contrasena_registro'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $usuarioController->registrarUsuario($nombre_usuario, $correo_electronico_registro, $contrasena_registro, $tipo_usuario);
}

else if (isset($_POST['submit_login'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico_registro = $_POST['correo_electronico_registro'];
    $contrasena_registro = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $usuarioController->login($correo_electronico_registro, $contrasena_registro);
}



?>


