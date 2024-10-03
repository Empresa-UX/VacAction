<?php
// Se definen las variables necesarias para la conexión a la base de datos.
$servername = "localhost";
$username = "root";
$password = "";
$dbVacAction = "vacaction";

// Se crea la conexión a la base de datos usando el objeto mysqli.
$conn = new mysqli($servername, $username, $password, $dbVacAction);

// Se verifica si hubo un error al intentar conectar con la base de datos.
if ($conn->connect_error) {
    die("Conexión fallida a la base de datos: " . $conn->connect_error);
}

// Se verifica si el botón de envío ('submit') del formulario fue presionado.
if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $date = $_POST['date'];
    $phone = $_POST['phone'];
    $checkbox = isset($_POST['checkbox']) ? 1 : 0;

    // Validar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        echo "<script>alert('Las contraseñas no coinciden. Por favor, inténtalo de nuevo.');</script>";
    } else {
        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Sentencia SQL para insertar los datos capturados en la tabla 'usuarios'.
        $sql = "INSERT INTO usuarios (fullName, email, password, birth, phone, remember) 
                VALUES ('$fullName', '$email', '$hashedPassword', '$date', '$phone', $checkbox)";
        
        // Ejecución de la consulta SQL.
        if (mysqli_query($conn, $sql)) {
            // Si la inserción es exitosa, redirige al home.
            header("Location: borrador_home.php");
            exit(); // Se detiene el script después de la redirección.
        } else {
            // Si ocurre un error, muestra el error.
            echo "<script>alert('Error al insertar los datos: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-register.css">
    <link rel="icon" href="../img/icons_logo/icon_black.ico" type="image/x-icon">
    <title>VacAction | Register</title>
</head>

<body>
    <section>
        <div id="register-content">
            <img src="../img/icons_logo/icon_white2.png" alt="VacAction_logo">
            <h3>Join Our <span class="community">Community</span> Now</h3>

            <form method="POST">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" autocomplete="off" required>
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" autocomplete="off" required>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="optional">
                    <label for="date">Date of Birth</label>
                    <input type="date" id="date" name="date">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" autocomplete="off">
                </div>
                <div class="acceptTerms">
                    <input type="checkbox" id="checkbox" name="checkbox" required>
                    <label for="checkbox">I accept the Terms & Conditions and Privacy Policy</label>
                </div>
                <input type="submit" name="submit" id="submit" value="Register">
            </form>
        </div>
    </section>

    <section id="footer-content">
        <footer id="sectores">
            <div id="sector_1">
                <p>Direccion: *************************</p>
            </div>
            <div id="sector_2">
                <img src="../img/footer/icon_footer.png" alt="Social Media Links">
            </div>
            <div id="sector_3">
                <p>Derechos reservados : VacAction ©</p>
            </div>
        </footer>
    </section>
</body>
</html>
