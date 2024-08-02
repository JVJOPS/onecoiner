<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos tiene otro nombre
$username = "root";        // Cambia esto según tu configuración
$password = "";            // Cambia esto según tu configuración
$dbname = "bdHSG";         // Cambia esto según el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conn->set_charset("utf8");

// Información de conexión exitosa
echo "Conexión exitosa!";
?>
