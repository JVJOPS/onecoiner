<?php
session_start();
require '../DATABASE/conexion.php';

// Consultar los mensajes del foro
$stmt = $conexion->query("SELECT * FROM mensajes_forum ORDER BY fecha_creacion DESC");
$mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Foro Administrador</title>
    <link rel="stylesheet" href="styles.css">
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

/* Estilo para los enlaces */
a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Estilo para el contenedor de mensajes */
.mensaje {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 20px auto;
    padding: 15px;
    max-width: 800px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Títulos de los mensajes */
.mensaje h2 {
    margin-top: 0;
    color: #333;
}

/* Párrafos de los mensajes */
.mensaje p {
    line-height: 1.6;
    color: #555;
}

/* Fecha y usuario del mensaje */
.mensaje small {
    display: block;
    margin-top: 10px;
    color: #777;
}

/* Enlaces de edición y eliminación */
.mensaje a {
    color: #dc3545;
    margin-right: 10px;
}

.mensaje a:hover {
    text-decoration: underline;
}

/* Enlace para nuevo mensaje */
a[href="nuevo_mensaje.php"] {
    display: inline-block;
    margin: 20px;
    padding: 10px 15px;
    background-color: #28a745;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
}

a[href="nuevo_mensaje.php"]:hover {
    background-color: #218838;
}


</style>
<body>
    <h1>Foro</h1>
    <h3>Interactuas como Administrador</h3>
    <a href="admin_forum.php">Administrar Temass</a>
    <a href="../INICIO_ADMIN/inicio_admin.php">Pagina de inicio</a>
    <a href="nuevo_mensaje_admin.php">Nuevo Mensaje</a>
    <?php foreach ($mensajes as $mensaje): ?>
        <div class="mensaje">
            <h2><?php echo htmlspecialchars($mensaje['titulo']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($mensaje['contenido'])); ?></p>
            <small>Publicado por Usuario ID: <?php echo htmlspecialchars($mensaje['usuario_id']); ?> en <?php echo htmlspecialchars($mensaje['fecha_creacion']); ?></small>
            <?php if ($_SESSION['id'] == $mensaje['usuario_id']): ?>
                <a href="Aeditar_mensaje.php?id=<?php echo $mensaje['id']; ?>">Editar</a> |
                <a href="Aeliminar_mensaje.php?id=<?php echo $mensaje['id']; ?>">Eliminar</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
