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
    
    // Prepara una consulta SQL para eliminar la noticia
    $stmt = $conn->prepare("DELETE FROM noticias WHERE id = ?");
    $stmt->bind_param('i', $delete_id);
    
    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "<p>Noticia eliminada exitosamente.</p>";
    } else {
        echo "<p>Error al eliminar la noticia: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

// Obtener las noticias
$sql = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Noticias - Hardware and Software Gang</title>
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

        section#news {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        section#news h2 {
            margin-top: 0;
        }

        article {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        article h3 {
            margin: 0;
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

        .admin-actions a {
            color: #007BFF;
            text-decoration: none;
        }

        .admin-actions a:hover {
            text-decoration: underline;
        }

        .add-new {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .add-new:hover {
            background: #0056b3;
        }

        .view-rating {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .view-rating:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Administrar Noticias - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="NOTDEF_admin.php">Inicio</a></li>
                <li><a href="../INICIO_ADMIN/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="news">
            <h2>Administrar Noticias</h2>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<article>";
                    echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
                    echo "<p><em>Publicado el " . htmlspecialchars($row['fecha_publicacion']) . "</em></p>";
                    echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>";
                    echo "<div class='admin-actions'>";
                    echo "<a href='edit_noti.php?id=" . $row['id'] . "'>Editar</a> | ";
                    echo "<a href='delete_noti.php?delete_id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que quieres eliminar esta noticia?\")'>Eliminar</a> | ";
                    echo "<a class='view-rating' href='vernoti_admin.php?noticia_id=" . $row['id'] . "'>Ver Rating</a>";
                    echo "</div>";
                    echo "</article>";
                }
            } else {
                echo "<p>No hay noticias disponibles en este momento.</p>";
            }
            ?>
            <a class="add-new" href="Add_noti.php">Agregar Nueva Noticia</a>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

<?php
// Cierra la conexión
$conn->close();
?>