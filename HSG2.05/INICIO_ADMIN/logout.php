<?php
session_start();
session_unset(); // Destruir todas las variables de sesión
session_destroy(); // Destruir la sesión actual
header('Location: ../INICIO_DEFAULT/Inicio.html'); // Redirigir a la página de inicio de sesión
exit();

?>
