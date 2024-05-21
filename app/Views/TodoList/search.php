
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
            <th scope="col">Categoria</th>
            <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
<br><br>

    </tbody>

<?php


$search = $_POST['search'];
$field = isset($_POST['search-field']) ? $_POST['search-field'] : 'titulo'; // Campo predeterminado es 'titulo'

// Asumiendo que $conexion es tu conexión a la base de datos
$stmt = $conexion->prepare("SELECT * FROM tareas WHERE $field LIKE :search ORDER BY $field");
$stmt->bindValue(':search', "%$search%");
$stmt->execute();

// Verifica si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Procesa los resultados
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Muestra solo el campo seleccionado
        echo ucfirst($field) . ": " . $fila[$field] . "<br>";
        echo "<hr>";
    }
} else {
    // Muestra un mensaje de error más profesional
    echo '<div style="text-align: center; padding: 20px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px;">';
    echo '<strong>¡Error!</strong> No se encontraron resultados para la búsqueda en el campo ' . ucfirst($field) . '.';
    echo '</div>';
}






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
                <td><?php echo $tarea['categoria'] ?></td>
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