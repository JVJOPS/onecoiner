<?php
// Inicia una nueva sesión o reanuda la sesión existente
session_start();

// Incluye el archivo de conexión a la base de datos
require '../DATABASE/conexionnoti.php';

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'administrador') {
    die("Acceso no autorizado.");
}

// Verifica si se realizó una solicitud de eliminación
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    // Inicia una transacción
    $conn->begin_transaction();
    
    try {
        // Prepara una consulta SQL para eliminar los comentarios relacionados con la noticia
        $stmt = $conn->prepare("DELETE FROM comentarios_noticias WHERE noticia_id = ?");
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();
        $stmt->close();

        // Prepara una consulta SQL para eliminar las calificaciones relacionadas con la noticia
        $stmt = $conn->prepare("DELETE FROM calificaciones WHERE noticia_id = ?");
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();
        $stmt->close();
        
        // Prepara una consulta SQL para eliminar la noticia
        $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
        $stmt->bind_param('i', $delete_id);
        $stmt->execute();
        $stmt->close();
        
        // Confirma la transacción
        $conn->commit();
        
        $mensaje = "Noticia eliminada exitosamente.";
    } catch (Exception $e) {
        // Revierte la transacción en caso de error
        $conn->rollback();
        $mensaje = "Error al eliminar la noticia: " . $e->getMessage();
    }
} else {
    $mensaje = "ID de noticia no especificado.";
}

// Cierra la conexión
$conn->close();

// Muestra el mensaje
echo $mensaje;
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Noticia - Hardware and Software Gang</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }

        header {
            background: #333;
            color: #fff;
            padding: 15px 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        section#delete-news {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        section#delete-news h2 {
            margin-top: 0;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Eliminar Noticia - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="NOTDEF_admin.php">Inicio</a></li>
                <li><a href="../INICIO_ADMIN/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="delete-news">
            <h2>Resultado de la Eliminación</h2>
            <p><?php echo $mensaje; ?></p>
            <p><a href="NOTDEF_admin.php">Volver a Administrar Noticias</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
