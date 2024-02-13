<?php
$llave  = isset($_GET['lla']) ? $_GET['lla'] : null;

// Verificar si $llave no es nulo antes de continuar
if ($llave !== null) {
    // Realizar la operación de borrado en la base de datos
    $borrarConsulta = "DELETE FROM tareas WHERE id = $llave";

    try {
        $sentenciaBorrar = new Sentencia($borrarConsulta, $conexion, 'tareas');
        $sentenciaBorrar->insertarTarea();  // Verifica el método correspondiente para la operación de borrado en tu clase 'sen'
        header("Location: main.php?da=1");
        exit;  // Importante salir del script después de redireccionar
    } catch (Exception $e) {
        echo "Error al intentar borrar la entrada de las tareas: " . $e->getMessage();
    }
} else {
    echo "Parámetro de la URL incorrecto.";
}
?>
