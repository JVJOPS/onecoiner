<?php
$host = 'localhost'; // Tu host de MySQL
$dbname = 'bdHSG';   // Nombre de tu base de datos
$username = 'root';  // Tu usuario de MySQL
$password = '';      // Tu contraseña de MySQL

try {
    // Crear conexión PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configurar PDO para que lance excepciones en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
