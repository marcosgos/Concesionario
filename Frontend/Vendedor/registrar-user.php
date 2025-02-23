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

/* Contenedor del formulario */
.form-container {
    background-color: rgba(255, 255, 255, 0.95); /* Fondo semitransparente */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra suave */
    width: 100%;
    max-width: 400px;
    margin: auto; /* Centrado horizontal */
}

/* Título del formulario */
.form-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-size: 24px;
}

/* Grupo de campos del formulario */
.form-group {
    margin-bottom: 15px;
}

/* Etiquetas de los campos */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
    font-size: 14px;
}

/* Campos de entrada */
input[type="text"],
input[type="number"],
input[type="file"],
input[type="password"],
select {
    width: 100%; /* Campo de ancho completo */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    box-sizing: border-box; /* Para evitar desbordes */
}

/* Espaciado entre opciones del select */
select option {
    padding: 5px;
}

/* Botones */
.form-actions {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s, opacity 0.3s;
}

/* Botón Enviar */
button[type="submit"] {
    background-color: #4CAF50; /* Verde */
    color: white;
}

button[type="submit"]:hover {
    background-color: #45a049; /* Verde más oscuro */
}

/* Botón Borrar */
button[type="reset"] {
    background-color: #f44336; /* Rojo */
    color: white;
}

button[type="reset"]:hover {
    background-color: #e53935; /* Rojo más oscuro */
}

/* Efecto hover para ambos botones */
button:hover {
    opacity: 0.9;
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
<div class="logo">
    <a href="index.php"><img src="logo.jpg" alt="Logo del concesionario"></a><!-- Cambiar URL por el logo -->
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
    <div class="form-container">
        <h2>Registrar Usuario</h2>
        <form action="anadir-user.php" method="post">

            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" name="Nombre" required>
            </div>

            <div class="form-group">
                <label for="Apellidos">Apellidos</label>
                <input type="text" id="Apellidos" name="Apellidos" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="Contraseña">Contrase&ntilde;a</label>
                <input type="password" id="Contraseña" name="Contraseña" required>
            </div>
            <div class="form-group">
				<label for="tipo_usuario">Tipo de Usuario:</label>
				<select name="tipo_usuario" required>
					<option value="cliente">Cliente</option>
					<option value="vendedor">Vendedor</option>
					<option value="admin">Admin</option>
				</select><br>
            </div>
			
            <div class="form-actions">
                <button type="submit">Enviar</button>
                <button type="reset">Borrar Todo</button>
            </div>
        </form>
    </div>
</body>
</html>

</div>
</body>
</html>