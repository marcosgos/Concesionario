<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "concesionario";

// Conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$ve = $_SESSION['name'];
// Obtener y procesar datos del usuario
$modelo = $_REQUEST['modelo'];
$marca = $_REQUEST['marca'];
$color = $_REQUEST['color'];
$precio = $_REQUEST['precio'];
$alquilado_texto = $_REQUEST['alquilado'];

// Convertir el valor de alquilado a numérico
$alquilado = ($alquilado_texto === "Si") ? 1 : 0;

// Directorio donde se guardarán las imágenes
$target_dir = "C:/AppServ/www/php/php/img/";

// Verificar si se envió un archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    
    // Obtener el nombre y ruta del archivo destino
    $target_file = $target_dir . basename($file["name"]);

    // Intentar mover el archivo al directorio de destino
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $foto = "img/" . basename($file["name"]); // Ruta de la imagen para la base de datos
        echo "La imagen " . htmlspecialchars(basename($file["name"])) . " se ha subido correctamente.";
    } else {
        die("Hubo un error al subir el archivo.");
    }
} else {
    die("No se ha seleccionado ningún archivo.");
}

// Consulta SQL
$sql = "INSERT INTO coches (modelo, marca, color, precio, alquilado, foto, vendedor) 
        VALUES ('$modelo', '$marca', '$color', $precio, $alquilado, '$foto', '$ve')";

// Verificar resultados
if (mysqli_query($conn, $sql)) {
    echo "<h1>El coche " . htmlspecialchars($modelo) . " registrado correctamente!</h1>";
    echo "<a href='registrar-coche.php'>Insertar otros coches??</a>";
} else {
    echo "<h1>Error en el registro: " . mysqli_error($conn) . "</h1>";
    echo "<a href='registrar-coche.php'>Intentar de nuevo</a>";
}

// Cerrar conexión
mysqli_close($conn);
?>

