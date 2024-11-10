<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vacaction_db";

$conn = mysqli_connect($servername, $username, $password, $dbname, 3307);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Eliminar registros existentes
$delete_query = "DELETE FROM usuarios"; // Elimina todos los registros en la tabla
if (mysqli_query($conn, $delete_query)) {
    echo "Registros antiguos eliminados.<br>";
} else {
    echo "Error al eliminar registros: " . mysqli_error($conn) . "<br>";
}

// Crear contraseñas cifradas
$password1 = password_hash("admin123", PASSWORD_DEFAULT);
$password2 = password_hash("empleado123", PASSWORD_DEFAULT);
$password3 = password_hash("empleado456", PASSWORD_DEFAULT);

// Insertar usuarios en la base de datos
$query = "INSERT INTO usuarios (nombre, email, password, rol) VALUES
          ('Juan Perez', 'juan.perez@example.com', '$password1', 'admin'),
          ('Maria Lopez', 'maria.lopez@example.com', '$password2', 'empleado'),
          ('Carlos Garcia', 'carlos.garcia@example.com', '$password3', 'empleado')";

if (mysqli_query($conn, $query)) {
    echo "Usuarios creados exitosamente.";
} else {
    echo "Error al insertar usuarios: " . mysqli_error($conn);
}

mysqli_close($conn); // Cierra la conexión
?>
