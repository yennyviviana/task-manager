<?php
date_default_timezone_set("America/Bogota");
require_once('Config/database.php');
require 'Controllers/UsuarioController.php';

$controller = new UsuarioController($mysqli);
$controller->register();


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
    <style>
        .responsive {
            max-width: 100%;
            height: auto;
        }
    </style>
    <script>
        function ordenarSelect(id_componente)
        {
            var selectToSort = jQuery('#' + id_componente);
            var optionActual = selectToSort.val();
            selectToSort.html(selectToSort.children('option').sort(function (a, b) {
                return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
            })).val(optionActual);
        }
        $(document).ready(function () {
            ordenarSelect('selectIE');
        });
    </script>
    
</head>
<body>



<!-- Formulario de Registro -->
<form action="" method="post">

<h1><i class="fas fa-users"></i> NUEVO USUARIO</h1>
            <p><b><font size="3" color="#c68615">*Datos obligatorios</font></b></p>

    <label for="nombre_usuario"><i class="fa fa-user"></i> Nombre del usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required>
    <label for="correo_electronico"><i class="fa fa-envelope"></i> Correo Electrónico:</label>
    <input type="email" id="correo_electronico" name="correo_electronico" required>
    <label for="password"><i class="fa fa-lock"></i> Password:</label>
    <input type="password" id="password" name="password" required>
    
    <div class="form-group">
                <label for="tipo_usuario">* Tipo de Usuario:</label>
                <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                    <option value="9">Administrador</option>
                    <option value="2">Cliente</option>
                    <option value="3">Usuario</option>
                </select>
            </div>
    </select>
    <button type="submit" class="btn btn-warning">
        <span class="spinner-border spinner-border-sm"></span>
        REGISTRAR USUARIO
    </button>
    <button type="reset" class="btn btn-dark" onclick="history.back();">
        <img src="public/img/atras.png" width="27" height="27"> REGRESAR
    </button>
</form>
</body>
</html>