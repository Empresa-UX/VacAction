<?php
session_start();
include("config.php"); // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $query = "SELECT id FROM usuarios WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['usuario_id'] = $user['id']; // Guarda el ID de usuario en la sesión

        // Redirección después del login
        if (isset($_SESSION['redirect_to'])) {
            $redirectUrl = $_SESSION['redirect_to'];
            unset($_SESSION['redirect_to']); // Limpia la variable de sesión
            header("Location: $redirectUrl");
        } else {
            header("Location: pagina_principal.php"); // Página principal por defecto
        }
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>
