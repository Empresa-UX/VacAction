<?php
// Inicia una nueva sesión o reanuda la sesión actual
session_start();

// Verifica si el usuario está logueado comprobando si la variable de sesión 'usuario_id' está definida
if (!isset($_SESSION['usuario_id'])) {
    // Si el usuario no está logueado, redirige a la página de login
    header('Location: login.php');
    exit(); // Detiene la ejecución del script
}

// Verifica si el rol del usuario está definido en la sesión
if (!isset($_SESSION['rol'])) {
    // Si no se encuentra el rol, muestra un mensaje de error y detiene el script
    echo "Error: No se encontró el rol en la sesión del usuario.";
    exit();
}

// Define si el usuario es administrador, comparando el rol almacenado en la sesión
$es_admin = $_SESSION['rol'] === 'admin';

include("config.php"); // Incluye el archivo de conexión a la base de datos

// Inicializa un array vacío para almacenar las vacaciones
$vacaciones = [];
// Si el usuario es administrador, realiza una consulta para obtener las vacaciones de todos los usuarios
if ($es_admin) {
    // Consulta SQL para seleccionar vacaciones y nombres de los usuarios
    $sql = "SELECT v.*, u.nombre FROM vacaciones v INNER JOIN usuarios u ON v.usuario_id = u.id";
} else {
    // Si no es administrador, obtiene solo las vacaciones del usuario logueado
    $usuario_id = $_SESSION['usuario_id'];
    $sql = "SELECT * FROM vacaciones WHERE usuario_id = $usuario_id";
}

// Ejecuta la consulta y almacena el resultado
$result = $conn->query($sql);

// Si la consulta devuelve al menos una fila, recorre cada fila
if ($result->num_rows > 0) {
    // Bucle para procesar cada fila de resultados
    while ($row = $result->fetch_assoc()) {
        // Agrega la información de cada fila al array de vacaciones, con título, fecha de inicio, fecha de fin y estado
        $vacaciones[] = [
            'title' => $es_admin ? 'Vacaciones de ' . $row['nombre'] : 'Mis Vacaciones',
            'start' => $row['fecha_inicio'],
            'end' => $row['fecha_fin'],
            'status' => $row['estado']  // Estado de las vacaciones
        ];
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos de la página HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Vacaciones</title>
    <!-- Favicon de la página -->
    <link rel="icon" href="/img/icons_logo/icon_black.ico" type="image/x-icon">
    <!-- Hoja de estilos del calendario -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <style>
        /* Estilos generales de la página */
        body,
        html {
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
            border: 2px solid #4285f4; /* Contorno azul */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        /* Estilos de botones */
        #buttons-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 10px;
            background-color: #fff;
            border-top: 2px solid #4285f4; /* Contorno superior azul */
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

        /* Estilos de la cabecera */
        header {
            background-color: #4285f4;
            padding: 10px;
        }

        header p {
            display: flex;
            position: relative;
            color: white;
            font-size: 10px;
            right: -1450px;
        }

        /* Estilos del icono de usuario */
        a img {
            display: flex;
            position: relative;
            top: 10px;
            height: 30px;
            width: auto;
            right: -1465px;
        }

        a img:active {
            height: 25px;
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
                // Muestra una imagen de icono de cuenta para el botón de cerrar sesión
                echo '<img src="../img/content/icono-cuenta-3-removebg-preview.png" alt="">';
                ?>
            </a>
            <p>Cerrar sesión</p>
        </div>
    </header>
    <div id="calendar-container">
        <!-- Contenedor del calendario -->
        <div id="calendar"></div>
    </div>

    <div id="buttons-container">
        <!-- Botones para cambiar la vista del calendario -->
        <button class="button" onclick="changeCalendarView('timeGridDay')">Vista Diaria</button>
        <button class="button" onclick="changeCalendarView('timeGridWeek')">Vista Semanal</button>
        <button class="button" onclick="changeCalendarView('dayGridMonth')">Vista Mensual</button>
        <button class="button" onclick="verHistorial()">Historial de Vacaciones</button>

        <?php if ($es_admin): ?>
            <!-- Botón especial para ver solicitudes si es administrador -->
            <button class="button" onclick="verSolicitudes()">Ver Solicitudes de Vacaciones</button>
        <?php else: ?>
            <!-- Botón para solicitar vacaciones si no es administrador -->
            <button class="button" onclick="solicitarVacaciones()">Solicitar Vacaciones</button>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <script>
        // Declaración del objeto calendario
        let calendar;

        // Cambia la vista del calendario a la especificada en el parámetro 'view'
        function changeCalendarView(view) {
            calendar.changeView(view);
        }

        // Redirige a la página de solicitud de vacaciones
        function solicitarVacaciones() {
            window.location.href = 'solicitar_vacaciones.php';
        }

        // Redirige a la página de gestión de solicitudes
        function verSolicitudes() {
            window.location.href = 'gestion_solicitudes.php';
        }

        // Redirige a la página de historial de vacaciones
        function verHistorial() {
            window.location.href = 'historial_vacaciones.php';
        }

        // Configura el calendario una vez que se carga la página
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            // Inicializa el calendario de FullCalendar con configuraciones específicas
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
                // Carga los eventos de vacaciones desde el PHP
                events: <?php echo json_encode($vacaciones); ?>,
                // Evento cuando se selecciona un rango en el calendario
                select: function (info) {
                    alert(`Has seleccionado desde ${info.startStr} hasta ${info.endStr}`);
                },
                // Evento cuando se hace clic en un evento de vacaciones
                eventClick: function (info) {
                    alert(`Vacaciones: ${info.event.title}`);
                },
                // Cambia el color de fondo del evento según el estado de las vacaciones
                eventDidMount: function (info) {
                    const estado = info.event.extendedProps.status;
                    if (estado === 'aprobado') {
                        info.el.style.backgroundColor = '#34a853'; // Verde para aprobado
                    } else if (estado === 'pendiente') {
                        info.el.style.backgroundColor = '#fbbc05'; // Amarillo para pendiente
                    } else if (estado === 'rechazado') {
                        info.el.style.backgroundColor = '#ea4335'; // Rojo para rechazado
                    }
                }
            });

            // Renderiza el calendario
            calendar.render();
        });
    </script>
</body>

</html>
