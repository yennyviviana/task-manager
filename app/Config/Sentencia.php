<?php
class Sentencia {

    private $sentencia;
    private $resultado;
    private $conexion;
    private $consulta;
    private $tabla;

    public function __construct($consulta, $conexion, $sentencia = null, $resultado = null, $tabla = null) {
        $this->consulta = $consulta;
        $this->conexion = $conexion;
        $this->sentencia = $sentencia;
        $this->resultado = $resultado;
        $this->tabla = $tabla;
    }

    public function ejecutarConsulta() {
        // Asegurémonos de que la conexión no sea nula antes de ejecutar la consulta
        if ($this->conexion !== null) {
            try {
                $this->sentencia = $this->conexion->prepare($this->consulta);
                $this->sentencia->execute();
                $this->resultado = $this->sentencia->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Error al ejecutar la consulta: ' . $e->getMessage());
            }
        } else {
            // Manejar la falta de conexión
            echo "Error: No hay conexión a la base de datos.";
        }
    }

    public function get_result() {
        return $this->resultado;
    }

    // Insertar, editar, borrar
    public function insertarTarea() {
        try {
            $stmt = $this->conexion->prepare($this->consulta);
            $stmt->execute();
        } catch (PDOException $e) {
            die('Error al ejecutar la operación en la tabla ' . $this->tabla . ': ' . $e->getMessage());
        }
    }


public function insertarUsuario() {
    try {
        $stmt = $this->conexion->prepare($this->consulta);
        $stmt->execute();
    } catch (PDOException $e) {
        die('Error al ejecutar la operación en la tabla ' . $this->tabla . ': ' . $e->getMessage());
    }
}
}
?>
?>
