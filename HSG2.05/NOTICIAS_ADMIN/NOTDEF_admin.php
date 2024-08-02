<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Noticias - Hardware and Software Gang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2rem;
        }
        nav {
            background-color: #444;
            padding: 0.5rem 1rem;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin: 0 0.5rem;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            border-radius: 5px;
        }
        nav ul li a:hover {
            background-color: #0056b3;
            text-decoration: underline;
        }
        main {
            padding: 2rem;
        }
        section#news {
            background: #fff;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        article {
            margin-bottom: 1.5rem;
        }
        article h3 {
            margin: 0;
            font-size: 1.5rem;
        }
        article p {
            margin: 0.5rem 0;
        }
        article em {
            font-style: italic;
            color: #666;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gestión de Noticias - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="../INICIO_ADMIN/inicio_admin.php">Inicio</a></li>
                <?php
                session_start();
                // Verificar si el usuario está autenticado y es administrador
                if (isset($_SESSION['id']) && $_SESSION['rol'] === 'administrador') {
                    echo '<li><a href="Add_noti.php">Agregar Nueva Noticia</a></li>';
                    echo '<li><a href="adminstrar_noti.php">Administrar Noticias</a></li>';
                }
                ?>
                <li><a href="../INICIO_ADMIN/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="news">
            <h2>Noticias</h2>
            <?php
            require '../DATABASE/conexionnoti.php';

            // Obtener las noticias
            $sql = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
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

            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
