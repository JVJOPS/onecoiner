<?php
// Inicia una nueva sesión o reanuda la sesión existente
session_start();

// Incluye el archivo de conexión a la base de datos
require '../DATABASE/conexion.php';

// Verifica si la solicitud se realizó mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene y limpia el valor del campo 'correo' del formulario
    $correo = trim($_POST['correo']);
    // Obtiene y limpia el valor del campo 'clave' del formulario
    $clave = trim($_POST['clave']);
    
    // Verifica si el correo electrónico o la contraseña están vacíos
    if (empty($correo) || empty($clave)) {
        // Muestra un mensaje de error si alguno de los campos está vacío
        echo "Por favor ingrese tanto el correo electrónico como la contraseña.";
    } else {
        // Prepara una consulta SQL para seleccionar el id, nusu, correo, clave y rol del usuario con el correo electrónico especificado
        $stmt = $conexion->prepare("SELECT id, nusu, correo, clave, rol FROM usuarios WHERE correo = :correo");
        // Asigna el valor del correo electrónico a la variable de la consulta preparada
        $stmt->bindParam(':correo', $correo);
        // Ejecuta la consulta preparada
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            exit();
        }
        
        // Obtiene el resultado de la consulta como un arreglo asociativo
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verifica si se encontró un usuario y si la contraseña ingresada coincide con la almacenada en la base de datos
        if ($resultado && password_verify($clave, $resultado['clave'])) {
            // Si la autenticación es exitosa, guarda los datos del usuario en la sesión
            $_SESSION['id'] = $resultado['id'];
            $_SESSION['nusu'] = $resultado['nusu'];
            $_SESSION['correo'] = $resultado['correo'];
            $_SESSION['rol'] = $resultado['rol'];
            
            // Redirige al usuario dependiendo de su rol
            if ($resultado['rol'] == 'administrador') {
                header("Location: ../INICIO_ADMIN/inicio_admin.php");
            } else {
                header("Location: ../INICIO_USER/inicio_user.php");
            }
            
            // Detiene la ejecución del script
            exit();
        } else {
            // Muestra un mensaje de error si las credenciales son incorrectas
            echo "Correo electrónico o contraseña incorrectos.";
        }
    }
}
?>
