

<?php

// Verificar si las constantes ya están definidas antes de definirlas
if (!defined('db_host')) {
    define('db_host', 'localhost');
}
if (!defined('db_username')) {
    define('db_username', 'root');
}
if (!defined('db_password')) {
    define('db_password', '');
}
if (!defined('db_dbname')) {
    define('db_dbname', 'tareas');
}

// Conectar a MySQL y seleccionar la base de datos
$mysqli = mysqli_connect(db_host, db_username, db_password, db_dbname);

// Verificar que la conexión sea exitosa
if (!$mysqli) {
    die('Error al conectarse a MySQL: ' . mysqli_connect_error());
}

// Establecer juego de caracteres UTF-8
mysqli_set_charset($mysqli, 'utf8');

?>
