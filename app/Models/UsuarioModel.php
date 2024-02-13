<?php

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrarUsuario($nombre_usuario, $correo_electronico, $contrasena, $tipo_usuario) {
        $nombre_usuario = htmlspecialchars($nombre_usuario);
        $correo_electronico = htmlspecialchars($correo_electronico);
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, tipo_usuario) VALUES (:nombre, :correo, :contrasena, :tipo)";
        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':nombre', $nombre_usuario);
        $stmt->bindParam(':correo', $correo_electronico);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':tipo', $tipo_usuario);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log de errores o manejo personalizado
            return false;
        }
    }




    public function obtenerUsuarioPorCorreo($correo_electronico) {
        $correo_electronico = htmlspecialchars($correo_electronico);

        $sql = "SELECT * FROM usuarios WHERE correo_electronico = :correo";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':correo', $correo_electronico);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function generarTokenRecuperacion() {
        return bin2hex(random_bytes(32));
    }

    public function actualizarTokenRecuperacion($idUsuario, $tokenRecuperacion) {
        $sql = "UPDATE usuarios SET token_recuperacion = :token, fecha_expiracion_token_recuperacion = ADDTIME(NOW(), '1:00:00') WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':token', $tokenRecuperacion);
        $stmt->bindParam(':id', $idUsuario);
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
