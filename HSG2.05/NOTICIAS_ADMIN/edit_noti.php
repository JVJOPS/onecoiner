<?php
// Inicia una nueva sesión o reanuda la sesión existente
session_start();

// Incluye el archivo de conexión a la base de datos
require '../DATABASE/conexionnoti.php';

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'administrador') {
    die("Acceso no autorizado.");
}

// Verifica si se realizó una solicitud de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $titulo = trim($_POST['titulo']);
    $contenido = trim($_POST['contenido']);
    
    // Prepara una consulta SQL para actualizar la noticia
    $stmt = $conn->prepare("UPDATE noticias SET titulo = ?, contenido = ? WHERE id = ?");
    $stmt->bind_param('ssi', $titulo, $contenido, $id);
    
    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "<p>Noticia actualizada exitosamente.</p>";
    } else {
        echo "<p>Error al actualizar la noticia: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}

// Verifica si se proporcionó un ID de noticia para edición
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Prepara una consulta SQL para obtener los datos de la noticia
    $stmt = $conn->prepare("SELECT * FROM noticias WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $noticia = $result->fetch_assoc();
    } else {
        die("Noticia no encontrada.");
    }
    
    $stmt->close();
} else {
    // Redirige a la página de administración de noticias si no se especifica un ID
    header("Location: NOTDEF_admin.php");
    exit();
}

// Cierra la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia - Hardware and Software Gang</title>
    <style>
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

        section#edit-news {
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        section#edit-news h2 {
            margin-top: 0;
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            display: inline-block;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
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
        <h1>Editar Noticia - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="NOTDEF_admin.php">Inicio</a></li>
                <li><a href="../INICIO_ADMIN/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="edit-news">
            <h2>Editar Noticia</h2>
            <form action="edit_noti.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($noticia['id']); ?>">
                <div>
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required>
                </div>
                <div>
                    <label for="contenido">Contenido:</label>
                    <textarea id="contenido" name="contenido" rows="10" required><?php echo htmlspecialchars($noticia['contenido']); ?></textarea>
                </div>
                <div>
                    <button type="submit">Actualizar Noticia</button>
                </div>
            </form>
            <p><a href="NOTDEF_admin.php">Volver a Administrar Noticias</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>
</html>