<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Vacaciones</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" rel="stylesheet">

    <!-- FullCalendar JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.js"></script>

    <!-- Estilos personalizados -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #calendar-container {
            width: 90%;
            max-width: 1000px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #calendar {
            padding: 20px;
        }

        /* Barra lateral estilo Google Calendar */
        #sidebar {
            width: 200px;
            padding: 10px;
            background-color: #ffffff;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px 0 0 8px;
        }
        .button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            text-align: center;
            background-color: #4285f4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .button:hover {
            background-color: #357ae8;
        }

        /* Estilo de la vista semanal */
        .fc-col-header-cell {
            text-align: center;
            font-weight: bold;
            background-color: #4285f4;
            color: white;
            padding: 10px;
            border-right: 1px solid #ddd;
            border-bottom: 2px solid #ddd;
        }

        /* Separación entre días en la vista semanal */
        .fc-daygrid-day {
            border-right: 1px solid #ddd;
            padding: 10px;
            box-sizing: border-box;
        }

        /* Línea en la parte inferior de cada celda (más visible) */
        .fc-daygrid-day-frame {
            border-bottom: 2px solid #ddd;
        }

        /* Estilo de las celdas de cada día */
        .fc-daygrid-day-top {
            text-align: center;
            background-color: #f4f4f4;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }

        /* Asegurarse que el calendario tiene suficiente espacio */
        .fc-timegrid-col {
            padding: 5px;
        }

        /* Mostrar las líneas de separación más fuertes */
        .fc-daygrid-day-frame {
            border-right: 1px solid #ddd;
        }

        .fc-daygrid-day-top {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div id="sidebar">
    <h3 style="color: #4285f4; text-align: center;">Acciones</h3>
    <button class="button" onclick="calendar.changeView('dayGridMonth')">Vista Mensual</button>
    <button class="button" onclick="calendar.changeView('timeGridWeek')">Vista Semanal</button>
    <button class="button" onclick="calendar.changeView('timeGridDay')">Vista Diaria</button>
</div>

<div id="calendar-container">
    <h2 style="text-align: center; color: #4285f4; padding-top: 10px;">Calendario de Vacaciones</h2>
    <div id="calendar"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',  // Vista semanal
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridDay,timeGridWeek,dayGridMonth'
            },
            themeSystem: 'standard', // Usa el sistema de temas de FullCalendar
            selectable: true,
            editable: true, // Permitir arrastrar eventos
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
                // Muestra un mensaje o abre un formulario al seleccionar un rango
                alert(`Has seleccionado desde ${info.startStr} hasta ${info.endStr}`);
            },
            eventClick: function(info) {
                // Acciones cuando se hace clic en un evento
                alert(`Vacaciones: ${info.event.title}`);
            },
            dayHeaderFormat: { weekday: 'long' },  // Formato de los días de la semana
        });

        calendar.render();
    });
</script>

</body>
</html>
