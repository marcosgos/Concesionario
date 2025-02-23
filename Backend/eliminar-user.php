<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <style>
        /* Estilos básicos (los mismos que en el código anterior) */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('fondo.jpg'); /* Cambiar URL por la del fondo */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .nav {
            background-color: rgba(51, 51, 51, 0.8);
            padding: 10px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .nav__list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 30px;
            position: relative;
        }
        .nav__list li {
            position: relative;
        }
        .nav__list a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            display: block;
            transition: background-color 0.3s;
        }
        .nav__list a:hover {
            background-color: #555;
        }
        .nav__list ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #444;
            list-style: none;
            margin: 0;
            padding: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }
        .nav__list ul li {
            width: 200px;
        }
        .nav__list ul a {
            padding: 10px 15px;
            color: white;
        }
        .nav__list ul a:hover {
            background-color: #666;
        }
        .nav__list li:hover > ul {
            display: block;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 20px;
        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            margin: 30px auto;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }
        button {
            padding: 10px 20px;
            background-color: #f44336; /* Rojo para el botón de eliminar */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #e53935;
        }
        .message {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
		/* Contenedor principal */
.container {
    font-family: 'Arial', sans-serif;
    margin: 20px auto;
    padding: 20px;
    max-width: 90%;
    background: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Estilo para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #ffffff;
    overflow: hidden;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

table th, table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #f0f0f0;
}

table th {
    background-color: #4CAF50;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 14px;
}

table tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

/* Botón Eliminar */
button {
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #ff1a1a;
}

/* Mensajes */
.message {
    margin: 15px 0;
    padding: 15px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.message.success {
    background-color: #dff0d8;
    color: #3c763d;
    border-left: 5px solid #4CAF50;
}

.message.error {
    background-color: #f2dede;
    color: #a94442;
    border-left: 5px solid #f44336;
}

.message.info {
    background-color: #d9edf7;
    color: #31708f;
    border-left: 5px solid #2196F3;
}

/* Adaptación para pantallas pequeñas */
@media (max-width: 768px) {
    table {
        font-size: 12px;
    }
    button {
        padding: 6px 12px;
        font-size: 12px;
    }
    .message {
        font-size: 14px;
    }
}
.cuenta {
    position: fixed; /* Cambiado de absolute a fixed para que se mantenga en la esquina */
    top: 15px; /* Ajusta el espacio desde la parte superior */
    right: 40px; /* Coloca el div en la esquina derecha */
}

.t{
	padding:5px;
	background-color:red;
	border-radius:20px;
}
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <a href="index.php"><img src="logo.jpg" alt="Logo del concesionario"></a>
    </div>

    <!-- Menú superior -->
    <div class="nav">
    <ul class="nav__list">
        <li>
            <a>Coches</a>
            <ul>
                <li><a href="registrar-coche.php">A&ntilde;adir</a></li>
                <li><a href="ver-coche.php">Listar</a></li>
                <li><a href="buscar-coche.php">Buscar</a></li>
                <li><a href="modificar-coche.php">Modificar</a></li>
                <li><a href="eliminar-coche.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a>Usuarios</a>
            <ul>
                <li><a href="registrar-user.php">A&ntilde;adir</a></li>
                <li><a href="ver-user.php">Listar</a></li>
				<li><a href="buscar-user.php">Buscar</a></li>
                <li><a href="modificar-user.php">Modificar</a></li>
                <li><a href="eliminar-user.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a>Alquileres</a>
            <ul>
				<li><a href="listar-alquileres.php">Listar</a></li>
                <li><a href="borrar-alquileres.php">Borrar</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="cuenta">
    <a href="cuenta.html">
        <button class="t">
            <?php 
            session_start();
            if (isset($_SESSION['name'])) {
                // Conexión a la base de datos
                $conexion = new mysqli("localhost", "root", "12345678", "concesionario");

                // Verificar conexión
                if ($conexion->connect_error) {
                    die("Error de conexión: " . $conexion->connect_error);
                }

                // Obtener saldo del usuario
                $nombra = $_SESSION['name'];
                $sql = "SELECT nombre, saldo FROM usuarios WHERE nombre = '$nombra'";
                $resultado = mysqli_query($conexion, $sql);

                if ($resultado && $fila = mysqli_fetch_assoc($resultado)) {
                    $nombre = $fila['nombre'];
                    $saldo = $fila['saldo'];

                    // Mostrar nombre y saldo
                    echo "$nombre - Saldo: $saldo";
                } else {
                    echo "Error al obtener saldo";
                }

                // Cerrar conexión
                mysqli_close($conexion);

                echo "<a href='cerrarsesion.php'><button class='t'>Cerrar Sesión</button></a>";
            } else {
                echo "Iniciar Sesión";
            }
            ?>
        </button>
    </a>
</div>


<div class="form-container">
    <h2>Buscar Usuarios</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nombre">Nombre del usuario:</label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido del usuario:</label>
            <input type="text" id="apellido" name="apellido">
        </div>
        <button type="submit">Buscar</button>
    </form>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "concesionario";

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_nombre']) && isset($_POST['delete_apellido'])) {
        // Eliminar usuario por nombre y apellido
        $delete_nombre = mysqli_real_escape_string($conn, $_POST['delete_nombre']);
        $delete_apellido = mysqli_real_escape_string($conn, $_POST['delete_apellido']);

        // Crear la consulta para eliminar
        $sql_delete = "DELETE FROM usuarios WHERE nombre = '$delete_nombre' AND apellidos = '$delete_apellido'";
        if (mysqli_query($conn, $sql_delete)) {
            echo "<div class='message success'>El usuario '$delete_nombre $delete_apellido' se ha eliminado correctamente.</div>";
        } else {
            echo "<div class='message error'>Error al eliminar el usuario: " . mysqli_error($conn) . "</div>";
        }
    } else {    
        $nombre = $_REQUEST['nombre'];
        $apellido = $_REQUEST['apellido'];

        $sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND apellidos LIKE '$apellido'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>Contraseña</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Saldo</th><th>Tipo de Usuario</th><th>Acción</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ($row['password']) . "</td>";
                echo "<td>" . ($row['nombre']) . "</td>";
                echo "<td>" . ($row['apellidos']) . "</td>"; // Aquí estaba el error, debería ser 'apellidos'
                echo "<td>" . ($row['email']) . "</td>";
                echo "<td>" . (is_null($row['saldo']) ? "0" : $row['saldo']) . "</td>";
                echo "<td>" . ($row['tipo_usuario']) . "</td>";
                echo "<td>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_nombre' value='" . htmlspecialchars($row['nombre']) . "'>
                            <input type='hidden' name='delete_apellido' value='" . htmlspecialchars($row['apellidos']) . "'> <!-- Aquí también estaba el error -->
                            <button type='submit'>Eliminar</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<div class='message'>No se encontraron resultados para el nombre y apellido especificados.</div>";
        }
    }
}
mysqli_close($conn);
?>




</body>
</html>

