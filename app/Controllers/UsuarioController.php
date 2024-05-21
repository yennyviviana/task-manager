<?php

class UsuarioController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario ($nombre_usuario, $correo_electronico_registro, $contrasena_registro, $tipo_usuario) {
        $modeloUsuario = new UsuarioModel($this->conexion);

        // Comprobar si el usuario ya existe
        $usuarioExistente = $modeloUsuario->obtenerUsuarioPorCorreo($correo_electronico_registro);

        if (!$usuarioExistente) {
            // Registrar el nuevo usuario
            $registroExitoso = $modeloUsuario->registrarUsuario($nombre_usuario, $correo_electronico_registro, $contrasena_registro, $tipo_usuario);

            if ($registroExitoso) {
                // Redirigir o realizar otras acciones después del registro exitoso
                header("Location: registro_exitoso.php");
                exit(); // Asegúrate de salir después de redirigir
            } else {
                echo "Error al registrar el usuario. Inténtelo nuevamente.";
            }
        } else {
            // El usuario ya existe, manejar de acuerdo a tus necesidades
            echo "El correo electrónico ya está registrado. Intente con otro.";
        }
    }



    public function login($correo_electronico_registro, $contrasena_registro) {
        $modeloUsuario = new UsuarioModel($this->conexion);

        // Obtener el usuario por correo electrónico
        $usuario = $modeloUsuario->obtenerUsuarioPorCorreo($correo_electronico_registro);

        if ($usuario) {
            // Verificar la contraseña
            if ($usuario['estado'] == 1 && password_verify($contrasena_registro, $usuario['contrasena_registro'])) {
                // Contraseña válida y usuario activo, iniciar sesión
                session_start();
                $_SESSION['usuario'] = $usuario['id'];
                header("Location: dashboard.php"); // Redirigir al panel de control, por ejemplo
                exit();
            } elseif ($usuario['estado'] == 0) {
                // Usuario no activo
                echo "Usuario no activo. Verifica tu correo electrónico para activar tu cuenta.";
            } else {
                // Contraseña incorrecta
                echo "Contraseña incorrecta. Intente de nuevo.";
            }
        } else {
            // Usuario no encontrado
            echo "Usuario no registrado. Regístrate antes de iniciar sesión.";
        }
    }
}
?>

