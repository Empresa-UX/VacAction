<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['redirect_to'] = 'solicitar_vacaciones.php'; // Guarda la URL de destino
    header('Location: login.php'); // Redirige a login si no está logueado
    exit();
}


// Si el usuario está logueado, obtenemos el ID de usuario
$usuario_id = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Vacaciones</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* CSS interno */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f8ff; /* Fondo celeste claro */
        }

        .container {
            background-color: #ffffff; /* Fondo blanco */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: #007acc; /* Color azul celeste */
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #333333;
            font-weight: bold;
        }

        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 1em;
        }

        textarea {
            height: 80px;
            resize: none;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007acc;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #005fa3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulario de Solicitud de Vacaciones</h2>
        <form action="procesar_solicitud.php" method="POST">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required><br><br>

            <label for="comentario">Comentario (opcional):</label>
            <textarea id="comentario" name="comentario"></textarea><br><br>

            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
            <button type="submit">Enviar solicitud</button>
        </form>
    </div>
</body>
</html>
