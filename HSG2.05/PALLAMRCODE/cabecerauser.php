<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - HSG</title>
    <style>
        /* Estilos para la cabecera */
        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            background-color: #f0f0f0;
            margin-bottom: 20px;
        }

        .header img {
            width: 320px;
            height: auto;
            max-width: 100%;
        }

        /* Estilos para el menú de navegación */
        .navbar {
            background-color: #333;
            border: none;
            border-radius: 0;
            margin-bottom: 20px;
        }

        .navbar-nav {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar-nav li {
            margin: 0 10px;
        }

        .navbar-nav li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav li a:hover,
        .navbar-nav li a:focus,
        .navbar-nav li.active a {
            background-color: #555;
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="cab.png" class="img-responsive" alt="Logo del foro">
        </div>

        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="active"><a href="http://localhost/NUEVO/INICIO_USER/inicio_user.php">Página de Inicio</a></li>
                <li><a href="../INICIO_USER/logout.php" class="logout-button">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>

    <!-- Aquí continuaría el contenido del cuerpo de tu página -->
    <div class="container">
        <!-- Otro contenido de tu página -->
    </div>
</body>

</html>
