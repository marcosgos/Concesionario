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
$contraseña = $_REQUEST['Contraseña'];
$DNI = $_REQUEST['DNI'];
$saldo = $_REQUEST['saldo'];

// Consulta SQL
$sql = "INSERT INTO usuarios (password, nombre, apellidos, dni, saldo) 
        VALUES ('$contraseña', '$nombre', '$apellidos', '$DNI', $saldo)";

// Verificar resultados
if (mysqli_query($conn, $sql)) {
    echo "<h1>El usuario " . ($nombre) . " fue registrado correctamente!</h1>";
	echo "<a href='registrar-user.html'>Insertar mas Usuarios??</a>";
} else {
    echo "<h1>Error en el registro: " . mysqli_error($conn) . "</h1>";
    echo "<a href='registrar-user.html'>Intentar de nuevo</a>";
}

// Cerrar conexión
mysqli_close($conn);
?>