<?php
// Se definen las variables necesarias para la conexión a la base de datos.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vacaction";

// Se crea la conexión a la base de datos usando el objeto mysqli.
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// Se verifica si hubo un error al intentar conectar con la base de datos.
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Si falla, tira un error y corta la ejecución
}

// ID del usuario actual. Solo lo probamos con el id 29, para probar si la base de datos funciona bien o no.
$user_id = 29;

// Consulta para contar cuántos días de vacaciones aprobadas tiene el usuario
$query_vacaciones_disponibles = "SELECT COUNT(*) as dias_disponibles FROM vacaciones WHERE user_id = $user_id AND status = 'Approved'";
$result_vacaciones_disponibles = $conn->query($query_vacaciones_disponibles);
$dias_disponibles = $result_vacaciones_disponibles->fetch_assoc()['dias_disponibles']; // Agarra el número de días disponibles

// Consulta para traer las próximas vacaciones aprobadas del usuario
$query_proximas_vacaciones = "SELECT start_date, end_date, reason, status, request_date FROM vacaciones WHERE user_id = $user_id AND status = 'Approved' ORDER BY start_date LIMIT 1";
$result_proximas_vacaciones = $conn->query($query_proximas_vacaciones);
$proxima_vacacion = $result_proximas_vacaciones->fetch_assoc(); // Guarda los datos de las próximas vacaciones

// Si hay próximas vacaciones, traemos las fechas y el motivo, sino mostramos un mensaje por defecto
$fecha_proxima_vacacion = $proxima_vacacion ? $proxima_vacacion['start_date'] : 'No hay próximas vacaciones';
$fecha_fin_proxima_vacacion = $proxima_vacacion ? $proxima_vacacion['end_date'] : 'No hay próximas vacaciones';
$razon_proxima_vacacion = $proxima_vacacion ? $proxima_vacacion['reason'] : 'No especificada';
$estado_proxima_vacacion = $proxima_vacacion ? $proxima_vacacion['status'] : 'No disponible';
$fecha_solicitud_proxima_vacacion = $proxima_vacacion ? $proxima_vacacion['request_date'] : 'No disponible'; // Aca traemos la fecha de solicitud

// Consulta para el historial de vacaciones del usuario, ordenado por la última modificación
$query_historial_vacaciones = "SELECT start_date, end_date, previous_status, new_status, change_date FROM historial_vacaciones hv 
                                JOIN vacaciones v ON hv.vacation_id = v.vacation_id 
                                WHERE v.user_id = $user_id ORDER BY change_date DESC LIMIT 1";
$result_historial_vacaciones = $conn->query($query_historial_vacaciones);
$ultima_vacacion = $result_historial_vacaciones->fetch_assoc(); // Tomamos los datos del historial de vacaciones

// Si hay historial, traemos las fechas y el estado, sino mostramos un mensaje por defecto
$fecha_inicio_historial = $ultima_vacacion ? $ultima_vacacion['start_date'] : 'No hay historial';
$fecha_fin_historial = $ultima_vacacion ? $ultima_vacacion['end_date'] : 'disponible';
$estado_anterior = $ultima_vacacion ? $ultima_vacacion['previous_status'] : 'No disponible';
$estado_nuevo = $ultima_vacacion ? $ultima_vacacion['new_status'] : 'No disponible';
$cambio_fecha = $ultima_vacacion ? $ultima_vacacion['change_date'] : 'No disponible';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="icon" href="../img/icons_logo/icon_black.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/borrador-home.css">
</head>

<body>
    <header>
        <nav>
            <!-- Aca va el logo del sistema -->
            <div class="logo"><img src="../img/icons_logo/icon_white2.png" alt=""></div>
            <div class="links">
                <!-- Menu de navegación con opciones -->
                <ul>
                    <li><a class="active" href="#">Inicio</a></li>
                    <li><a href="#">Mis Vacaciones</a></li>
                    <li><a href="#">Política de Vacaciones</a></li>
                    <li><a href="#">Ayuda</a></li>
                </ul>
            </div>
            <div class="perfil">
                <!-- Botón del perfil de usuario -->
                <button><img src="../img/content/icono-cuenta-2.png" alt=""></button>
            </div>
        </nav>

        <div class="home-content">
            <div class="home-container">
                <!-- Bienvenida y texto descriptivo -->
                <h1>Bienvenido</h1>
                <p>JavaScript es un lenguaje de programación interpretado, dialecto del estándar ECMAScript...</p>
                <button>Boton1</button>
                <button>Boton2</button>
            </div>
        </div>
    </header>
    
    <main>
        <section class="content">
            <!-- Bloque para mostrar los días de vacaciones disponibles -->
            <div class="vacaciones">
                <h2>Días de Vacaciones Disponibles</h2>
                <p>Tienes <?php echo $dias_disponibles; ?> días disponibles.</p>
                <button>Solicitar Vacaciones</button>
            </div>

            <!-- Bloque para mostrar las próximas vacaciones -->
            <div class="vacaciones">
                <h2>Próximas Vacaciones</h2>
                <p>Fecha de solicitud: <?php echo $fecha_solicitud_proxima_vacacion; ?></p> <!-- Mostramos la fecha de solicitud correctamente -->
                <p>Fecha de inicio: <?php echo $fecha_proxima_vacacion; ?></p>
                <p>Fecha de finalización: <?php echo $fecha_fin_proxima_vacacion; ?></p>
                <p>Razón: <?php echo $razon_proxima_vacacion; ?></p>
                <p>Estado de la solicitud: <?php echo $estado_proxima_vacacion; ?></p>
                <button>Ver Próximas Vacaciones</button>
            </div>

            <!-- Bloque para mostrar el historial de vacaciones -->
            <div class="historial">
                <h2>Historial de Vacaciones</h2>
                <p>Últimas vacaciones: <?php echo $fecha_inicio_historial; ?> <?php echo $fecha_fin_historial; ?></p>
                <p>Estado anterior: <?php echo $estado_anterior; ?></p>
                <p>Nuevo estado: <?php echo $estado_nuevo; ?></p>
                <p>Fecha del cambio de estado: <?php echo $cambio_fecha; ?></p>
                <button>Ver Historial Completo</button>
            </div>

        </section>
    </main>

    <!-- Footer con información de contacto -->
    <footer>
        <p>Comentarios© 2024 Gestión de Vacaciones | Contacto: VacAction@gmail.com</p>
    </footer>
</body>
</html>

<?php
// Cerramos la conexión a la base de datos para no dejarla abierta
$conn->close();
?>
