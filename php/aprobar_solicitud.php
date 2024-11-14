<?php
session_start();

// Verifica si el usuario es un administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Verifica si se recibió un ID y estado
if (isset($_GET['id']) && isset($_GET['estado'])) {
    $id = $_GET['id'];
    $estado = $_GET['estado'];

    include("config.php"); // Incluye el archivo de conexión a la base de datos

    // Verificación de los valores posibles para estado
    if ($estado == 'aprobado' || $estado == 'rechazado') {
        // Consulta SQL corregida con los valores correctos del ENUM
        $sql = "UPDATE vacaciones SET estado = '$estado' WHERE id = $id";
        
        // Agregar mensaje de la consulta SQL para depuración
        echo "<script>console.log('Consulta SQL: " . $sql . "');</script>";

        if ($conn->query($sql) === TRUE) {
            $mensaje = $estado == 'aprobado' ? 'La solicitud fue aprobada exitosamente.' : 'La solicitud fue rechazada.';
            $clase = $estado == 'aprobado' ? 'success' : 'error';

            // Agregar el mensaje de consola
            echo "<script>console.log('Estado actualizado correctamente: " . $mensaje . "');</script>";
        } else {
            $mensaje = "Error al actualizar el estado: " . $conn->error;
            $clase = 'error';

            // Agregar el mensaje de consola en caso de error
            echo "<script>console.log('Error al actualizar: " . $mensaje . "');</script>";
        }
    } else {
        $mensaje = "Estado inválido.";
        $clase = 'error';

        // Agregar el mensaje de consola en caso de estado inválido
        echo "<script>console.log('Estado inválido: " . $mensaje . "');</script>";
    }

    $conn->close();
} else {
    $mensaje = "No se ha recibido la solicitud correctamente.";
    $clase = 'error';

    // Agregar el mensaje de consola en caso de no recibir los parámetros
    echo "<script>console.log('Error: " . $mensaje . "');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icons_logo/icon_white.ico" type="image/x-icon">
    <title>Confirmación de Solicitud</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #2a6ebb;
            font-size: 2em;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .success {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1em;
        }

        .error {
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1em;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #2a6ebb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
        }

        a:hover {
            background-color: #1e4d8b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Confirmación de Solicitud</h2>

    <div class="<?php echo $clase; ?>">
        <p>
            <?php
            echo $mensaje;
            ?>
        </p>
    </div>

    <a href="gestion_solicitudes.php">Volver a la gestión de solicitudes</a>
</div>

</body>
</html>
