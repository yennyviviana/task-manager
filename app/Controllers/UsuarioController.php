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
            $password = stripslashes($_POST['password']); 

            $usuario = $this->usuario_model->autenticar($nombre_usuario, $password);

            if ($usuario) {
                // sesión con los datos del usuario autenticado
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
                $_SESSION['correo_electronico'] = $usuario['correo_electronico'];
                $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

                header("Location: main.php");
                exit(); 
            } else {
                echo "La contraseña no coincide o el usuario no existe.";
            }
        }
    }

    public function register()
    {
        if ($_POST) {
            $nombre_usuario = stripslashes($_POST['nombre_usuario']);
            $correo_electronico = stripslashes($_POST['correo_electronico']);
            $password = stripslashes($_POST['password']);
            $tipo_usuario = 9;  // Tipo de usuario predeterminado....

            if ($this->usuario_model->registrar($nombre_usuario, $correo_electronico, $password, $tipo_usuario)) {
                echo "Registro exitoso. Ahora puedes iniciar sesión.";
            } else {
                echo "El usuario ya está registrado. Por favor, elija otro nombre de usuario.";
            }
        }
    }
}
?>
