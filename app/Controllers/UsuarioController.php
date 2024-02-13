<?php

class UsuarioController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }


    
    public function mostrarUsuarios() {
        $modeloUsuario = new UsuarioModel($this->conexion);
        $usuarios = $modeloUsuario->obtenerUsuarios();

        // Puedes hacer algo con la lista de usuarios, como mostrarla en una vista
        return $usuarios;
    }

    // Resto del código...
    public function registrarUsuario($nombre_usuario, $correo_electronico, $contrasena, $tipo_usuario) {
        $modeloUsuario = new UsuarioModel($this->conexion);

        // Comprobar si el usuario ya existe
        $usuarioExistente = $modeloUsuario->obtenerUsuarioPorCorreo($correo_electronico);

        if (!$usuarioExistente) {
            // Registrar el nuevo usuario
            $registroExitoso = $modeloUsuario->registrarUsuario($nombre_usuario, $correo_electronico, $contrasena, $tipo_usuario);

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

    public function login($correo_electronico, $contrasena) {
        $modeloUsuario = new UsuarioModel($this->conexion);

        // Obtener el usuario por correo electrónico
        $usuario = $modeloUsuario->obtenerUsuarioPorCorreo($correo_electronico);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            // Contraseña válida, iniciar sesión
            session_start();
            $_SESSION['usuario'] = $usuario['id'];
            header("Location: routes.php?da=1");
            exit();
        } else {
            // Usuario o contraseña incorrectos, redirigir a la página de inicio de sesión
            header("Location: index.php");
            exit();
        }
    }
}
?>
