<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
              body {
            font-family: 'Roboto', sans-serif;
            background-color: #f2f2f2;
            padding-top: 50px;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
            color: #666;
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 15px 25px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            display: block;
            font-size: 18px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        nav {
            background-color: #333;
            padding: 15px 0;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            font-size: 18px;
        }

        nav ul li a:hover {
            background-color: #555;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="../INICIO_DEFAULT/Inicio.html">Inicio</a></li>
            <li><a href="../LOGIN/usulogin.php">Iniciar Sesion</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h3>Registro de usuario</h3>
                <form method="post" action="usureg.php">
                    <div class="form-group">
                        <label for="nusu">Nombre de usuario:</label>
                        <input type="text" class="form-control" id="nusu" name="nusu" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="clave">Contraseña:</label>
                        <input type="password" class="form-control" id="clave" name="clave" required>
                    </div>
                    <input type="submit" value="Registrar" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
