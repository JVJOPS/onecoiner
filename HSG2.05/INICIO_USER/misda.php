<?php
// Inicia una nueva sesión o reanuda la sesión existente
session_start();

// Incluye el archivo de conexión a la base de datos
require '../DATABASE/conexion.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    // Si no hay una sesión iniciada, redirige al usuario al formulario de inicio de sesión
    header("Location: ../LOGIN/login.php");
    exit();
}

// Obtiene el ID del usuario desde la sesión
$id_usuario = $_SESSION['id'];

// Prepara una consulta SQL para seleccionar los datos del usuario con el ID especificado
$sql = "SELECT id, nusu, correo, rol FROM usuarios WHERE id = :id";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);

try {
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="misda.css"> <!-- Agrega tu archivo de estilos aquí -->
</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
    margin: 0;
 
}

h1 {
    background: #5d2d2d;
    text-align: center;
    font-size: 2em;
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 5px 5px 10px #5d2d2d, -5px -5px 10px #5d2d2d;
}

p {
    background: #5d2d2d;
    color: #ffffff;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 5px 5px 10px #5d2d2d, -5px -5px 10px #5d2d2d;
    margin: 10px 0;
    width: 100%;
    max-width: 400px;
    text-align: center;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #ffffff;
    text-decoration: none;
    background: #5d2d2d;
    padding: 10px 20px;
    border-radius: 10px;
    box-shadow: 5px 5px 10px #5d2d2d, -5px -5px 10px #5d2d2d;
    width: 100%;
    max-width: 400px;
}

a:hover {
    box-shadow: 5px 5px 15px #dddddd, -5px -5px 15px #ffffff;
}





body, html {
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #000;
    height: 100%;
}

.linea {
    position: absolute;
    height: 2px; /* Grosor de la línea */
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@keyframes moverLinea {
    0% {
        transform: translateX(-100vw);
    }
    100% {
        transform: translateX(100vw);
    }
}
h1{
    color: aliceblue;
}
    </style>
    <h1>Perfil de Usuario</h1>
    <?php if ($resultado): ?>
        <p><strong>ID:</strong> <?php echo htmlspecialchars($resultado['id']); ?></p>
        <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($resultado['nusu']); ?></p>
        <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($resultado['correo']); ?></p>
        <p><strong>Rol:</strong> <?php echo htmlspecialchars($resultado['rol']); ?></p>
    <?php else: ?>
        <p>No se encontraron datos del usuario.</p>
    <?php endif; ?>
    <a href="../INICIO_USER/inicio_user.php">Volver a la página de inicio</a>
    <div id="contenedor"></div>
    <script src="../animacion/script.js"></script>
</body>
</html>
