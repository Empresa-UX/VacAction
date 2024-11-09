<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php'); // Redirige a login si no está logueado
    exit();
}

// Si el usuario está logueado, obtenemos el ID de usuario
$usuario_id = $_SESSION['usuario_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Vacaciones</title>
    <link rel="stylesheet" href="style.css"> <!-- Asegúrate de incluir tu archivo CSS -->
</head>
<body>
    <div class="container">
        <h2>Formulario de Solicitud de Vacaciones</h2>
        <form action="http://localhost/VacAction/solicitar_vacaciones.php" method="POST">
            <label for="fecha_inicio">Fecha de inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required><br><br>

            <label for="fecha_fin">Fecha de fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required><br><br>

            <label for="comentario">Comentario (opcional):</label>
            <textarea id="comentario" name="comentario"></textarea><br><br>

            <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
            <button type="submit">Enviar solicitud</button>
        </form>
    </div>
</body>
</html>
