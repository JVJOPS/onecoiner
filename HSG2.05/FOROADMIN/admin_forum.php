<?php
session_start();
require '../DATABASE/conexion.php';

// Verificar si el usuario es un administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'administrador') {
    header("Location: login.php");
    exit();
}

// Consultar todos los mensajes del foro
$stmt = $conexion->query("SELECT * FROM mensajes_forum ORDER BY fecha_creacion DESC");
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrar Foro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Administrar Foro</h1>
    <a href="../FOROADMIN/foroAdmin.php">Volver al Foro</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Contenido</th>
                <th>Usuario ID</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mensajes as $mensaje): ?>
                <tr>
                    <td><?php echo htmlspecialchars($mensaje['id']); ?></td>
                    <td><?php echo htmlspecialchars($mensaje['titulo']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($mensaje['contenido'])); ?></td>
                    <td><?php echo htmlspecialchars($mensaje['usuario_id']); ?></td>
                    <td><?php echo htmlspecialchars($mensaje['fecha_creacion']); ?></td>
                    <td>
                        <a href="Aeditar_mensaje.php?id=<?php echo $mensaje['id']; ?>">Editar</a> |
                        <a href="Aeliminar_mensaje.php?id=<?php echo $mensaje['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este mensaje?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
