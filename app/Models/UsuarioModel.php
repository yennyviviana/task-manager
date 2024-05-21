<?php

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($nombre_usuario, $correo_electronico_registro, $contrasena_registro, $tipo_usuario) {
        $nombre_usuario = htmlspecialchars($nombre_usuario);
        $correo_electronico_registro = htmlspecialchars($correo_electronico_registro); // Eliminar el símbolo extra $
        $contrasena_registro = password_hash($contrasena_registro, PASSWORD_DEFAULT); // Eliminar el símbolo extra $

        // Añadir la coma faltante entre correo_electronico_registro y contrasena_registro
        $sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico_registro, contrasena_registro, tipo_usuario) VALUES (:nombre, :correo, :contrasena, :tipo)";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':nombre', $nombre_usuario);
        $stmt->bindParam(':correo', $correo_electronico_registro);
        $stmt->bindParam(':contrasena', $contrasena_registro);
        $stmt->bindParam(':tipo', $tipo_usuario);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log de errores o manejo personalizado
            return false;
        }
    }

    public function obtenerUsuarioPorCorreo($correo_electronico_registro) {
        $correo_electronico_registro = htmlspecialchars($correo_electronico_registro);

        $sql = "SELECT * FROM usuarios WHERE correo_electronico_registro = :correo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo_electronico_registro);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function generarTokenRecuperacion() {
        return bin2hex(random_bytes(32));
    }

    public function actualizarTokenRecuperacion($id_usuario, $tokenRecuperacion) {
        $sql = "UPDATE usuarios SET token_recuperacion = :token, fecha_expiracion_token_recuperacion = ADDTIME(NOW(), '1:00:00') WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':token', $tokenRecuperacion);
        $stmt->bindParam(':id', $id_usuario);
        $stmt->execute();
    }

    public function obtenerUsuarioPorTokenRecuperacion($token) {
        $sql = "SELECT * FROM usuarios WHERE token_recuperacion = :token AND fecha_expiracion_token_recuperacion > NOW()";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
