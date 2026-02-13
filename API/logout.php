<?php
session_start();
session_destroy(); // Elimina todos los datos de la sesión actual
header("Location: ../public/login.php"); // Redirige al formulario de acceso
exit();
?>