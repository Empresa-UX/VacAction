<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vacaction_db";
$port = 3307; // Especificar el puerto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $email = $conn->real_escape_string($_POST['email']);
    
    // Cifrado de la contraseña usando password_hash()
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $rol = $_POST['rol'];

    // Insertar en la tabla usuarios
    $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre $apellido', '$email', '$password', '$rol')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a login.php después de registrar
        header("Location: login.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        * {
            font-family: 'Arial', sans-serif;
            color: #ffffff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #e0f7fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        #register-content {
            background-color: #0288d1;
            padding: 40px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        #register-content h3 {
            color: #ffffff;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .labe-input {
            margin-top: 20px;
            text-align: left;
        }

        .labe-input label {
            color: #e0f7fa;
            font-weight: bold;
            margin-top: 20px;
            display: block;
        }

        .labe-input input, .labe-input select {
            width: 100%;
            padding: 8px;
            margin: 10px 0 20px;
            border: none;
            border-bottom: 2px solid #ffffff;
            background-color: transparent;
            color: #ffffff;
        }

        .labe-input input:focus, .labe-input select:focus {
            border-bottom: 2px solid #4dd0e1;
            outline: none;
        }

        .name-fields, .password-role-fields {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .name-fields .labe-input, .password-role-fields .labe-input {
            width: 48%;
        }

        .submit {
            margin-top: 20px;
        }

        .submit input {
            background-color: #4dd0e1;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit input:hover {
            background-color: #0277bd;
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
    <div id="register-content">
        <h3>Registro de Usuario</h3>
        <form action="register.php" method="POST">
            <!-- Nombre y Apellido lado a lado -->
            <div class="name-fields">
                <div class="labe-input">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="labe-input">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>
            </div>

            <!-- Email -->
            <div class="labe-input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Contraseña y Rol lado a lado -->
            <div class="password-role-fields">
                <div class="labe-input">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="labe-input">
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol">
                        <option value="empleado">Empleado</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>

            <div class="submit">
                <input type="submit" value="Registrarse">
            </div>
        </form>
    </div>

    <footer>
        <p>Derechos reservados : VacAction ©</p>
    </footer>
</body>
</html>
