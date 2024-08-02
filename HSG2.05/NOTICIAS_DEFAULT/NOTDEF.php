<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias - Hardware and Software Gang</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2em;
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
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        section#news {
            margin-bottom: 20px;
        }

        article {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        article h3 {
            margin-top: 0;
        }

        article p {
            margin: 5px 0;
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
        <h1>Noticias - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="../INICIO_DEFAULT/Inicio.html">Inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="news">
            <h2>Últimas Noticias</h2>
            <?php
            // Incluye el archivo de conexión a la base de datos
            require '../DATABASE/conexionnoti.php';

            // Prepara la consulta para obtener las noticias
            $sql = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Recorre cada noticia y muestra el contenido
                while($row = $result->fetch_assoc()) {
                    echo "<article>";
                    echo "<h3>" . htmlspecialchars($row['titulo']) . "</h3>";
                    echo "<p><em>Publicado el " . htmlspecialchars($row['fecha_publicacion']) . "</em></p>";
                    echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>";
                    echo "</article>";
                }
            } else {
                echo "<p>No hay noticias disponibles en este momento.</p>";
            }

            // Cierra la conexión
            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
