<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirige a login si no está logueado
    exit();
}

include("config.php"); // Incluye el archivo de conexión a la base de datos

// Recibimos los datos del formulario y validamos su existencia
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'], $_POST['fecha_inicio'], $_POST['fecha_fin'], $_POST['comentario'])) {
    $usuario_id = $_POST['usuario_id'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $comentario = $_POST['comentario'];

    // Validación de fechas (la fecha de inicio no puede ser posterior a la fecha de fin)
    if (strtotime($fecha_inicio) >= strtotime($fecha_fin)) {
        echo "La fecha de inicio no puede ser posterior a la fecha de fin.";
        exit();
    }

    // Insertar los datos en la tabla 'vacaciones' con estado predeterminado "pendiente"
    $sql = "INSERT INTO vacaciones (usuario_id, fecha_inicio, fecha_fin, estado, comentario_admin) 
            VALUES ('$usuario_id', '$fecha_inicio', '$fecha_fin', 'pendiente', '$comentario')";

    if ($conn->query($sql) === TRUE) {
        echo "Solicitud de vacaciones enviada correctamente. Será revisada por un administrador.";
    } else {
        echo "Error al enviar la solicitud: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();

    // Redirigir a la página de confirmación
    header('Location: confirmar_solicitud.php');
    exit();
} else {
    // Si los datos no se enviaron correctamente
    echo "Error: los datos del formulario no fueron enviados correctamente.";
}
?>
