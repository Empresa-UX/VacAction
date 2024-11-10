<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Solicitud</title>

    <style>
        /* Estilo global para el contenedor */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8; /* Fondo suave */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilo para el cartel de alerta */
        .alerta {
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 500px;
        }

        /* Estilo para los mensajes de éxito */
        .alerta.exito {
            background-color: #4CAF50; /* Verde */
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para los mensajes de error */
        .alerta.error {
            background-color: #f44336; /* Rojo */
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para los botones de acción */
        .boton-regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF; /* Azul */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }

        .boton-regresar:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el ratón */
        }

        /* Estilo para un enlace adicional */
        .enlace {
            display: inline-block;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
        }

        .enlace:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="alerta exito">
        <h2>Solicitud de Vacaciones Enviada</h2>
        <p>Tu solicitud de vacaciones ha sido enviada correctamente y está pendiente de revisión por un administrador.</p>
        <a class="boton-regresar" href="calendario.php">Volver al Calendario</a>
    </div>
</body>
</html>
