<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - HSG</title>
    <link rel="stylesheet" href="./usulogin.css">
</head>

<body>
<header>
        <nav>
            <ul>
             
                <li><a href="../INICIO_DEFAULT/Inicio.html">INICIO</a></li>
 
            </ul>
        </nav>
    </header>
    <div class="login-container">
        <form method="post" action="validar.php" class="login-form">
            <h2 class="form-title">Iniciar Sesión</h2>
            <div class="form-group">
                <input class="form-control" type="email" name="correo" placeholder="Correo electrónico" required>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="clave" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Ingresar" class="btn btn-primary">
            </div>
        </form>
        <div class="register-link">
            <p>¿No tienes una cuenta?</p>
            <a href="../REGISTRARSE/Regusuform.php" class="btn btn-secondary">Registrarse</a>
        </div>
    </div>
</body>

</html>
