<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Tu host de MySQL
$dbname = 'bdHSG';   // Nombre de tu base de datos
$username = 'root';  // Tu usuario de MySQL
$password = '';      // Tu contraseña de MySQL

try {
    // Crear conexión PDO
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Configurar PDO para que lance excepciones en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta SQL para obtener los datos de la tabla usuarios
$sql = "SELECT id, nusu, correo, rol FROM usuarios";
$stmt = $conexion->prepare($sql);
$stmt->execute();

// Mostrar los datos en una tabla HTML con estilos ajustados
echo "<style>
        body {
            background-color: #303030;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .table-container {
            box-shadow: 9px 9px 16px #252525, -9px -9px 16px #3b3b3b;
            border-radius: 15px;
            overflow: hidden;
            padding: 20px;
            background-color: #404040;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 15px;
            text-align: left;
            font-size: 18px; /* Tamaño de la letra aumentado */
        }
        th {
            background-color: #b19cd9;
            color: #303030;
        }
        tr {
            background-color: #505050;
        }
        tr:nth-child(even) {
            background-color: #404040;
        }
      </style>";

if ($stmt->rowCount() > 0) {
    echo "<div class='table-container'>
            <table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                </tr>";
    // Salida de los datos de cada fila
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nusu"] . "</td>
                <td>" . $row["correo"] . "</td>
                <td>" . $row["rol"] . "</td>
              </tr>";
    }
    echo "</table></div>";
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conexion = null;
?>
