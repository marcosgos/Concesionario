<?php
$servername = "localhost";
$username = "root";
$password = "12345678";
$database = "concesionario";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $email = $_POST["email"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_BCRYPT);
    $tipo_usuario = $_POST["tipo_usuario"];

    $sql = "INSERT INTO usuarios (password, nombre, apellidos, email, tipo_usuario) 
            VALUES ('$contrasena', '$nombre', '$apellidos', '$email','$tipo_usuario')";

    if ($conn->query($sql) === TRUE) {
        header("Location: iniciosesion.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
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

.form-container {
    background: rgba(255, 255, 255, 0.8); /* Fondo blanco semitransparente */
	margin-top:180px;
	margin-left:800px;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.form-container h2 {
    margin-bottom: 15px;
    font-size: 20px;
}

.form-container label {
    display: block;
    font-weight: bold;
    margin: 10px 0 5px;
}

.form-container input,
.form-container select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.form-container button {
    background-color: red;
    color: white;
    border: none;
    padding: 10px;
    width: 100%;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 15px;
    transition: background 0.3s;
}

.form-container button:hover {
    background-color: darkred;
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
            <a>Bienvenido al Concesionario</a>
        </li>
    </ul>
</div>
<div class="form-container">
    <h2>Registro de Usuario</h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required><br>

        <label for="tipo_usuario">Tipo de Usuario:</label>
        <select name="tipo_usuario" required>
            <option value="cliente">Cliente</option>
            <option value="admin">Admin</option>
        </select><br>

        <button type="submit">Registrar</button>
    </form>

    <a href="iniciosesion.php">
        <button style="background-color: blue; color: white; margin-top: 10px;">Iniciar Sesión</button>
    </a>
</div>



</body>
</html>
