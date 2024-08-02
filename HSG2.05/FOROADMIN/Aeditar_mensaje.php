<?php
session_start();
require '../DATABASE/conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);

    if (!empty($titulo) && !empty($contenido)) {
        $stmt = $conexion->prepare("UPDATE mensajes_forum SET titulo = :titulo, contenido = :contenido WHERE id = :id");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
            header("Location: ../FOROADMIN/foroAdmin.php");
            exit();
        } catch (PDOException $e) {
            echo "Error al actualizar el mensaje: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    // Obtener el mensaje actual para pre-cargar en el formulario
    $stmt = $conexion->prepare("SELECT * FROM mensajes_forum WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $mensaje = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Mensaje</title>
</head>
<body>
    <h1>Editar Mensaje</h1>
    <form method="post">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($mensaje['titulo']); ?>" required><br>
        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required><?php echo htmlspecialchars($mensaje['contenido']); ?></textarea><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
