<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y limpiarlos
    $nombre = limpiar_entrada($_POST["nombre"]);
    $email = limpiar_entrada($_POST["email"]);
    $mensaje = limpiar_entrada($_POST["mensaje"]);

    // Validar los datos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "Por favor, complete todos los campos del formulario.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, introduzca una dirección de correo electrónico válida.";
    } else {
        // Los datos son válidos, puedes procesarlos aquí (enviar correo electrónico, guardar en la base de datos, etc.)
        echo "¡Gracias por tu mensaje, $nombre! Nos pondremos en contacto contigo pronto.";
    }
}

// Función para limpiar la entrada de datos
function limpiar_entrada($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}
?>
