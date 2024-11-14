<?php
session_start();

// Verificamos si el usuario ha iniciado sesión y si su rol está definido
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['rol'])) {
    header('Location: login.php');
    exit();
}

include("config.php"); // Incluye la configuración de la base de datos

// Verifica si el usuario es administrador
$es_admin = $_SESSION['rol'] === 'admin';

// Obtenemos la fecha actual para verificar si alguna vacación está en curso
$fecha_actual = date("Y-m-d");

// Consulta SQL para obtener el historial de vacaciones
if ($es_admin) {
    // Si es administrador, obtiene todas las vacaciones
    $sql = "SELECT v.*, u.nombre FROM vacaciones v INNER JOIN usuarios u ON v.usuario_id = u.id WHERE v.fecha_fin < '$fecha_actual' OR (v.fecha_inicio <= '$fecha_actual' AND v.fecha_fin >= '$fecha_actual')";
} else {
    // Si es usuario normal, obtiene solo sus vacaciones
    $usuario_id = $_SESSION['usuario_id'];
    $sql = "SELECT * FROM vacaciones WHERE usuario_id = $usuario_id AND (fecha_fin < '$fecha_actual' OR (fecha_inicio <= '$fecha_actual' AND fecha_fin >= '$fecha_actual'))";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Vacaciones</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #2a6ebb;
            font-size: 2.8em;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 1.2em;
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

        .estado-aprobado {
            color: green;
            font-weight: bold;
        }

        .estado-rechazado {
            color: red;
            font-weight: bold;
        }

        .estado-pendiente {
            color: orange;
            font-weight: bold;
        }

        .estado-en-curso {
            color: #1e7e34;
            font-weight: bold;
        }

        .estado-finalizado {
            color: #6c757d;
            font-weight: bold;
        }

        .btn-volver {
            display: inline-block;
            margin-top: 30px;
            padding: 14px 25px;
            background-color: #2a6ebb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 1.4em;
            text-align: center;
        }

        .btn-volver:hover {
            background-color: #1e4d8b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historial de Vacaciones</h1>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Estado</th>
                    <th>Comentario del Administrador</th>
                    <th>Estado Actual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Determina si las vacaciones están en curso o ya finalizaron
                        $estado_actual = ($fecha_actual >= $row['fecha_inicio'] && $fecha_actual <= $row['fecha_fin']) ? 'En curso' : 'Finalizado';
                        $estado_clase = '';
                        // Define la clase CSS para cada estado
                        if ($row['estado'] == 'Aprobado') {
                            $estado_clase = 'estado-aprobado';
                        } elseif ($row['estado'] == 'Rechazado') {
                            $estado_clase = 'estado-rechazado';
                        } elseif ($row['estado'] == 'Pendiente') {
                            $estado_clase = 'estado-pendiente';
                        }
                        $estado_actual_clase = '';
                        if ($estado_actual == 'En curso') {
                            $estado_actual_clase = 'estado-en-curso';
                        } else {
                            $estado_actual_clase = 'estado-finalizado';
                        }
                        ?>
                        <tr>
                            <td><?php echo $es_admin ? $row['nombre'] : 'Mis Vacaciones'; ?></td>
                            <td><?php echo $row['fecha_inicio']; ?></td>
                            <td><?php echo $row['fecha_fin']; ?></td>
                            <td class="<?php echo $estado_clase; ?>"><?php echo ucfirst($row['estado']); ?></td>
                            <td><?php echo $row['comentario_admin']; ?></td>
                            <td class="<?php echo $estado_actual_clase; ?>"><?php echo $estado_actual; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron vacaciones en el historial.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="gestion_solicitudes.php" class="btn-volver">Volver a Solicitudes</a>
    </div>
</body>
</html>
