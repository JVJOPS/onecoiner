<?php
session_start();
require '../DATABASE/conexionnoti.php';

// Verifica si se proporcionó un ID de noticia
if (!isset($_GET['id'])) {
    die("Acceso no autorizado.");
}

$id = intval($_GET['id']);

// Obtiene los detalles de la noticia
$sql = "SELECT * FROM noticias WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Noticia no encontrada.");
}

$noticia = $result->fetch_assoc();

// Maneja el envío de comentarios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario'])) {
    if (!isset($_SESSION['id'])) {
        die("Acceso no autorizado.");
    }
    $contenido = trim($_POST['comentario']);
    if (!empty($contenido)) {
        $usuario_id = $_SESSION['id'];
        $sql_comentario = "INSERT INTO comentarios_noticias (contenido, noticia_id, usuario_id) VALUES (?, ?, ?)";
        $stmt_comentario = $conn->prepare($sql_comentario);
        $stmt_comentario->bind_param('sii', $contenido, $id, $usuario_id);
        $stmt_comentario->execute();
        $stmt_comentario->close();
    } else {
        echo "El contenido del comentario no puede estar vacío.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia['titulo']); ?> - Hardware and Software Gang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        main {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
        }

        article h2 {
            color: #333;
        }

        article p {
            line-height: 1.6;
        }

        .rating,
        .comments {
            margin-top: 2rem;
        }

        .comments div {
            border-bottom: 1px solid #ccc;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        form textarea {
            width: 100%;
            padding: 1rem;
            margin-top: 1rem;
        }

        form button {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1><?php echo htmlspecialchars($noticia['titulo']); ?></h1>
        <nav>
            <ul>
                <li><a href="../INICIO_USER/inicio_user.php">Inicio</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <article>
            <h2><?php echo htmlspecialchars($noticia['titulo']); ?></h2>
            <p><em>Publicado el <?php echo htmlspecialchars($noticia['fecha_publicacion']); ?></em></p>
            <p><?php echo nl2br(htmlspecialchars($noticia['contenido'])); ?></p>
        </article>

        <div class="rating">
            <?php
            // Obtener la calificación promedio de la noticia
            $sql_promedio = "SELECT AVG(calificacion) as promedio FROM calificaciones WHERE noticia_id = ?";
            $stmt_promedio = $conn->prepare($sql_promedio);
            $stmt_promedio->bind_param('i', $id);
            $stmt_promedio->execute();
            $result_promedio = $stmt_promedio->get_result();
            $promedio_result = $result_promedio->fetch_assoc();
            $promedio = $promedio_result['promedio'] ?? 0;

            // Mostrar la calificación promedio
            echo "<p>Calificación promedio: " . round($promedio, 2) . " / 5</p>";

            // Mostrar el formulario de calificación solo si el usuario está autenticado
            if (isset($_SESSION['id'])) {
                $user_id = $_SESSION['id'];

                // Obtener la calificación del usuario para la noticia
                $sql_calificacion_usuario = "SELECT calificacion FROM calificaciones WHERE noticia_id = ? AND usuario_id = ?";
                $stmt_calificacion_usuario = $conn->prepare($sql_calificacion_usuario);
                $stmt_calificacion_usuario->bind_param('ii', $id, $user_id);
                $stmt_calificacion_usuario->execute();
                $result_calificacion_usuario = $stmt_calificacion_usuario->get_result();
                $calificacion_usuario = $result_calificacion_usuario->fetch_assoc()['calificacion'] ?? null;

                echo "<p>Tu calificación: " . ($calificacion_usuario ? $calificacion_usuario . " / 5" : "No has calificado esta noticia") . "</p>";

                echo "<form action='rate_noticia.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $noticia['id'] . "'>";
                echo "<label for='rating'>Califica esta noticia:</label>";
                echo "<select name='rating' id='rating'>";
                for ($i = 1; $i <= 5; $i++) {
                    echo "<option value='$i'" . ($calificacion_usuario == $i ? " selected" : "") . ">$i</option>";
                }
                echo "</select>";
                echo "<button type='submit'>Calificar</button>";
                echo "</form>";
            }
            ?>
        </div>


        <div class="comments">
            <h3>Comentarios</h3>
            <?php
            // Mostrar los comentarios de la noticia
            $sql_comentarios = "SELECT c.contenido, c.fecha_creacion, u.nusu FROM comentarios_noticias c JOIN usuarios u ON c.usuario_id = u.id WHERE c.noticia_id = ? ORDER BY c.fecha_creacion DESC";
            $stmt_comentarios = $conn->prepare($sql_comentarios);
            $stmt_comentarios->bind_param('i', $id);
            $stmt_comentarios->execute();
            $result_comentarios = $stmt_comentarios->get_result();

            if ($result_comentarios->num_rows > 0) {
                while ($comentario = $result_comentarios->fetch_assoc()) {
                    echo "<div>";
                    echo "<p><strong>" . htmlspecialchars($comentario['nusu']) . "</strong> dijo:</p>";
                    echo "<p>" . nl2br(htmlspecialchars($comentario['contenido'])) . "</p>";
                    echo "<p><em>Publicado el " . htmlspecialchars($comentario['fecha_creacion']) . "</em></p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay comentarios para esta noticia.</p>";
            }

            // Mostrar el formulario de comentarios solo si el usuario está autenticado
            if (isset($_SESSION['id'])) {
                echo "<h3>Deja tu comentario</h3>";
                echo "<form action='' method='post'>";
                echo "<textarea name='comentario' rows='4' cols='50' required></textarea><br>";
                echo "<button type='submit'>Comentar</button>";
                echo "</form>";
            } else {
                echo "<p>Inicia sesión para dejar un comentario.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>

</html>

<?php
$stmt->close();
$stmt_promedio->close();
$stmt_comentarios->close();
$conn->close();
?>