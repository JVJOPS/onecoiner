<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - HSG</title>
    <style>
        /* Estilos para la cabecera */
        .header {
            text-align: center;
            padding: 20px;
            background-color: #f0f0f0; /* Color de fondo de la cabecera */
            margin-bottom: 20px; /* Espacio inferior para separar del contenido siguiente */
        }

        .header img {
            width: 320px; /* Ancho deseado para la imagen */
            height: 480px; /* Altura deseada para la imagen */
            max-width: 100%;
            height: auto;
            display: block; /* Para asegurar que la imagen se centre correctamente */
            margin: 0 auto; /* Centra la imagen horizontalmente */
        }

        /* Estilos para el menú de navegación */
        .navbar {
            margin-bottom: 0; /* Elimina el margen inferior predeterminado de la barra de navegación */
            border-radius: 0; /* Elimina bordes redondeados */
        }

        .navbar-inverse {
            background-color: #333; /* Color de fondo de la barra de navegación */
            border: none; /* Sin borde */
        }

        .navbar-inverse .navbar-nav > li > a {
            color: #fff; /* Color del texto del enlace */
        }

        .navbar-inverse .navbar-nav > li > a:hover,
        .navbar-inverse .navbar-nav > li > a:focus {
            background-color: #555; /* Color de fondo al pasar el mouse o enfocar el enlace */
        }

        .navbar-inverse .navbar-nav > .active > a,
        .navbar-inverse .navbar-nav > .active > a:hover,
        .navbar-inverse .navbar-nav > .active > a:focus {
            background-color: #555; /* Color de fondo del enlace activo */
        }

        .navbar-inverse .navbar-nav > li > a {
            padding: 10px 15px; /* Añade espaciado interno a los enlaces del menú */
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
    </div>

    <!-- Aquí continuaría el contenido del cuerpo de tu página -->
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <ul class="nav navbar-nav">
                <li class="active"><a href="../INICIO_DEFAULT/Inicio.html">Pagina de Inicio</a></li>
                    <li class="active"><a href="http://localhost/NUEVO/FOROUSER/Usutareas.php">Inicio del Foro</a></li>
                    <li><a href="#">Página 1</a></li>
                    <li><a href="#">Página 2</a></li>
                    <li><a href="#">Página 3</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Otro contenido de tu página -->
