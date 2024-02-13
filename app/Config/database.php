<?php

//configuracion a la base de datos
$host =  'localhost';
$dbname =  'task_manager';
$username = 'root';
$password = '';






try {
  // Crear una instancia de PDO
  $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

  // Configurar el modo de errores para lanzar excepciones en lugar de advertencias
  $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Imprimir mensaje si la conexión es exitosa (puedes comentar o eliminar esta línea)
  // echo "Conexión exitosa usando PDO";
} catch (PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
}







?>