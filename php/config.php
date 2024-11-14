<?php
// Datos de la conexión a la base de datos
$host = 'localhost';
$dbname = 'vacaction_db';
$username = 'root';
$password = '';
$puerto = '3307';

// Crea una nueva conexión a la base de datos usando mysqli
$conn = new mysqli($host, $username, $password, $dbname, $puerto);

// Verifica si hubo un error al conectar a la base de datos
if ($conn->connect_error) {
    // Si hay un error de conexión, muestra un mensaje y detiene el script
    die('Conexión fallida: ' . $conn->connect_error);
}
?>