<?php

// Se definen las variables necesarias para la conexión a la base de datos.
$servername = "localhost";  // Nombre del servidor (en este caso, el servidor local).
$username = "root";         // Nombre de usuario para acceder a la base de datos (el usuario por defecto de MySQL).
$password = "";             // Contraseña para acceder a la base de datos (por defecto en XAMPP está vacía).
$dbVacAction = "vacaction"; // Nombre de la base de datos a la que se desea conectar.

// Se crea la conexión a la base de datos usando el objeto mysqli.
$conn = new mysqli($servername, $username, $password, $dbVacAction);

// Se verifica si el botón de envío ('submit') del formulario fue presionado.
if(isset($_POST['submit'])){
    
    // Se capturan los datos enviados desde el formulario a través del método POST.
    $fullName = $_POST['fullName'];  // Nombre completo del usuario.
    $email = $_POST['email'];        // Correo electrónico del usuario.
    $password = $_POST['password'];  // Contraseña del usuario.
    $date = $_POST['date'];          // Fecha de nacimiento del usuario.
    $phone = $_POST['phone'];        // Número de teléfono del usuario.
    
    // Se verifica si el checkbox de términos y condiciones fue marcado. Si fue marcado, se asigna el valor 1, sino 0.
    $checkbox = isset($_POST['checkbox']) ? 1 : 0;
    
    // Se crea una sentencia SQL para insertar los datos capturados en la tabla 'usuarios' de la base de datos.
    $sql = "INSERT INTO usuarios (name, email, password, birth, phone, remember) 
            VALUES ('$fullName', '$email', '$password', '$date', '$phone', $checkbox)";
    
    // Se ejecuta la consulta SQL usando la conexión previamente creada.
    $ejecuteInsert = mysqli_query($conn, $sql);

    // Se verifica si la consulta fue exitosa.
    if ($ejecuteInsert) {
        echo "Usuario registrado con éxito";  // Mensaje que indica que el registro fue exitoso.
    } else {
        // Si ocurre un error, se muestra el mensaje de error junto con el detalle proporcionado por MySQL.
        echo "Error: " . mysqli_error($conn);
    }
}

// Se verifica si hubo un error al intentar conectar con la base de datos.
if ($conn->connect_error) {
    // Si hay un error de conexión, se termina la ejecución y se muestra el error.
    die("Conexión fallida a la base de datos: " . $conn->connect_error);
} else {
    // Si la conexión fue exitosa, se muestra un mensaje de confirmación.
    echo "Conexión exitosa a la base de datos";
}

// Se verifica si la solicitud HTTP fue realizada usando el método POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es una solicitud POST, se muestra este mensaje.
    echo "¡Funciona! Estás usando el método POST";
} else {
    // Si no es una solicitud POST, se muestra este mensaje indicando que el método no es permitido.
    echo "Método no permitido";
}
?>
