<?php
session_start(); // Iniciar la sesión si no está iniciada
session_destroy(); // Destruir la sesión
header("Location: ../../index.html"); // Redirigir a la página de inicio
exit();
