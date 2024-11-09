<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirige a login si no está logueado
    exit();
}

// Conexión a la base de datos
$host = 'localhost'; // Cambia esto si es necesario
$dbname = 'vacaciones_db';
$username = 'root'; // Cambia si tu usuario es diferente
$password = ''; // Cambia si tu contraseña es diferente
$conn = new mysqli($host, $username, $password, $dbname, 3307);

if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Recibimos los datos del formulario
$usuario_id = $_POST['usuario_id'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$comentario = $_POST['comentario'];

// Validación de fechas (puedes agregar más validaciones si es necesario)
if (strtotime($fecha_inicio) >= strtotime($fecha_fin)) {
    echo "La fecha de inicio no puede ser posterior a la fecha de fin.";
    exit();
}

// Insertar los datos en la tabla 'vacaciones'
$sql = "INSERT INTO vacaciones (usuario_id, fecha_inicio, fecha_fin, estado, comentario_admin) 
        VALUES ('$usuario_id', '$fecha_inicio', '$fecha_fin', 'pendiente', '$comentario')";

if ($conn->query($sql) === TRUE) {
    echo "Solicitud de vacaciones enviada correctamente. Será revisada por un administrador.";
} else {
    echo "Error al enviar la solicitud: " . $conn->error;
}

$conn->close();

// Al final del archivo 'procesar_solicitud.php', después de la confirmación:
header('Location: confirmar_solicitud.php'); // Crea esta página para mostrar el mensaje de éxito
exit();

?>

