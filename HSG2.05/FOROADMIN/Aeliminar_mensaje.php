<?php
session_start();
require '../DATABASE/conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if ($id) {
    // Obtener el mensaje actual para verificar el propietario
    $stmt = $conexion->prepare("SELECT usuario_id FROM mensajes_forum WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $mensaje = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($mensaje) {
        // Verificar si   el usuario actual es el propietario del mensaje o un administrador
        if ($mensaje['usuario_id'] == $_SESSION['id'] || $_SESSION['rol'] == 'administrador') {
            // Eliminar el mensaje
            $stmt = $conexion->prepare("DELETE FROM mensajes_forum WHERE id = :id");
            $stmt->bindParam(':id', $id);

            try {
                $stmt->execute();
                header("Location: ../FOROADMIN/foroAdmin.php");
                exit();
            } catch (PDOException $e) {
                echo "Error al eliminar el mensaje: " . $e->getMessage();
            }
        } else {
            echo "No tienes permiso para eliminar este mensaje.";
        }
    } else {
        echo "Mensaje no encontrado.";
    }
} else {
    echo "ID de mensaje no especificado.";
}
?>
