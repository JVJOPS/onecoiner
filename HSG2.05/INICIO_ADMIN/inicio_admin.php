<?php
session_start(); // Iniciar sesión para usar variables de sesión

include('../DATABASE/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT id, rol FROM usuarios WHERE correo = ? AND clave = ?");
    $stmt->bind_param("ss", $correo, $clave);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Inicio de sesión exitoso
        $stmt->bind_result($id, $rol);
        $stmt->fetch();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["rol"] = $rol;

        // Redirigir según el rol del usuario
        if ($rol === "administrador") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
        exit();
    } else {
        echo "Correo o clave incorrectos";
    }

    $stmt->close();
}

// No es necesario llamar a $conn->open(); ya que la conexión se establece al crear el objeto $conn
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSG</title>
    <link rel="stylesheet" href="inicio_admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div>
            <!-- Mostrar el nombre de usuario si está definido -->
            <span>"¡¡Bienvenido a Hardware and software Gang!!"</span>
            <br>Estas en la pagina de inicio 🤓</br>
            <br>Eres admistrador papu 😎</br>
        </div>
        <nav>
            <ul>
                <li><a href="./misdaadmin.php">Ver mis datos</a></li>
                <li><a href="./datos_usuarios.php">Ver Usuarios</a></li>                
                <li><a href="./logout.php">Cerrar sesión</a></li>
            </ul>
        </nav>
    </header>
    <main class="main-content">
        <section class="noticias-section">
            <h2 class="section-heading">Noticias</h2>
            <div class="carousel">
                <div class="carousel-item">
                    <img src="hola1.png" alt="Noticia 1" width="500px" height="500px">
                    <div class="carousel-caption">Noticia 1: Detalles importantes sobre el último lanzamiento.</div>
                </div>
                <div class="carousel-item">
                    <img src="IMG_20240302_210958.jpg" alt="Noticia 2" width="500px" height="500px">
                    <div class="carousel-caption">Noticia 2: Más información interesante.</div>
                </div>
                <div class="carousel-item">
                    <img src="./IMG_20240302_210958.jpg" alt="Noticia 3" width="500px" height="500px">
                    <div class="carousel-caption">Noticia 3: Consejos para mejorar tu experiencia de juego.</div>
                </div>
                <div class="carousel-item">
                    <img src="./Tilin.jpg" alt="Noticia 4" width="500px" height="500px">
                    <div class="carousel-caption">Noticia 4: Últimas novedades.</div>
                </div>
            </div>
            <div class="button-container">
                <button onclick="window.location.href='../NOTCIAS/noticias.php'" class="button primary-button">Ver más Noticias</button>
            </div>
        </section>

        <section class="foro-section">
            <h2 class="section-heading">Foro</h2>
            <div class="contenido-foro">
                <!-- Contenido del foro aquí -->
                <p>Contenido del foro...</p>
            </div>
            <div class="button-container">
                <button onclick="window.location.href='../FOROADMIN/foroAdmin.php'" class="button primary-button">Ir al Foro</button>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 HSG. Todos los derechos reservados.</p>
    </footer>
    <script src="script.js"></script>
</body>

</html>
