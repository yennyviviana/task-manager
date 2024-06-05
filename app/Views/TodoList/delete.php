<?php
$llave  = isset($_GET['lla']) ? $_GET['lla'] : null;

// Verificar si $llave no es nulo antes de continuar
if ($llave !== null) {
    // Realizar la operación de borrado en la base de datos
    $borrarConsulta = "DELETE FROM tareas WHERE id = $llave";

    try {
        $sentenciaBorrar = new Sentencia($borrarConsulta, $conexion, 'tareas');
        $sentenciaBorrar->insertarTarea();  // Verifica el método correspondiente para la operación de borrado en tu clase 'Sentencia'
        
        // Redireccionar después de la operación de borrado
       
        exit;  // Importante salir del script después de redireccionar
    } catch (Exception $e) {
        // Asegúrate de que no haya salida antes del header()
        ob_start();  // Inicia el buffer de salida
        echo "Error al intentar borrar la entrada de las tareas: " . $e->getMessage();
        ob_end_flush();  // Enviar el buffer de salida y limpiar el buffer
    }
} else {
    // Asegúrate de que no haya salida antes del header()
    ob_start();  // Inicia el buffer de salida
    echo "Parámetro de la URL incorrecto.";
    ob_end_flush();  // Enviar el buffer de salida y limpiar el buffer
}
?>
