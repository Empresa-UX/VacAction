<?php
// Inicia la sesión
session_start();

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Elimina las cookies si existen (para asegurarse de que no se mantenga la sesión activa en el navegador)
if (isset($_COOKIE['usuario_id'])) {
    setcookie('usuario_id', '', time() - 3600, '/');  // Vence la cookie
}

if (isset($_COOKIE['usuario_email'])) {
    setcookie('usuario_email', '', time() - 3600, '/');  // Vence la cookie
}

// Redirige al login después de cerrar sesión
header("Location: login.php");
exit();
?>
