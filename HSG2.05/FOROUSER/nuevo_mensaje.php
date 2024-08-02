<?php
session_start();
require '../DATABASE/conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    $usuario_id = $_SESSION['id'];

    if (!empty($titulo) && !empty($contenido)) {
        $stmt = $conexion->prepare("INSERT INTO mensajes_forum (titulo, contenido, usuario_id) VALUES (:titulo, :contenido, :usuario_id)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':usuario_id', $usuario_id);

        try {
            $stmt->execute();
            header("Location: foro.php");
            exit();
        } catch (PDOException $e) {
            echo "Error al insertar el mensaje: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nuevo Mensaje</title>
</head>
<style>
/* Estilo general para el cuerpo de la página */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

/* Encabezado principal */
h1 {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
    margin: 0;
}

/* Estilo del formulario */
form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Etiquetas y campos de entrada */
label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    height: 150px;
    resize: vertical;
}

/* Botón de envío */
button {
    background-color: #28a745;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #218838;
}

/* Mensajes de error */
.error {
    color: #dc3545;
    font-size: 14px;
    margin: 10px 0;
}


</style>
<body>
    
    <h1>Nuevo Mensaje</h1>
    <form method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required></textarea><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
