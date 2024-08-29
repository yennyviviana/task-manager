<?php
class UsuarioModel 
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function autenticar($nombre_usuario, $password)
    {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario=?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            // Verificamos la contraseña encriptada
            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return null;
    }

    public function registrar($nombre_usuario, $correo_electronico, $password, $tipo_usuario = 9)
    {
        // Verificamos si el nombre de usuario ya está registrado
        $check_query = "SELECT * FROM usuarios WHERE nombre_usuario=?";
        $stmt = $this->mysqli->prepare($check_query);
        $stmt->bind_param("s", $nombre_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            return false; // Usuario ya registrado
        }

        // Insertamos el nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (nombre_usuario, correo_electronico, password, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($query);
        // Encriptamos la contraseña antes de guardarla
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sssi", $nombre_usuario, $correo_electronico, $hashed_password, $tipo_usuario);

        return $stmt->execute();
    }
}
?>
