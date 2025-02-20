<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "concesionario";

// Conexión a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si se envía el formulario con los cambios
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $password = $_POST['password'];
    $dni = $_POST['dni'];
    $saldo = $_POST['saldo'];

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE usuarios SET password = '$password', dni = '$dni', saldo = '$saldo' WHERE nombre = '$nombre' AND apellidos = '$apellido'";

    if (mysqli_query($conn, $sql)) {
        echo "<div>Usuario actualizado con éxito.</div>";
		echo "<div><a href=modificar-user.php>Volver a Modificar</a></div>";
    } else {
        echo "<div>Error al actualizar el usuario: " . mysqli_error($conn) . "</div>";
    }
} else {
    // Si es una solicitud GET, se mostrará el formulario para modificar los datos
    if (isset($_GET['nombre']) && isset($_GET['apellido'])) {
        $nombre = $_GET['nombre'];
        $apellido = $_GET['apellido'];

        // Consultar la base de datos para obtener los detalles del usuario
        $sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND apellidos LIKE '$apellido'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <h2>Modificar Usuario</h2>
            <form method="POST" action="">
                <input type="hidden" name="nombre" value="<?php echo $row['nombre']; ?>">
                <input type="hidden" name="apellido" value="<?php echo $row['apellidos']; ?>">

                <label for="password">Contraseña:</label>
                <input type="text" name="password" value="<?php echo $row['password']; ?>"><br>

                <label for="dni">DNI:</label>
                <input type="text" name="dni" value="<?php echo $row['dni']; ?>"><br>

                <label for="saldo">Saldo:</label>
                <input type="text" name="saldo" value="<?php echo $row['saldo']; ?>"><br>

                <button type="submit">Guardar Cambios</button>
            </form>
            <?php
        } else {
            echo "<div class='message'>No se encontró al usuario</div>";
        }
    } else {
        echo "<div class='message'>No se especificaron el nombre y apellido para modificar.</div>";
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

