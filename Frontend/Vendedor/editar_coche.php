<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modelo']) && isset($_POST['marca'])) {
        $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
        $marca = mysqli_real_escape_string($conn, $_POST['marca']);

        // Obtener datos actuales del coche
        $sql = "SELECT * FROM coches WHERE modelo = '$modelo' AND marca = '$marca'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "<div class='message error'>Coche no encontrado.</div>";
            exit;
        }
    } elseif (isset($_POST['update_modelo']) && isset($_POST['update_marca'])) {
        // Actualizar datos del coche
        $original_modelo = mysqli_real_escape_string($conn, $_POST['original_modelo']);
        $original_marca = mysqli_real_escape_string($conn, $_POST['original_marca']);
        $modelo = mysqli_real_escape_string($conn, $_POST['update_modelo']);
        $marca = mysqli_real_escape_string($conn, $_POST['update_marca']);
        $color = mysqli_real_escape_string($conn, $_POST['color']);
        $precio = floatval($_POST['precio']);
        $alquilado = isset($_POST['alquilado']) ? 1 : 0;

        $sql_update = "UPDATE coches SET modelo = '$modelo', marca = '$marca', color = '$color', precio = $precio, alquilado = $alquilado 
                       WHERE modelo = '$original_modelo' AND marca = '$original_marca'";

        if (mysqli_query($conn, $sql_update)) {
            echo "<div class='message success'>Coche actualizado correctamente.</div>";
			echo "<a href='modificar-coche.php'><button>Pulsa para volver..</button></a>";
        } else {
            echo "<div class='message error'>Error al actualizar el coche: " . mysqli_error($conn) . "</div>";
        }
        exit;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Coche</title>
</head>
<style>
.form-container {
    width: 100%;
    max-width: 400px;
    margin: 40px auto;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h2 {
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

input[type="text"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease-in-out;
}

input[type="text"]:focus,
input[type="number"]:focus {
    border-color: #007bff;
    outline: none;
}

input[type="checkbox"] {
    width: 16px;
    height: 16px;
    margin-left: 10px;
}

button {
    width: 100%;
    padding: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
}

button:hover {
    background: #0056b3;
}

</style>
<body>
    <div class="form-container">
        <h2>Editar Coche</h2>
        <form method="POST">
            <input type="hidden" name="original_modelo" value="<?php echo htmlspecialchars($row['modelo']); ?>">
            <input type="hidden" name="original_marca" value="<?php echo htmlspecialchars($row['marca']); ?>">
            <div class="form-group">
                <label for="update_modelo">Modelo:</label>
                <input type="text" id="update_modelo" name="update_modelo" value="<?php echo htmlspecialchars($row['modelo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="update_marca">Marca:</label>
                <input type="text" id="update_marca" name="update_marca" value="<?php echo htmlspecialchars($row['marca']); ?>" required>
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" value="<?php echo htmlspecialchars($row['color']); ?>" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alquilado">¿Alquilado?</label>
                <input type="checkbox" id="alquilado" name="alquilado" <?php echo $row['alquilado'] ? 'checked' : ''; ?>>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>

