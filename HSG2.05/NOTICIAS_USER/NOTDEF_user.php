<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Hardware and Software Gang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 10px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
        }

        section#news {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section#news h2 {
            margin-top: 0;
        }

        article {
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        article h3 {
            margin: 0;
            font-size: 20px;
        }

        article p {
            margin: 5px 0;
        }

        article a {
            color: #007BFF;
            text-decoration: none;
        }

        article a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>Noticias - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="../INICIO_USER/inicio_user.php">Inicio</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="news">
            <h2>Últimas Noticias</h2>
            <?php
            session_start();
            require '../DATABASE/conexionnoti.php';

            // Obtener las noticias
            $sql = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<article>";
                    echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
                    echo "<p><em>Publicado el " . htmlspecialchars($row['fecha_publicacion']) . "</em></p>";
                    echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>";
                    echo "<a href='vernoti_user.php?id=" . $row['id'] . "'>Ver Noticia</a>";
                    echo "</article>";
                }
            } else {
                echo "<p>No hay noticias disponibles en este momento.</p>";
            }

            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
