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
</style>
</head>
<body>

<!-- Logo -->
<div class="logo">
    <a href="index.html"><img src="logo.jpg" alt="Logo del concesionario"></a>
</div>

<!-- Menú superior -->
<div class="nav">
    <ul class="nav__list">
        <li>
            <a href="coches.html">Coches</a>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="registrar-coche.html">A&ntilde;adir</a></li>
                <li><a href="ver-coche.php">Listar</a></li>
                <li><a href="buscar-coche.php">Buscar</a></li>
                <li><a href="modificar-coche.php">Modificar</a></li>
                <li><a href="eliminar-coche.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="usuarios.html">Usuarios</a>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="registrar-user.html">A&ntilde;adir</a></li>
                <li><a href="ver-user.php">Listar</a></li>
				<li><a href="buscar-user.php">Buscar</a></li>
                <li><a href="modificar-user.php">Modificar</a></li>
                <li><a href="eliminar-user.php">Borrar</a></li>
            </ul>
        </li>
        <li>
            <a href="alquileres.html">Alquileres</a>
            <ul>
                <li><a href="index.html">Inicio</a></li>
				<li><a href="listar-alquileres.php">Listar</a></li>
                <li><a href="borrar-alquileres.php">Borrar</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="form-container">
        <h2>Buscar para Modificar un Usuario:</h2>
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

    $sql = "SELECT * FROM usuarios WHERE nombre LIKE '$nombre' AND apellidos LIKE '$apellido'";
    $result = mysqli_query($conn, $sql); // Asignar el resultado de la consulta a $result

    if ($result && mysqli_num_rows($result) > 0) { // Verificar si hay resultados
        // Generar tabla
        echo "<table>";
        echo "<tr><th>Contraseña</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Saldo</th><th>Acción</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['apellidos'] . "</td>";
            echo "<td>" . $row['dni'] . "</td>";
            echo "<td>" . $row['saldo'] . "</td>";
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
        echo "<div class='message'>No se encontró al usuario</div>";
    }
}

// Cerrar conexión
mysqli_close($conn);
?>

</body>
</html>