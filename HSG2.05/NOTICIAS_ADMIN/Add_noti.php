<?php
// Inicia una nueva sesión o reanuda la sesión existente
session_start();

// Incluye el archivo de conexión a la base de datos
require '../DATABASE/conexionnoti.php';

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'administrador') {
    die("Acceso no autorizado.");
}

// Verifica si la solicitud se realizó mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene y limpia el valor del campo 'titulo' del formulario
    $titulo = trim($_POST['titulo']);
    // Obtiene y limpia el valor del campo 'contenido' del formulario
    $contenido = trim($_POST['contenido']);
    // Obtiene el ID del usuario administrador desde la sesión
    $usuario_id = $_SESSION['id'];

    // Verifica si el título o el contenido están vacíos
    if (empty($titulo) || empty($contenido)) {
        $mensaje_error = "Por favor ingrese tanto el título como el contenido de la noticia.";
    } else {
        // Prepara una consulta SQL para insertar una nueva noticia
        $stmt = $conn->prepare("INSERT INTO noticias (titulo, contenido, usuario_id) VALUES (?, ?, ?)");
        // Asigna los valores a la consulta preparada
        $stmt->bind_param('ssi', $titulo, $contenido, $usuario_id);

        // Ejecuta la consulta preparada
        if ($stmt->execute()) {
            // Redirige a la misma página con un parámetro de éxito
            header("Location: Add_noti.php?success=1");
            exit();
        } else {
            $mensaje_error = "Error al agregar la noticia: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    }
}

// Cierra la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Noticia - Hardware and Software Gang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }
        header {
            background: #007bff;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        nav ul li {
            display: inline;
            margin: 0 1rem;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }
        h1 {
            margin: 0;
        }
        form {
            max-width: 600px;
            margin: 2rem auto;
            background: #fff;
            padding: 1.5rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin: 0.5rem 0;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 0.5rem;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .button {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 1rem 0;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        // Función para mostrar el cuadro de diálogo de éxito si el parámetro 'success' está en la URL
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success') && urlParams.get('success') == '1') {
                alert('Noticia agregada con éxito');
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Agregar Noticia - Hardware and Software Gang</h1>
        <nav>
            <ul>
                <li><a href="../INCIO_ADMIN/inicio_admin.php">Inicio</a></li>
                <li><a href="admin_noticias.php">Administrar Noticias</a></li>
                <li><a href="../INICIO_ADMIN/logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="Add_noti.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            <br>
            <label for="contenido">Contenido:</label>
            <textarea id="contenido" name="contenido" rows="10" required></textarea>
            <br>
            <input type="submit" value="Agregar Noticia">
        </form>
        <br>
        <!-- Botón para regresar a la página de administración de noticias -->
        <a href="../NOTICIAS_ADMIN/NOTDEF_admin.php" class="button">Regresar a Inicio</a>
        <?php
        // Mostrar mensaje de error si existe
        if (isset($mensaje_error)) {
            echo "<p class='error'>$mensaje_error</p>";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Hardware and Software Gang. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
