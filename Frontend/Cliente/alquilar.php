<?php
session_start(); // Iniciar sesión

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
    die("Debes iniciar sesión para alquilar un coche.");
}

$nombre = $_SESSION['name'];

// Verificar que se ha recibido el ID del coche
if (!isset($_POST['id_coche'])) {
    die("No se ha seleccionado un coche para alquilar.");
}

$id_coche = intval($_POST['id_coche']);

// Si se envió el formulario con las fechas de alquiler
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmar_alquiler'])) {
    $hora_inicio = $_POST['hora_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Obtener el precio del coche y el nombre del vendedor
    $sql = "SELECT precio, vendedor FROM coches WHERE id_coche = $id_coche AND alquilado = 0";
    $resultado = mysqli_query($conn, $sql);
    $coche = mysqli_fetch_assoc($resultado);

    if (!$coche) {
        die("El coche ya está alquilado o no existe.");
    }

    $precio_coche = $coche['precio'];
    $vendedor = $coche['vendedor'];

    // Consultar el saldo del usuario (cliente)
    $sql_saldo = "SELECT saldo FROM usuarios WHERE nombre = '$nombre'";
    $resultado_saldo = mysqli_query($conn, $sql_saldo);
    $cliente = mysqli_fetch_assoc($resultado_saldo);

    if (!$cliente) {
        die("Error al obtener saldo del cliente.");
    }

    $saldo_cliente = $cliente['saldo'];

    // Verificar si tiene saldo suficiente
    if ($saldo_cliente < $precio_coche) {
        die("Saldo insuficiente para alquilar este coche.");
    }

    // Restar saldo del cliente
    $sql_update_saldo = "UPDATE usuarios SET saldo = saldo - $precio_coche WHERE nombre = '$nombre'";
    mysqli_query($conn, $sql_update_saldo);

    // Sumar saldo al vendedor
    $sql_update_vendedor = "UPDATE usuarios SET saldo = saldo + $precio_coche WHERE nombre = '$vendedor'";
    mysqli_query($conn, $sql_update_vendedor);

    // Marcar el coche como alquilado
    $sql_update_coche = "UPDATE coches SET alquilado = 1 WHERE id_coche = $id_coche";
    mysqli_query($conn, $sql_update_coche);

    // Obtener el ID del usuario (cliente)
    $g_query = "SELECT id_usuario FROM usuarios WHERE nombre = '$nombre'";
    $resultado = mysqli_query($conn, $g_query);
    
    if ($fila = mysqli_fetch_assoc($resultado)) {
        $id_usuario = $fila['id_usuario'];

        // Insertar en la tabla alquileres
        $sql_insert = "INSERT INTO alquileres (id_usuario, id_coche, prestado, devuelto) VALUES ($id_usuario, $id_coche, '$hora_inicio', '$fecha_fin')";
        mysqli_query($conn, $sql_insert);
        
        echo "<p>Alquiler realizado con éxito. Se ha descontado $$precio_coche de tu saldo.</p>";
        echo "<p>El vendedor <strong>$vendedor</strong> ha recibido $$precio_coche en su saldo.</p>";
		echo "<a href='ver-coche.php'><button>Pulsa para volver...</button></a>";
    } else {
        echo "Error: Usuario no encontrado.";
    }
} else {
    // Formulario para solicitar hora de inicio y fecha fin
    echo "<form method='post'>";
    echo "<input type='hidden' name='id_coche' value='$id_coche'>";
    echo "Fecha de inicio: <input type='date' name='hora_inicio' required><br>";
    echo "Fecha de fin: <input type='date' name='fecha_fin' required><br>";
    echo "<button type='submit' name='confirmar_alquiler'>Confirmar Alquiler</button>";
    echo "</form>";
}

// Cerrar conexión
mysqli_close($conn);
?>
