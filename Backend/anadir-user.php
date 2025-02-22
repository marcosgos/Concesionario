<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "concesionario";

// Conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Obtener y procesar datos del usuario
$nombre = $_REQUEST['Nombre'];
$apellidos = $_REQUEST['Apellidos'];
$email = $_REQUEST['Email'];
$contraseña = $_REQUEST['Contraseña'];
$tipo = $_REQUEST['tipo_usuario'];

// Encriptar la contraseña
$contraseña_encriptada = password_hash($contraseña, PASSWORD_BCRYPT);

// Consulta SQL
$sql = "INSERT INTO usuarios (password, nombre, apellidos, email, tipo_usuario) 
        VALUES ('$contraseña_encriptada', '$nombre', '$apellidos', '$email', '$tipo')";

// Verificar resultados
if (mysqli_query($conn, $sql)) {
    echo "<h1>El usuario " . ($nombre) . " fue registrado correctamente!</h1>";
    echo "<a href='registrar-user.php'>Insertar más Usuarios??</a>";
} else {
    echo "<h1>Error en el registro: " . mysqli_error($conn) . "</h1>";
    echo "<a href='registrar-user.php'>Intentar de nuevo</a>";
}

// Cerrar conexión
mysqli_close($conn);
?>
