<?php
session_start();

// Verifica si el usuario es un administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include("config.php"); // Incluye el archivo de conexión a la base de datos

// Verifica si se ha proporcionado un ID de solicitud en la URL
if (!isset($_GET['id'])) {
    echo "Solicitud no especificada.";
    exit();
}

$solicitud_id = intval($_GET['id']);

// Consulta para obtener los detalles de la solicitud y del usuario que la hizo
$sql = "SELECT vacaciones.*, usuarios.nombre, usuarios.email, usuarios.fecha_registro 
        FROM vacaciones 
        INNER JOIN usuarios ON vacaciones.usuario_id = usuarios.id 
        WHERE vacaciones.id = $solicitud_id";
$result = $conn->query($sql);

// Verifica si se encontró la solicitud
if ($result->num_rows == 0) {
    echo "Solicitud no encontrada.";
    exit();
}

$solicitud = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Solicitud</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Contenedor central para alinear el contenido */
        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Título de la página */
        h2 {
            text-align: center;
            color: #2a6ebb;
            font-size: 2em;
            margin-bottom: 20px;
        }

        /* Tabla de detalles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 1.1em;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2a6ebb;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #f7f7f7;
        }

        /* Botón para volver */
        .btn-volver {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #2a6ebb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            text-align: center;
        }

        .btn-volver:hover {
            background-color: #1e4d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detalles de Solicitud de Vacaciones</h2>
        
        <table>
            <tr>
                <th>Usuario</th>
                <td><?php echo htmlspecialchars($solicitud['nombre']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($solicitud['email']); ?></td>
            </tr>
            <tr>
                <th>Fecha de Registro</th>
                <td><?php echo htmlspecialchars($solicitud['fecha_registro']); ?></td>
            </tr>
            <tr>
                <th>Fecha de Inicio</th>
                <td><?php echo htmlspecialchars($solicitud['fecha_inicio']); ?></td>
            </tr>
            <tr>
                <th>Fecha de Fin</th>
                <td><?php echo htmlspecialchars($solicitud['fecha_fin']); ?></td>
            </tr>
            <tr>
                <th>Comentario</th>
                <td><?php echo htmlspecialchars($solicitud['comentario_admin']); ?></td>
            </tr>
            <tr>
                <th>Estado</th>
                <td><?php echo htmlspecialchars($solicitud['estado']); ?></td>
            </tr>
        </table>
        
        <!-- Botón para volver a la página de gestión de solicitudes -->
        <a href="gestion_solicitudes.php" class="btn-volver">Volver a Solicitudes</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>
