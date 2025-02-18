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
$modelo = $_REQUEST['modelo'];
$marca = $_REQUEST['marca'];
$color = $_REQUEST['color'];
$precio = $_REQUEST['precio'];
$alquilado = $_REQUEST['alquilado'];
$foto = $_REQUEST['foto'];

// Consulta SQL
$sql = "Insert into concesionario ";
$result = mysqli_query($conn, $sql);

// Verificar resultados
if (mysqli_num_rows($result) == 1) {
    echo "<h1>El coche " . htmlspecialchars($modelo) . "registrado correctamente!</h1>";
} else {
    echo "<h1>Datos invalido</h1>";
    echo "<a href='index.html'>Intentar de nuevo</a>";
}

// Cerrar conexión
mysqli_close($conn);
?>