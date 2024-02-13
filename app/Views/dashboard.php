<?php
   // Asegurémonos de usar una conexión PDO
   $host = 'localhost';
   $dbname = 'task_manager';
   $username = 'root';
   $password = '';

   try {
       // Crear una instancia de PDO
       $conexion = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);

       // Configurar el modo de errores para lanzar excepciones en lugar de advertencias
       $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       // Obtener estadísticas
       $total_tareas = $conexion->query("SELECT COUNT(*) FROM tareas")->fetchColumn();
       $tareas_completadas = $conexion->query("SELECT COUNT(*) FROM tareas WHERE completada = 1")->fetchColumn();

       // Obtener tareas recientes
       $stmt = $conexion->prepare("SELECT * FROM tareas ORDER BY fecha_creacion DESC LIMIT 3");
       $stmt->execute();
       $tareas_recientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

   } catch (PDOException $e) {
       echo "Error de conexión: " . $e->getMessage();
   }
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



<div class="container">
    <h1>Dashboard - App de Tareas</h1>

    <div class="summary">
        <div class="stats">
            <div class="stat">
                <h2>Total Tareas</h2>
                <p><?php echo $total_tareas; ?></p>
            </div>
            <div class="stat">
                <h2>Tareas Completadas</h2>
                <p><?php echo $tareas_completadas; ?> (<?php echo $total_tareas > 0 ? round(($tareas_completadas / $total_tareas) * 100) : 0; ?>%)</p>
            </div>
            <div class="stat">
                <h2>Tareas Pendientes</h2>
                <p><?php echo $total_tareas - $tareas_completadas; ?></p>
            </div>
        </div>
    </div>

    <div class="tasks">
        <h2>Tareas Recientes</h2>
        <ul>
            <?php foreach ($tareas_recientes as $tarea): ?>
                <li>
                    <?php
                        $titulo = $tarea['titulo'];
                        $descripcion = $tarea['descripcion'];
                        $fecha_creacion = $tarea['fecha_creacion'];
                        $fecha_vencimiento = $tarea['fecha_vencimiento'];
                        $completada = $tarea['completada'];
                    ?>
                    <?php echo $titulo . ' - ' . $fecha_creacion; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

</body>
</html>
