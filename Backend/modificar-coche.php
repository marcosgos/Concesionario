<?php
session_start();
?>
<html>
<head>
<title>Concesionario</title>
<style>
/* Estilo general */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-image: url('fondo.jpg'); /* Cambiar URL por la del fondo */
    background-size: cover; /* Ajustar el fondo a toda la página */
    background-repeat: no-repeat;
    background-attachment: fixed; /* Fijar el fondo para que no se mueva */
}

/* Menú superior */
.nav {
    background-color: rgba(51, 51, 51, 0.8); /* Fondo semitransparente del menú */
    padding: 10px 0;
    display: flex;
    justify-content: center;
    align-items: center; /* Centrar el contenido verticalmente */
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
    position: relative; /* Necesario para los submenús */
}

.nav__list a {
    text-decoration: none;
    color: white;
    padding: 10px 20px;
    display: block;
    transition: background-color 0.3s;
}

.nav__list a:hover {
    background-color: #555; /* Efecto hover en botones */
}

/* Submenús */
.nav__list ul {
    display: none; /* Submenú oculto inicialmente */
    position: absolute;
    top: 100%; /* Posición debajo del botón principal */
    left: 0;
    background-color: #444; /* Fondo del submenú */
    list-style: none;
    margin: 0;
    padding: 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2); /* Sombra */
    z-index: 1000;
}

.nav__list ul li {
    width: 200px; /* Ancho del submenú */
}

.nav__list ul a {
    padding: 10px 15px;
    color: white;
}

.nav__list ul a:hover {
    background-color: #666; /* Efecto hover en submenú */
}

/* Mostrar submenú al pasar el ratón */
.nav__list li:hover > ul {
    display: block;
}

/* Logo */
.logo {
    position: absolute;
    top: 10px; /* Ajustar según sea necesario */
    left: 20px;
}

.logo img {
    width: 100px; /* Ajusta el tamaño del logo */
    height: auto;
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
/* Contenedor principal del formulario */
.buscar-coche-container {
    width: 100%;
    max-width: 400px;
    margin: 40px auto;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.buscar-coche-container h2 {
    color: #333;
    margin-bottom: 20px;
}

/* Grupos de formulario */
.buscar-coche-form .form-group {
    margin-bottom: 15px;
    text-align: left;
}

.buscar-coche-form label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

/* Campos de entrada */
.buscar-coche-form input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s ease-in-out;
}

.buscar-coche-form input[type="text"]:focus {
    border-color: #007bff;
    outline: none;
}

/* Botón de envío */
.buscar-coche-form button {
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

.buscar-coche-form button:hover {
    background: #0056b3;
}

/* Estilos para la tabla de resultados */
.resultados-coche {
    width: 100%;
    max-width: 800px;
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.resultados-coche th, .resultados-coche td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.resultados-coche th {
    background: red;
    color: white;
}

.resultados-coche tr:hover {
    background: #f1f1f1;
}

/* Mensaje de error */
.buscar-coche-mensaje {
    text-align: center;
    font-size: 16px;
    color: #d9534f;
    margin-top: 20px;
}

/* Imágenes en la tabla */
.resultados-coche img {
    border-radius: 5px;
    max-width: 100px;
    height: auto;
}

</style>
</head>
<body>
<div class="logo">
    <a href="index.php"><img src="logo.jpg" alt="Logo del concesionario"></a>
</div>
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

<div class="buscar-coche-container">
    <h2>Buscar Coche para Modificar</h2>
    <form method="POST" class="buscar-coche-form">
        <div class="form-group">
            <label for="modelo">Modelo del coche:</label>
            <input type="text" id="modelo" name="modelo" required>
        </div>
        <div class="form-group">
            <label for="marca">Marca del coche:</label>
            <input type="text" id="marca" name="marca">
        </div>
        <button type="submit">Buscar</button>
    </form>
</div>



<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "concesionario";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buscar coches por modelo y marca
    $modelo = mysqli_real_escape_string($conn, $_POST['modelo']);
    $marca = mysqli_real_escape_string($conn, $_POST['marca']);
    $sql = "SELECT * FROM coches WHERE modelo LIKE '%$modelo%' AND marca LIKE '%$marca%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='resultados-coche'>";
        echo "<tr><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th><th>Acción</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
            echo "<td>" . htmlspecialchars($row['color']) . "</td>";
            echo "<td>" . htmlspecialchars($row['precio']) . " €</td>";
            echo "<td>" . ($row['alquilado'] ? "Sí" : "No") . "</td>";
            echo "<td><img src='../" . htmlspecialchars($row['foto']) . "' alt='Foto' width='200'></td>";
            echo "<td>
                    <form method='POST' action='editar_coche.php' style='display:inline;'>
                        <input type='hidden' name='modelo' value='" . htmlspecialchars($row['modelo']) . "'>
                        <input type='hidden' name='marca' value='" . htmlspecialchars($row['marca']) . "'>
                        <button type='submit'>Modificar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='buscar-coche-mensaje'>No se encontraron resultados para el modelo o la marca especificados.</div>";
    }
}

mysqli_close($conn);
?>


</body>
</html>