<style>
<style>
    /* Estilos generales para el formulario */
    form {
        width: 80%;
        max-width: 700px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    form h2 {
        text-align: center;
        color: #333;
    }

    label {
        font-size: 1.1em;
        color: #555;
        margin-bottom: 10px;
        display: block;
    }

    input[type="text"], select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1em;
    }

    input[type="text"]:focus, select:focus {
        border-color: #007BFF;
        outline: none;
    }

    button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 1.1em;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #218838;
    }

    .message {
        padding: 10px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 5px;
        margin-top: 20px;
        text-align: center;
    }
</style>

</style>
<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
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
    $email = $_POST['email'];
    $saldo = $_POST['saldo'];
    $tipo_usuario = $_POST['tipo_usuario'];  // Se captura el tipo de usuario

    // Consulta SQL para actualizar los datos del usuario
    $sql = "UPDATE usuarios SET password = '$password', nombre = '$nombre', apellidos = '$apellido', email = '$email', saldo = '$saldo', tipo_usuario = '$tipo_usuario' WHERE nombre = '$nombre' AND apellidos = '$apellido'";

    if (mysqli_query($conn, $sql)) {
        echo "<div>Usuario actualizado con éxito.</div>";
        echo "<div><a href='modificar-user.php'>Volver a Modificar</a></div>";
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

                <label for="dni">Nombre:</label>
                <input type="text" name="dni" value="<?php echo $row['nombre']; ?>"><br>

                <label for="dni">Apellido:</label>
                <input type="text" name="dni" value="<?php echo $row['apellidos']; ?>"><br>

                <label for="email">Email:</label>
                <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>

                <label for="saldo">Saldo:</label>
                <input type="text" name="saldo" value="<?php echo (is_null($row['saldo']) ? "0" : $row['saldo']); ?>"><br>

                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select name="tipo_usuario" id="tipo_usuario">
                    <option value="cliente" <?php echo ($row['tipo_usuario'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                    <option value="admin" <?php echo ($row['tipo_usuario'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="vendedor" <?php echo ($row['tipo_usuario'] == 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                </select><br>

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


