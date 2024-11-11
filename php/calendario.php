<?php
session_start();

// Verificar si el usuario está logueado y si tiene el rol
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

// Verificar si el rol está definido correctamente en la sesión
if (!isset($_SESSION['rol'])) {
    echo "Error: No se encontró el rol en la sesión del usuario.";
    exit();
}

// Definir si el usuario es admin
$es_admin = $_SESSION['rol'] === 'admin';

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'vacaction_db';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Consultar las vacaciones según el rol del usuario
$vacaciones = [];
if ($es_admin) {
    $sql = "SELECT v.*, u.nombre FROM vacaciones v INNER JOIN usuarios u ON v.usuario_id = u.id";
} else {
    $usuario_id = $_SESSION['usuario_id'];
    $sql = "SELECT * FROM vacaciones WHERE usuario_id = $usuario_id";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $vacaciones[] = [
            'title' => $es_admin ? 'Vacaciones de ' . $row['nombre'] : 'Mis Vacaciones',
            'start' => $row['fecha_inicio'],
            'end' => $row['fecha_fin'],
            'status' => $row['estado']  // Se asegura de incluir el estado exacto
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Vacaciones</title>
    <link rel="icon" href="/img/icons_logo/icon_black.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        /* Estilos */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }
        #calendar-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background-color: #f1f3f4;
        }
        #calendar {
            width: 100%;
            max-width: 1400px;
            height: 90vh;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        #buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 10px;
            background-color: #fff;
        }
        .button {
            flex: 1;
            padding: 15px 20px;
            max-width: 250px;
            text-align: center;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #357ae8;
        }

        header{
            background-color: #4285f4;
        }
        header p{
            display: flex;
            position: relative;
            color: white;
            font-size: 10px;
            right: -1450px;
        }
    
        a img{
            display: flex;
            position: relative;
            top: 10px;
            height: 30px;
            width: auto;
            right: -1465px;
        }

        a img:active{
            height: 25;
            width: auto;
            margin-bottom: 1px;
            margin-top: 2.5px;
            margin-right: 2px;
        }
    </style>
</head>
<body>
<header>
    <!-- Botón de Cerrar Sesión -->
     <div>
        <a href="logout.php" class="logout-button">
            <?php
                echo '<img src="../img/content/icono-cuenta-3-removebg-preview.png" alt="">';
            ?>
        </a>
        <p>Cerrar sesion</p>    
     </div>
    
</header>
<div id="calendar-container">
    <div id="calendar"></div>
</div>

<div id="buttons-container">
    <button class="button" onclick="changeCalendarView('timeGridDay')">Vista Diaria</button>
    <button class="button" onclick="changeCalendarView('timeGridWeek')">Vista Semanal</button>
    <button class="button" onclick="changeCalendarView('dayGridMonth')">Vista Mensual</button>
    <?php if ($es_admin): ?>
        <button class="button" onclick="verSolicitudes()">Ver Solicitudes de Vacaciones</button>
    <?php else: ?>
        <button class="button" onclick="solicitarVacaciones()">Solicitar Vacaciones</button>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
    let calendar;

    function changeCalendarView(view) {
        calendar.changeView(view);
    }

    function solicitarVacaciones() {
        window.location.href = 'solicitar_vacaciones.php';
    }

    function verSolicitudes() {
        window.location.href = 'gestion_solicitudes.php';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridDay,timeGridWeek,dayGridMonth'
            },
            themeSystem: 'standard',
            selectable: true,
            editable: true,
            selectMirror: true,
            events: <?php echo json_encode($vacaciones); ?>,
            select: function(info) {
                alert(`Has seleccionado desde ${info.startStr} hasta ${info.endStr}`);
            },
            eventClick: function(info) {
                alert(`Vacaciones: ${info.event.title}`);
            },
            eventDidMount: function(info) {
                // Asignar color según el estado de las vacaciones
                const estado = info.event.extendedProps.status;
                if (estado === 'aprobado') {
                    info.el.style.backgroundColor = '#34a853'; // Verde para aprobado
                } else if (estado === 'pendiente') {
                    info.el.style.backgroundColor = '#fbbc05'; // Amarillo para pendiente
                } else if (estado === 'rechazado') {
                    info.el.style.backgroundColor = '#ea4335'; // Rojo para rechazado
                } else {
                    info.el.style.backgroundColor = '#9e9e9e'; // Gris para otros estados
                }
            },
            dayHeaderFormat: { weekday: 'long' },
        });

        calendar.render();
    });
</script>

</body>
</html>
