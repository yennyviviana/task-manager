<?php

require_once(__DIR__ . '/../Models/UsuarioModel.php');



class UsuarioController 
{
    private $usuario_model;

    public function __construct($mysqli)
    {
        $this->usuario_model = new UsuarioModel($mysqli);
       
    }

    public function login()
    {
        if ($_POST) {
            $nombre_usuario = stripslashes($_POST['nombre_usuario']);
            $contrasena_registro = stripslashes($_POST['contrasena_registro']); // Asegúrate de que el nombre del campo coincide

            $usuario = $this->usuario_model->autenticar($nombre_usuario, $contrasena_registro);

            if ($usuario) {
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
                $_SESSION['contrasena_registro'] = $usuario['contrasena_registro'];
                $_SESSION['correo_electronico_registro'] = $usuario['correo_electronico_registro'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

                header("Location: main.php");
                exit(); // Asegúrate de detener la ejecución después de redirigir
            } else {
                echo "La contraseña no coincide o el usuario no existe";
            }
        }
    }

    public function register()
    {
        if ($_POST) {
            $nombre_usuario = stripslashes($_POST['nombre_usuario']);
            $correo_electronico = stripslashes($_POST['correo_electronico_registro']);
            $contrasena = stripslashes($_POST['contrasena_registro']);
            $tipo_usuario = 9;

            if ($this->usuario_model->registrar($nombre_usuario, $correo_electronico, $contrasena, $tipo_usuario)) {
                echo "Registro exitoso. Ahora puedes iniciar sesión.";
            } else {
                echo "El usuario ya está registrado. Por favor, elija otro nombre de usuario.";
            }
        }
    }
}
?>
