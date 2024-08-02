<?php
// Configuración de la conexión a la base de datos
include("../DATABASE/conexionuser.php");

// Consulta SQL para obtener los datos de la tabla usuarios
$sql = "SELECT id, nusu, correo, rol FROM usuarios";
$stmt = $conexion->prepare($sql);
$stmt->execute();

// Mostrar los datos en una tabla HTML
if ($stmt->rowCount() > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
            </tr>";
    // Salida de los datos de cada fila
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["nusu"] . "</td>
                <td>" . $row["correo"] . "</td>
                <td>" . $row["rol"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

// Cerrar la conexión
$conexion = null;
?>
