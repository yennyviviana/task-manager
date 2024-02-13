<?php

class CategoriaController {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function listarCategorias() {
        $categoriaModel = new CategoriaModel($this->conexion);
        return $categoriaModel->obtenerCategorias();
    }

    public function agregarCategoria($nombre) {
        $categoriaModel = new CategoriaModel($this->conexion);
        return $categoriaModel->agregarCategoria($nombre);
    }

    public function obtenerCategoriaPorId($id) {
        $categoriaModel = new CategoriaModel($this->conexion);
        return $categoriaModel->obtenerCategoriaPorId($id);
    }

    public function actualizarCategoria($id, $nombre) {
        $categoriaModel = new CategoriaModel($this->conexion);
        return $categoriaModel->actualizarCategoria($id, $nombre);
    }

    public function eliminarCategoria($id) {
        $categoriaModel = new CategoriaModel($this->conexion);
        return $categoriaModel->eliminarCategoria($id);
    }
}

?>
