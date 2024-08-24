<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'nombre_de_tu_base_de_datos';
$username = 'tu_usuario';
$password = 'tu_contraseña';

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los datos del docente
    $stmt = $pdo->prepare("SELECT nombre, matricula, especialidad, ciclo, correo, telefono, direccion, foto FROM docentes WHERE id = :id");
    $stmt->bindParam(':id', $id);

    // Supongamos que el ID del docente es 1
    $id = 1;
    $stmt->execute();

    // Obtener los datos del docente
    $docente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$docente) {
        echo "No se encontró el docente.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidad Universitaria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #000000;
            padding: 10px;
            background-color: #f5f5f5;
            margin: 0;
        }
        .header {
            height: 220px;
            background-color: transparent;
            position: relative;
            padding: 0 20px;
            text-align: center;
            margin-top: -6px;
        }

        .header img {
            max-width: 65%;
            height: auto;
        }

        .menu {
            position: absolute;
            top: 52%;
            left: 250px;
            transform: translateY(-50%);
            z-index: 1000;
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .menu ul li {
            display: inline-block;
            position: relative;
        }

        .menu ul li a {
            background-color: #8b0c0c;
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .menu ul li a:hover {
            background-color: #b71c1c;
        }

        .menu ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #070546;
            padding: 0;
            margin: 0;
            border-radius: 5px;
        }

        .menu ul li ul li {
            display: block;
        }

        .menu ul li ul li a {
            padding: 10px;
            background-color: #070546;
            color: white;
            text-decoration: none;
            display: block;
        }

        .menu ul li ul li a:hover {
            background-color: #8b0c0c;
        }

        .menu ul li:hover ul {
            display: block;
        }

        .menu .hamburger {
            font-size: 24px;
            cursor: pointer;
        }

        .user-info {
            position: absolute;
            top: 123px;
            right: 240px;
            color: white;
            text-align: right;
        }

        .user-info span {
            display: block;
        }

        .user-info a {
            color: white;
            text-decoration: underline;
            margin-left: 240px;
            display: inline-block;
            padding: 5px 10px;
            background-color: transparent;
            border: none;
        }

        .info-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px;
            gap: 20px;
        }

        .info-photo {
            text-align: center;
        }

        .info-photo img {
            width: 200px;
            height: auto;
            border-radius: 5px;
        }

        .info-details {
            text-align: right;
        }

        .info-header {
            font-size: 20px;
            font-weight: bold;
            color: #0000FF;
            margin-bottom: 20px;
        }

        .info-details div {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .info-details label {
            margin-right: 10px;
            font-weight: bold;
            font-size: 16px;
            color: #8b0c0c;
        }

        .info-details input {
            padding: 5px;
            font-size: 16px;
            color: white;
            background-color: #8b0c0c;
            border: 2px solid #070546;
            border-radius: 5px;
            text-align: center;
            width: 306px;
            box-sizing: border-box;
        }

        .info-registered {
            margin-top: 20px;
            text-align: left;
            max-width: 600px;
            margin: 0 auto;
        }

        .info-registered div {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-registered label {
            font-weight: bold;
            font-size: 16px;
            color: #8b0c0c;
            margin-right: 10px;
            width: 150px;
            text-align: right;
        }

        .info-registered input {
            flex: 1;
            padding: 5px;
            font-size: 16px;
            color: #070546;
            background-color: #ffffff;
            border: 2px solid #070546;
            border-radius: 5px;
        }

        .button-group {
            text-align: right;
            margin-top: 20px;
        }

        .button-group a {
            background-color: #8b0c0c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 10px;
            display: inline-block;
            border: 2px solid #070546;
        }

        .button-group a:hover {
            background-color: #b71c1c;
        }

        .notification {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: #8b0c0c;
            color: white;
            border: 2px solid #070546;
            border-radius: 5px;
            text-align: center;
            padding: 20px;
            box-shadow: 0 0 10px rgba(79, 66, 66, 0.5);
            z-index: 1000;
        }

        .notification .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .notification .message {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .notification .button {
            background-color: #070546;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .notification .button:hover {
            background-color: #ffffff;
            color: #070546;
        }

        .error-notification {
            background-color: #8b0c0c;
            border-color: #8b0c0c;
        }

        .footer {
            text-align: center;
            background-color: #070546;
            color: white;
            padding: 10px;
            border-radius: 0 0 10px 10px;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="inicio_alumno.html">
            <img src="../img/Encabezado.png" alt="Encabezado">
        </a>
        <div class="menu">
            <ul>
                <li>
                    <a href="#" class="hamburger"><i class="fas fa-bars"></i></a>
                    <ul>
                        <li><a href="horario_alumno.html">Horario</a></li>
                        <li><a href="calificaciones_alumno.html">Curso para docentes</a></li>
                        <!-- Otros elementos del menú -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="user-info">
        <span><?php echo htmlspecialchars($docente['nombre']); ?></span>
        <a href="logout.php">Cerrar sesión</a>
    </div>

    <div class="info-container">
        <div class="info-photo">
            <img src="<?php echo htmlspecialchars($docente['foto']); ?>" alt="Foto del docente">
        </div>
        <div class="info-details">
            <div class="info-header">Información del Docente</div>
            <div>
                <label>Nombre:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['nombre']); ?>" readonly>
            </div>
            <div>
                <label>Matricula:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['matricula']); ?>" readonly>
            </div>
            <div>
                <label>Especialidad:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['especialidad']); ?>" readonly>
            </div>
            <div>
                <label>Ciclo:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['ciclo']); ?>" readonly>
            </div>
            <div>
                <label>Correo:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['correo']); ?>" readonly>
            </div>
            <div>
                <label>Telefono:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['telefono']); ?>" readonly>
            </div>
            <div>
                <label>Direccion:</label>
                <input type="text" value="<?php echo htmlspecialchars($docente['direccion']); ?>" readonly>
            </div>
        </div>
    </div>

    <div class="footer">
        © 2024 Comunidad Universitaria. Todos los derechos reservados.
    </div>
</body>
</html>