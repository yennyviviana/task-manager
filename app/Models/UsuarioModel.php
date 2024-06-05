<?php
class UsuarioModel 
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function autenticar($nombre_usuario, $contrasena_registro)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario=?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            if (sha1($contrasena_registro) === $row['contrasena_registro']) {
                return $row;
            }
        }
        return null;
    }

    public function registrar($nombre_usuario, $correo_electronico_registro, $contrasena_registro, $tipo_usuario = 9)
    {
        $check_query = "SELECT * FROM usuarios WHERE nombre_usuario=?";
        $stmt = $this->mysqli->prepare($check_query);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return false; // Usuario ya registrado
        }

        $query = "INSERT INTO usuarios (nombre_usuario, correo_electronico_registro, contrasena_registro, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($query);
        $hashed_password = sha1($contrasena_registro);
        $stmt->bind_param("sssi", $nombre_usuario, $correo_electronico_registro, $hashed_password, $tipo_usuario);

        return $stmt->execute();
    }
}
?>
