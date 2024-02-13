
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tu Página</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<br><br>



<button name="boton-create" type="button" onclick="location.href='main.php?da=2'">
    Ingresar nueva tarea
</button>

<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">TITULO</th>
        <th scope="col">Descripcion</th>
        <th scope="col">FECHA_CREACION</th>
        <th scope="col">FECHA_VENCIMIENTTO</th>
        <th scope="col">COMPLETADA</th>
        <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
<br><br>

    </tbody>

</table>


<?php

    // Asegurémonos de usar una conexión PDO
    $host = 'localhost';
    $dbname = 'task_manager';
    $username = 'root';
    $password = '';

    try {
        // Crear una instancia de PDO
        $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Configurar el modo de errores para lanzar excepciones en lugar de advertencias
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Imprimir mensaje si la conexión es exitosa (puedes comentar o eliminar esta línea)
        // echo "Conexión exitosa usando PDO";

        $consulta = "SELECT * FROM tareas ORDER BY id";

        // Preparar la consulta
        $stmt = $conexion->prepare($consulta);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados usando fetch() de PDO
        while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
                <td><?php echo $tarea['id']; ?></td>
                <td><?php echo $tarea['titulo']; ?></td>
                <td><?php echo $tarea['descripcion']; ?></td>
                <td><?php echo $tarea['fecha_creacion']; ?></td>
                <td><?php echo $tarea['fecha_vencimiento']; ?></td>
                <td><?php echo $tarea['completada'] ? 'Sí' : 'No'; ?></td>
                <td>
                    <a href="main.php?da=3&lla=<?php echo $tarea['id']; ?>">Editar</a> |
                    <a href="#" onclick="pregunta(<?php echo $tarea['id']; ?>)">Borrar</a>
                </td>
            </tr>
            <?php
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }

    // No olvides cerrar la conexión cuando hayas terminado
    $conexion = null;
    ?>

    </tbody>
</table>

<script>
    function pregunta(id) {
        if (confirm('¿Estás seguro de borrar esta tarea?')) {
            location.href = "main.php?da=4&lla=" + id;
        } else {
            location.href = "main.php?da=2";
        }
    }
</script>

</body>
</html>