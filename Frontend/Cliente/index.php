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
            <a>Coches en Stock</a>
            <ul>
                <li><a href="ver-coche.php">Ver todos los Coches</a></li>
                <li><a href="buscar-coche.php">Buscador de Coches</a></li>
            </ul>
        </li>
        <li>
            <a>Vendedores</a>
            <ul>
                <li><a href="ver-user.php">Ver todos los Vendedores</a></li>
				<li><a href="buscar-user.php">Buscador de Vendedores</a></li>
            </ul>
        </li>
        <li>
            <a>Coches Alquilados</a>
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
                $conexion = new mysqli("localhost", "root", "rootroot", "concesionario");

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

</body>
</html>
