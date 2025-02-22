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
	padding:40px;
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
            if (isset($_SESSION['name'])) {
                echo $_SESSION['name']; // Muestra el nombre de usuario si está en la sesión
				echo "<a href='cerrarsesion.php'><button class='t'>Cerrar Sesion</button></a>";
            } else {
                echo "Iniciar Sesión"; // Mensaje predeterminado si no hay sesión iniciada
            }
            ?>
        </button>
    </a>
</div>
<div class="resultados-coche">
        <h2>Buscar para Modificar un Usuario:</h2>
        <form method="POST" class="buscar-coche-form">
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

    $sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND apellidos LIKE '$apellido'";
    $result = mysqli_query($conn, $sql); // Asignar el resultado de la consulta a $result

    if ($result && mysqli_num_rows($result) > 0) { // Verificar si hay resultados
        // Generar tabla
        echo "<table class='resultados-coche'>";
        echo "<tr><th>Contraseña</th><th>Nombre</th><th>Apellidos</th><th>Email</th><th>Saldo</th><th>Tipo de Usuarios</th><th>Acción</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
			echo "<td>" . ($row['password']) . "</td>";
			echo "<td>" . ($row['nombre']) . "</td>";
			echo "<td>" . ($row['apellidos']) . "</td>";
			echo "<td>" . ($row['email']) . "</td>";
			echo "<td>" . (is_null($row['saldo']) ? "0" : $row['saldo']) . "</td>";
			echo "<td>" . ($row['tipo_usuario']) . "</td>";
            echo "<td>
                    <form method='GET' action='modificar_usuario.php'>
                        <input type='hidden' name='nombre' value='" . $row['nombre'] . "'>
                        <input type='hidden' name='apellido' value='" . $row['apellidos'] . "'>
                        <button type='submit'>Modificar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<div class='buscar-coche-mensaje'>No se encontró al usuario</div>";
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

</body>
</html>