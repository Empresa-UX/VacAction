<?php
session_start(); // Inicia la sesión

// Verifica si ya hay una sesión activa
if (isset($_SESSION['usuario_id'])) {
    header("Location: calendario.php"); // Si la sesión ya está activa, redirige al calendario
    exit();
}

// Conexión a la base de datos
$servername = "localhost";  // Cambia esto si tu servidor de base de datos es diferente
$username = "root";         // Tu nombre de usuario de MySQL
$password = "";             // Tu contraseña de MySQL
$dbname = "vacaction_db";      // El nombre de tu base de datos

// Crea la conexión
$conn = mysqli_connect($servername, $username, $password, $dbname, 3307);

if (!$conn) {
    echo "<script>console.log('Conexión fallida: " . mysqli_connect_error() . "');</script>";
    die("Conexión fallida: " . mysqli_connect_error()); // Agrega manejo de errores en la conexión
}

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén las credenciales del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Depuración: Verificar que los datos se reciban correctamente
    echo "<script>console.log('Email: $email, Password: $password');</script>"; // Enviar mensaje a consola

    // Prepara y ejecuta la consulta para verificar el usuario
    $query = "SELECT id, email, password, rol FROM usuarios WHERE email = ?";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);  // Vincula el email

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Depuración: Verificar si el usuario existe en la base de datos
        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $user_id, $user_email, $user_password, $rol); // Añadir el rol
            mysqli_stmt_fetch($stmt);

            // Depuración: Verificar los valores obtenidos de la base de datos
            echo "<script>console.log('ID: $user_id, Email: $user_email, Password: $user_password, Rol: $rol');</script>"; // Enviar mensaje a consola

            // Verifica si la contraseña ingresada coincide con la almacenada en la base de datos
            if (password_verify($password, $user_password)) {
                // Guarda el ID, email y rol del usuario en la sesión
                $_SESSION['usuario_id'] = $user_id;
                $_SESSION['usuario_email'] = $user_email;
                $_SESSION['rol'] = $rol; // Almacena el rol

                // Si la opción "Remember me" está marcada, guarda la sesión
                if (isset($_POST['checkbox'])) {
                    setcookie("usuario_id", $user_id, time() + (86400 * 30), "/"); // Guarda cookie por 30 días
                    setcookie("usuario_email", $user_email, time() + (86400 * 30), "/");
                }

                // Redirige al calendario
                header("Location: calendario.php");
                exit();
            } else {
                echo "<script>console.log('Credenciales incorrectas.');</script>"; // Enviar mensaje a consola
            }
        } else {
            echo "<script>console.log('Credenciales incorrectas.');</script>"; // Enviar mensaje a consola
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>console.log('Error en la consulta a la base de datos.');</script>"; // Enviar mensaje a consola
    }

    mysqli_close($conn); // Cierra la conexión a la base de datos
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-login.css">
    <link rel="icon" href="../img/icons_logo/icon_black.ico" type="image/x-icon">
    <title>VacAction | Login</title>
</head>

<body>
    <section id="login-content">
        <img src="../img/icons_logo/icon_white2.png" alt="VacAction logo">
        <h3>Welcome, <span class="green-letter">traveler.</span></h3>

        <form method="POST" action="login.php">
            <div class="labe-input">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" autocomplete="off" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="remember-session">
                <input type="checkbox" name="checkbox" id="checkbox">
                <label for="checkbox">Remember me</label>
            </div>

            <div class="submit">
                <input type="submit" name="submit" id="submit" value="Login in">
            </div>

            <div class="googleAcount">
                <p>Or sign in with:</p>
                <button onclick="window.location.href='/auth/google'">
                    <img src="../img/content/google-logo.png" alt="Google logo" />
                </button>
            </div>

            <div class="enlaceCTA">
                <a href="../html/forgot.php" name="fotgot">Forgot password?</a>
                <a href="../html/register.php" name="register">Don't have an account?</a>
            </div>
        </form>
    </section>

    <footer id="footer">
        <div>
            <p>Derechos reservados : VacAction ©</p>
        </div>
        <div>
            <p>Derechos reservados : VacAction ©</p>
        </div>
        <div>
            <p>Derechos reservados : VacAction ©</p>
        </div>
    </footer>
</body>
</html>