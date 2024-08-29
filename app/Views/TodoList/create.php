<?php
// Conectar a MySQL y seleccionar la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'tareas');

// Verificar que la conexión sea exitosa
if ($mysqli->connect_errno) {
    die('Error al conectarse a MySQL: ' . $mysqli->connect_error);
}

// Realizar la consulta a la base de datos
$consulta = "SELECT * FROM tareas ORDER BY  ID";
$resultado = $mysqli->query($consulta);

// Verificar que la consulta sea exitosa
if ($resultado) {
    ?>
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
        Crear nueva tarea
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
                <th scope="col">Categoria</th>
             
            </tr>
        </thead>
        <tbody>
            <?php
            while ($tarea = $resultado->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $tarea['ID']; ?></td>
                    <td><?php echo $tarea['Titulo']; ?></td>
                    <td><?php echo $tarea['Descripcion']; ?></td>
                    <td><?php echo $tarea['Fecha_creacion']; ?></td>
                    <td><?php echo $tarea['Fecha_vencimiento']; ?></td>
                    <td><?php echo $tarea['Completada'] ? 'Sí' : 'No'; ?></td>
                    <td><?php echo $tarea['Categoria'] ?></td>
                    <td>
                    <a href="main.php?da=3&lla=<?php echo $tarea['ID']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Editar</a> |
                    <a href="#" onclick="pregunta(<?php echo $tarea['ID']; ?>)" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Borrar</a>

                    </td>
                </tr>
                <?php
            }
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
    <?php
} else {
    die('Error en la consulta: ' . $mysqli->error);
}

// Cerrar la conexión
$mysqli->close();
?>
