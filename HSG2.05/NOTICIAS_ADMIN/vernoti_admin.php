<?php
session_start();
require '../DATABASE/conexionnoti.php';

// Verifica si el usuario está autenticado y es administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrador') {
    echo "Acceso denegado.";
    exit();
}

// Verifica si se proporcionó el ID de la noticia
if (!isset($_GET['noticia_id'])) {
    echo "No se proporcionó una noticia válida.";
    exit();
}

$noticia_id = intval($_GET['noticia_id']);

try {
    // Conexión a la base de datos
    $stmt = $conn->prepare("SELECT titulo, contenido, fecha_publicacion FROM noticias WHERE id = ?");
    $stmt->bind_param("i", $noticia_id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        $noticia = $resultado->fetch_assoc();
        $titulo = $noticia['titulo'];
        $contenido = $noticia['contenido'];
        $fecha_publicacion = $noticia['fecha_publicacion'];

        // Obtiene el promedio de calificaciones
        $stmt = $conn->prepare("SELECT AVG(calificacion) as promedio FROM calificaciones WHERE noticia_id = ?");
        $stmt->bind_param("i", $noticia_id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        $promedio = 0;
        if ($resultado->num_rows > 0) {
            $calificacion = $resultado->fetch_assoc();
            $promedio = $calificacion['promedio'];
        }

        // Muestra los detalles de la noticia y el promedio de calificaciones
        echo "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f9;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 600px;
                    width: 100%;
                    margin: 20px;
                }
                h1 {
                    color: #333;
                }
                p {
                    color: #555;
                    line-height: 1.6;
                }
                .fecha-publicacion, .promedio-calificaciones {
                    font-weight: bold;
                    margin-top: 10px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h1>$titulo</h1>
                <p>$contenido</p>
                <p class='fecha-publicacion'>Fecha de publicación: $fecha_publicacion</p>
                <p class='promedio-calificaciones'>Promedio de calificaciones: " . round($promedio, 2) . "</p>
            </div>
        </body>
        </html>";
    } else {
        echo "No se encontró la noticia.";
    }
    
    $stmt->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
