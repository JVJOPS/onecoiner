<?php
session_start();
require '../DATABASE/conexionnoti.php';

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    die("Acceso no autorizado.");
}

// Verifica si se enviaron los datos necesarios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['rating'])) {
    $id = intval($_POST['id']);
    $rating = intval($_POST['rating']);
    
    // Verifica que el rating esté dentro del rango válido
    if ($rating < 1 || $rating > 5) {
        die("Calificación inválida.");
    }

    // Inserta o actualiza la calificación del usuario para la noticia
    $user_id = $_SESSION['id'];
    $sql = "INSERT INTO calificaciones (noticia_id, usuario_id, calificacion) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE calificacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiii', $id, $user_id, $rating, $rating);
    
    if ($stmt->execute()) {
        // Redirige de vuelta a la página de la noticia
        header("Location: vernoti_user.php?id=$id");
        exit();
    } else {
        echo "Error al guardar la calificación: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    die("Datos no válidos.");
}
?>
