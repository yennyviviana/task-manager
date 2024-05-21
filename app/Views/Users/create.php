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
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<br><br>

<h1>Crud de usuarios</h1>

<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col">Email</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Tipo</th>
            <th scope="col">Creado en</th>
          
        </tr>
    </thead>
    <tbody>
        <?php
        try {
            $host = 'localhost';
            $dbname = 'tareas';
            $username = 'root';
            $password = '';

            $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $consulta = "SELECT * FROM usuarios ORDER BY id_usuario";
            $stmt = $conexion->prepare($consulta);
            $stmt->execute();

            while ($usuario = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $usuario['id_usuario']; ?></td>
                    <td><?php echo $usuario['nombre_usuario']; ?></td>
                    <td><?php echo $usuario['correo_electronico_registro']; ?></td>
                    <td><?php echo $usuario['contrasena_registro']; ?></td>
                    <td><?php echo $usuario['tipo_usuario']; ?></td>
                    <td><?php echo $usuario['created_at']; ?></td>
                    <td>
                    <a href="edit.php?da=3&id_usuario=<?php echo $usuario['id_usuario']; ?>"></a> |
<a href="delete.php?da=4" onclick="pregunta(<?php echo $usuario['id_usuario']; ?>)"></a>

                <?php
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }

        $conexion = null;
        ?>
    </tbody>
</table>


</body>
</html>
