
<?php

session_start();



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
    <title>Crud de Usuarios</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="../../public/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<br><br>


<div class="container">
  


<div class="panel">
    <div class="column">
        <h2>Módulo de Usuarios</h2>
        <ul class="nav">
            <li><i class="fas fa-plus icon"></i><a href="../../register.php">Nuevo Usuario</a></li>
            
        </ul>
    </div>
</div>

    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuario</th>
            <th scope="col">Email</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Tipo</th>
            <th scope="col">Creado en</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>

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

// Realizar la consulta a la base de datos
$consulta = "SELECT * FROM usuarios ORDER BY id_usuario";
$resultado = $mysqli->query($consulta);

// Verificar que la consulta sea exitosa
if (!$resultado) {
    die('Error en la consulta: ' . $mysqli->error);
}

// Crear un array para almacenar los usuarios
$usuarios = [];
while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

// Cerrar la conexión
$mysqli->close();
?>

<!-- Iterar sobre los usuarios -->
<?php foreach ($usuarios as $usuario) : ?>
    <tr>
        <td><?php echo $usuario['id_usuario']; ?></td>
        <td><?php echo $usuario['nombre_usuario']; ?></td>
        <td><?php echo $usuario['correo_electronico_registro']; ?></td>
        <td><?php echo $usuario['contrasena_registro']; ?></td>
        <td><?php echo $usuario['tipo_usuario']; ?></td>
        <td><?php echo $usuario['created_at']; ?></td>
        <td><?php echo $usuario['estado']; ?></td>
        <td>
            <!-- Botón para editar -->  
            <a href="edit.php?da=3&lla=<?php echo $usuario['id_usuario']; ?>" class="btn btn-primary">
                <i class="fas fa-pencil-alt"></i> Editar
            </a>

            <!-- Botón de Borrar -->
            <a href="#" class="btn btn-danger" onclick="borrarUsuario(<?php echo $usuario['id_usuario']; ?>)">
                <i class="fas fa-trash-alt"></i> Borrar
            </a>
        </td>
    </tr>
<?php endforeach; ?>

   
</td>

            </tr>
           
        </tbody>
    </table>


</div>


<script>
function borrarUsuario(id) {
    if (confirm('¿Está seguro de borrar el usuario?')) {
        // Realizar una petición AJAX para borrar el proveedor
        var xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Éxito en la eliminación del proveedor
                    alert('Usuario eliminado correctamente.');
                    // Recargar la página para reflejar los cambios
                    location.reload();
                } else {
                    // Error al eliminar el proveedor
                    alert('Error al eliminar el usuario.');
                }
            }
        };
        
        // Configurar la petición AJAX
        xhr.open('GET', 'delete.php?da=4&lla=' + id, true);
        // Enviar la petición
        xhr.send();
    }
}
 
     
</script>
</body>
</html>
