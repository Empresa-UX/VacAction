<?php
session_start();

// Verifica si el usuario es un administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: login.php');
    exit();
}

include("config.php"); // Incluye el archivo de conexión a la base de datos

// Obtener todas las solicitudes pendientes
$sql = "SELECT * FROM vacaciones WHERE estado = 'pendiente'";
$result = $conn->query($sql);

// Comienza a mostrar el contenido HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icons_logo/icon_white.ico" type="image/x-icon">
    <title>Gestionar Solicitudes</title>
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
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Estilo para el título */
        h2 {
            text-align: center;
            color: #2a6ebb;
            font-size: 2em;
            margin-bottom: 20px;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 1.1em;
        }

        /* Encabezados de la tabla */
        th {
            background-color: #2a6ebb;
            color: white;
            font-weight: bold;
        }

        /* Filas de la tabla */
        tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        /* Estilos para los enlaces de acciones */
        a {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 5px;
            display: inline-block;
            font-size: 1em;
        }

        .aprobar {
            background-color: #4CAF50;
        }

        .rechazar {
            background-color: #f44336;
        }

        /* Efectos al pasar el mouse sobre los enlaces */
        a:hover {
            opacity: 0.8;
        }

        a.aprobar:hover {
            background-color: #45a049;
        }

        a.rechazar:hover {
            background-color: #e53935;
        }

        /* Estilo para el mensaje de no solicitudes */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #555;
        }

        .btn-detalles {
            display: inline-block;
            padding: 8px 16px;
            background-color: #2a6ebb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .btn-detalles:hover {
            background-color: #1e4d8b;
        }

        /* Estilo para el botón de volver al calendario */
        .btn-calendario {
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

        .btn-calendario:hover {
            background-color: #1e4d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Verificar si hay solicitudes pendientes
        if ($result->num_rows > 0) {
            echo "<h2>Solicitudes de Vacaciones Pendientes</h2>";
            echo "<table>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Comentario</th>
                        <th>Acciones</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                // Obtener datos del usuario (opcional)
                $usuario_id = $row['usuario_id'];
                $usuario_sql = "SELECT nombre FROM usuarios WHERE id = $usuario_id";
                $usuario_result = $conn->query($usuario_sql);
                $usuario = $usuario_result->fetch_assoc();
                
                echo "<tr>
                        <td>" . $usuario['nombre'] . "</td>
                        <td>" . $row['fecha_inicio'] . "</td>
                        <td>" . $row['fecha_fin'] . "</td>
                        <td>" . $row['comentario_admin'] . "</td>
                        <td>
                            <a class='aprobar' href='aprobar_solicitud.php?id=" . $row['id'] . "&estado=aprobado'>Aprobar</a> | 
                            <a class='rechazar' href='aprobar_solicitud.php?id=" . $row['id'] . "&estado=rechazado'>Rechazar</a> |
                            <a class='btn-detalles' href='detalles_solicitud.php?id=" . $row['id'] . "'>Ver detalles</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay solicitudes pendientes.</p>";
        }

        $conn->close();
        ?>
        
        <!-- Botón para volver al calendario -->
        <a href="calendario.php" class="btn-calendario">Volver al Calendario</a>
    </div>
</body>
</html>
