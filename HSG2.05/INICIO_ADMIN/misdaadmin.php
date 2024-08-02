<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header('Location: ../LOGIN/usulogin.php'); // Redirigir al login si no está logueado
    exit();
}

// Incluir el archivo de conexión a la base de datos
include '../DATABASE/conexionuser.php';

// Obtener el ID del usuario de la sesión
$usuario_id = $_SESSION['id'];

// Preparar la consulta para evitar inyecciones SQL
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - HSG</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .profile-container {
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .profile-info {
            margin-bottom: 15px;
        }
        .profile-info label {
            font-weight: bold;
            color: #333;
        }
        .profile-info p {
            margin: 0;
            color: #555;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
            margin-right: 10px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .btn-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container profile-container">
        <h1 class="text-center">Perfil del Administrador</h1>
        <div class="profile-info">
            <label for="username">Nombre de Administrador:</label>
            <p id="username"><?php echo htmlspecialchars($usuario['nusu']); ?></p>
        </div>
        <div class="profile-info">
            <label for="email">Correo Electrónico:</label>
            <p id="email"><?php echo htmlspecialchars($usuario['correo']); ?></p>
        </div>
        <div class="profile-info">
            <label for="role">Rol:</label>
            <p id="role"><?php echo htmlspecialchars($usuario['rol']); ?></p>
        </div>
        <div class="btn-container text-center">
            <a href="logout.php" class="btn btn-custom">Cerrar Sesión</a>
            <a href="../FOROUSER/Usutareas.php" class="btn btn-custom">Ir al Foro</a>
            <a href="../NOTICIAS/noticias.php" class="btn btn-custom">Ver Noticias</a>
        </div>
    </div>
</body>
</html>
