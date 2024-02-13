<?php

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }


    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $result = mysqli_query($this->conexion, $sql);

        $usuarios = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $usuarios[] = $row;
        }

        return $usuarios;
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
            echo "Error al registrar el usuario: " . $e->getMessage();
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
}
?>
