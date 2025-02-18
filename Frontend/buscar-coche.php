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
            padding: 30px;
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
        }
        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 8px;
            background-color: #f2f2f2;
        }
        th {
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
        }
        .message {
            text-align: center;
            color: red;
            font-weight: bold;
            margin-top: 20px;
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

    <!-- Contenedor del formulario -->
    <div class="form-container">
        <h2>Buscar Coche</h2>
        <form method="POST">
            <div class="form-group">
                <label for="modelo">Modelo del coche:</label>
                <input type="text" id="modelo" name="modelo" placeholder="Ej: Corolla">
            </div>
            <div class="form-group">
                <label for="marca">Marca del coche:</label>
                <input type="text" id="marca" name="marca" placeholder="Ej: Toyota">
            </div>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <!-- Resultados de la búsqueda -->
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "12345678";
        $dbname = "concesionario";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $modelo = mysqli_real_escape_string($conn, $_REQUEST['modelo']);
            $marca = mysqli_real_escape_string($conn, $_REQUEST['marca']);

            $sql = "SELECT * FROM coches WHERE modelo LIKE '%$modelo%' AND marca LIKE '%$marca%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table>";
                echo "<tr><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['modelo']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['marca']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['color']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['precio']) . " €</td>";
                    echo "<td>" . ($row['alquilado'] ? "Sí" : "No") . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row['foto']) . "' alt='Foto' width='100'></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<div class='message'>No se encontraron resultados para el modelo o la marca especificados.</div>";
            }
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

