<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Contacto</title>
    <style>

body {
    
    background-color: hwb(300 2% 98%);
}


/* Estilos generales del cuerpo */
body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #000;
        }

        /* Contenedor principal */
        .container {
            width: 100%;
            max-width: 500px; /* Ajusta el ancho máximo del contenedor */
            margin: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilos del formulario */
        form {
            background-color: blue; 
            padding: 20px;
            border-radius: 8px;
            color: #fff; /* Texto blanco */
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #fff; 
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #333;
            box-sizing: border-box; /* Asegura que el padding no afecte al ancho total */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Contenedor para el mapa de Google */
        #map {
            margin-top: 20px;
            height: 400px; /* Altura fija para el mapa */
        }

        #map iframe {
            width: 100%;
            height: 100%;
            border: 0;
            border-radius: 8px;
        }
    </style>
        
        </style>
</head>
<body>

<div class="container">
    <h2>Formulario de Contacto</h2>
    <form action="enviar.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="mensaje">Mensaje:</label>
        <textarea id="mensaje" name="mensaje" required></textarea>
        
        <button type="submit">Enviar Mensaje</button>
    </form>
</div>

<!-- Contenedor para el mapa de Google -->
<div id="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093726!2d144.9559233153178!3d-37.81720997975162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d43f1f5a2fd%3A0x5045675218ce7e33!2z44CSMzAwMCBBdXN0cmFsaWEsIE1lbGJvdXJuZSBWSUMgMzAwMCwg4KSH4KS44KSB4KSk4KS-4KSw4KS-4KSc4KSM4KSw4KWA!5e0!3m2!1sja!2sjp!4v1497226206603"
        width="1400"
        height="500"
        style="border:0;"
        allowfullscreen=""
        loading="lazy">
    </iframe>
</div>

</body>
</html>
