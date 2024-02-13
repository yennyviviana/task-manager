<?php

class CategoriaModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerCategorias() {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarCategoria($nombre) {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log de errores o manejo personalizado
            return false;
        }
    }

    public function obtenerCategoriaPorId($id) {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCategoria($id, $nombre) {
        $sql = "UPDATE categorias SET nombre = :nombre WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log de errores o manejo personalizado
            return false;
        }
    }

    public function eliminarCategoria($id) {
        $sql = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Log de errores o manejo personalizado
            return false;
        }
    }
}

?>
