<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coche</title>
    <style>
        /* Incluye todos los estilos de tu diseño original */
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
			border-radius:20px;
			
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
            background-color: #f2f2f2;
			border-radius:20px;
        }
        th {
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
			border-radius:20px;
        }
        .message {
            text-align: center;
            color: black;
            font-weight: bold;
            margin-top: 50px;
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
                <li><a href="ver-user.php">Listar</a></li>
				<li><a href="buscar-user.php">Buscar</a></li>
            </ul>
        </li>
        <li>
            <a>Alquileres</a>
            <ul>
				<li><a href="listar-alquileres.php">Listar</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="cuenta">
    <a href="cuenta.html">
        <button class="t">
            <?php 
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
        <h2>Buscar Usuario:</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nombre">Nombre del Usuario:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellidos del Usuario:</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>
            <button type="submit">Buscar</button>
        </form>
    </div>
    <div class="container">
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
			$nombre = $_REQUEST['nombre'];
			$apellido = $_REQUEST['apellido'];

			$sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND apellidos LIKE '$apellido' and tipo_usuario = 'vendedor' or tipo_usuario = 'admin'";
			$result = mysqli_query($conn, $sql); // Asignar el resultado de la consulta a $result

			if ($result && mysqli_num_rows($result) > 0) { // Verificar si hay resultados
				// Generar tabla
				echo "<table>";
				echo "<tr><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Tipo de Usuario</th></tr>";

				while ($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . ($row['nombre']) . "</td>";
					echo "<td>" . ($row['apellidos']) . "</td>";
					echo "<td>" . ($row['email']) . "</td>";
					echo "<td>" . ($row['tipo_usuario']) . "</td>";
					echo "</tr>";
				}

				echo "</table>";
			} else {
				echo "<div class='message'>No se encontró al usuario</div>";
			}
		}

		// Cerrar conexión
		mysqli_close($conn);
		?>


    </div>
</body>
</html>

