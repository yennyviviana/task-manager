<?php
require_once('Config/database.php');
require_once('Config/sentencia.php');




session_start();


if(!isset($_SESSION['id_usuario'])){
    header("Location: index.php");
}

$nombre_usuario     = $_SESSION['nombre_usuario'];
$correo_electronico_registro     = $_SESSION['correo_electronico_registro'];
$tipo_usuario     = $_SESSION['tipo_usuario'];



