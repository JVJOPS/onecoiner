<?php
// Variables para mostrar los datos del usuario registrado
$nusu = '';
$correo = '';
$clave = ''; // Añadir la variable clave

// Verificar que los datos del formulario han sido enviados y procesar el registro
if (isset($_POST['nusu'], $_POST['correo'], $_POST['clave'])) {
    // Obtener datos del formulario
    $nusu = $_POST['nusu'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    // Datos de conexión a la base de datos
    $host = 'localhost'; // Tu host de MySQL
    $dbname = 'bdHSG';   // Nombre de tu base de datos
    $username = 'root';  // Tu usuario de MySQL
    $password = '';      // Tu contraseña de MySQL

    try {
        // Crear conexión PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        
        // Configurar PDO para que lance excepciones en caso de error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Hash de la contraseña (ejemplo básico, utilizar métodos seguros en producción)
        $hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

        // Preparar la consulta SQL con parámetros
        $sql = "INSERT INTO usuarios (nusu, correo, clave) VALUES (:nusu, :correo, :clave)";
        $stmt = $pdo->prepare($sql);

        // Asignar valores a los parámetros y ejecutar la consulta
        $stmt->bindParam(':nusu', $nusu);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':clave', $hashed_clave);

        if ($stmt->execute()) {
            
            echo ""; // Registro exitoso
        } else {
            echo ""; //Error al registrar el usuario.
        }

    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

    // Cerrar la conexión
    $pdo = null;
} else {
    echo "Por favor, complete todos los campos del formulario.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }
        h2 {
            text-align: center;
            color: #000;
        }
        h3 {
            text-align: center;
            color: #666;
            font-size: 1.2em;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 8px 0;
            color: #000;
        }
        strong {
            color: #000;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            background-color: #000;
            color: #fff;
            border: 1px solid #000;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        button:hover {
            background-color: #333;
            border-color: #333;
        }
        #password-container {
            position: relative;
            margin-top: 10px;
        }
        #password-input {
            width: calc(100% - 60px); /* Ajustar el ancho para el botón */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            background: #000;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        #toggle-password:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Datos de tu usuario</h2>
        <h3>No los olvides por favor 🤓!!</h3>
        
        <?php if (!empty($nusu) && !empty($correo) && !empty($clave)) : ?>
            <p>Usuario registrado ✔</p>
            <ul>
                <li><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($nusu); ?></li>
                <li><strong>Correo electrónico:</strong> <?php echo htmlspecialchars($correo); ?></li>
                <li><strong>Contraseña:</strong>
                    <div id="password-container">
                        <input type="password" id="password-input" value="<?php echo htmlspecialchars($clave); ?>" disabled>
                        <button type="button" id="toggle-password">Mostrar</button>
                    </div>
                </li>
            </ul>
        <?php endif; ?>

        <div class="buttons">
            <form action="../FOROUSER/foro.php" method="get">
                <button type="submit">Regresar al foro</button>
            </form>
            <form action="Ir al apartado de noticias" method="get"> 
                <button type="submit">Ver Noticias</button>
            </form>
            <form action="../INICIO_USER/inicio_user.php" method="get"> 
                <button type="submit">Ir al inicio</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordInput = document.getElementById('password-input');
            var toggleButton = document.getElementById('toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.textContent = 'Ocultar';
            } else {
                passwordInput.type = 'password';
                toggleButton.textContent = 'Mostrar';
            }
        });
    </script>
</body>
</html>
