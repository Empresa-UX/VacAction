<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Vacaciones</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
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
            padding: 15px 20px; /* Aumenta el padding para hacer los botones más grandes */
            max-width: 250px; /* Permite que cada botón sea más ancho */
            text-align: center;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px; /* Aumenta el tamaño de la fuente */
            font-weight: bold; /* Hace el texto más visible */
        }
        .button:hover {
            background-color: #357ae8;
        }
    </style>
</head>
<body>

<div id="calendar-container">
    <div id="calendar"></div>
</div>

<div id="buttons-container">
    <button class="button" onclick="changeCalendarView('timeGridDay')">Vista Diaria</button>
    <button class="button" onclick="changeCalendarView('timeGridWeek')">Vista Semanal</button>
    <button class="button" onclick="changeCalendarView('dayGridMonth')">Vista Mensual</button>
    <button class="button" onclick="solicitarVacaciones()">Solicitar Vacaciones</button>
</div>

<!-- FullCalendar JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
    let calendar;

    function changeCalendarView(view) {
        calendar.changeView(view);
    }

    // Función para redirigir a la página del formulario
    function solicitarVacaciones() {
        // Redirige a la página donde el usuario podrá solicitar sus vacaciones
        window.location.href = 'solicitar_vacaciones.php';
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
            events: [
                {
                    title: 'Vacaciones Aprobadas',
                    start: '2024-11-15',
                    end: '2024-11-20',
                    color: '#34a853'
                },
                {
                    title: 'Vacaciones Pendientes',
                    start: '2024-11-25',
                    end: '2024-11-28',
                    color: '#fbbc05'
                }
            ],
            select: function(info) {
                alert(`Has seleccionado desde ${info.startStr} hasta ${info.endStr}`);
            },
            eventClick: function(info) {
                alert(`Vacaciones: ${info.event.title}`);
            },
            dayHeaderFormat: { weekday: 'long' },
        });

        calendar.render();
    });
</script>

</body>
</html>
