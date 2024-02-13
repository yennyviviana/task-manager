<?php

   
// Incluye el archivo de conexión PDO
require_once('Config/database.php');
// Incluye las clases UsuarioModel y UsuarioController
require_once('Models/UsuarioModel.php');
require_once('Controllers/UsuarioController.php');


// Instancia el controlador de usuarios
$usuarioController = new UsuarioController($conexion);

// Manejar el formulario de registro
if (isset($_POST['submit_registro'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Llama al método registrarUsuario del controlador
    $usuarioController->registrarUsuario($nombre_usuario, $correo_electronico, $contrasena, $tipo_usuario);
}

// Manejar el formulario de inicio de sesión
else if (isset($_POST['submit_login'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $correo_electronico = $_POST['correo_electronico'];
    $contrasena = $_POST['contrasena'];
    $tipo_usuario = $_POST['tipo_usuario'];

    // Llama al método login del controlador
    $usuarioController->login($correo_electronico, $contrasena);
   }

  
// Mostrar la lista de usuarios
$usuarios = $usuarioController->mostrarUsuarios();
echo "<pre>";
print_r($usuarios);
echo "</pre>";
  

?>
