<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: calendario.php");
    exit();
}

include("config.php"); // Incluye el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT id, email, password, rol FROM usuarios WHERE email = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $user_id, $user_email, $user_password, $rol);
            mysqli_stmt_fetch($stmt);

            if (password_verify($password, $user_password)) {
                $_SESSION['usuario_id'] = $user_id;
                $_SESSION['usuario_email'] = $user_email;
                $_SESSION['rol'] = $rol;

                if (isset($_POST['checkbox'])) {
                    setcookie("usuario_id", $user_id, time() + (86400 * 30), "/");
                    setcookie("usuario_email", $user_email, time() + (86400 * 30), "/");
                }

                header("Location: calendario.php");
                exit();
            } else {
                echo "<script>console.log('Credenciales incorrectas.');</script>";
            }
        } else {
            echo "<script>console.log('Credenciales incorrectas.');</script>";
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VacAction | Acceso</title>
    <link rel="icon" href="/img/icons_logo/icon_black.ico" type="image/x-icon">
    <style>
        * {
            font-family: 'Arial', sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #4dd0e1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        #login-content {
            background-color: #0288d1;
            padding: 40px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        #login-content img {
            width: 100px;
            margin-bottom: 20px;
        }

        #login-content h3 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 30px; /* Separación extra */
        }

        .green-letter {
            color: #4dd0e1;
        }

        .labe-input {
            margin-top: 20px; /* Separación entre secciones */
        }

        .labe-input label {
            color: #e0f7fa;
            font-weight: bold;
            margin-top: 20px; /* Margen superior adicional */
            display: block;
        }

        .labe-input input {
            width: 100%;
            padding: 8px;
            margin: 10px 0 20px; /* Más separación entre campos */
            border: none;
            border-bottom: 2px solid #ffffff;
            background-color: transparent;
            color: #ffffff;
        }

        .labe-input input:focus {
            border-bottom: 2px solid #4dd0e1;
            outline: none;
        }

        .remember-session {
            display: flex;
            align-items: center;
            margin-bottom: 20px; /* Separación adicional abajo */
            font-size: 14px;
        }

        .remember-session input {
            margin-right: 10px;
        }

        .submit {
            margin-top: 20px; /* Separación antes del botón */
        }

        .submit input {
            background-color: #4dd0e1;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px; /* Separación adicional */
        }

        .submit input:hover {
            background-color: #0277bd;
        }

        .enlaceCTA {
            margin-top: 30px; /* Separación entre enlaces */
        }

        .enlaceCTA a {
            font-size: 11px;
            color: #e0f7fa;
            text-decoration: none;
            margin: 0 15px;
        }

        .enlaceCTA a:hover {
            color: #4dd0e1;
        }

        footer {
            background-color: #0288d1;
            padding: 15px 0;
            text-align: center;
            color: #ffffff;
            width: 100%;
            position: fixed;
            bottom: 0;
        }

        footer p {
            margin: 5px;
        }
    </style>
</head>

<body>
    <section id="login-content">
        <h3>Bienvenido, <span class="green-letter">Usuario.</span></h3>

        <form method="POST" action="">
            <div class="labe-input">
                <label for="email">Direccion de Email</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Constraseña</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="remember-session">
                <input type="checkbox" name="checkbox" id="checkbox">
                <label for="checkbox">Permanecer conectado</label>
            </div>

            <div class="submit">
                <input type="submit" name="submit" value="Acceder">
            </div>

            <div class="enlaceCTA">
                <a href="./register.php">No tienes una cuenta?</a>
            </div>
        </form>
    </section>

    <footer>
        <p>Derechos reservados : VacAction ©</p>
    </footer>
</body>

</html>