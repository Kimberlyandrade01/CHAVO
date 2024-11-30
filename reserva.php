<?php
// Conexión a la base de datos
include 'includes/db.php';

if (isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];
    $servicio = $_POST['servicio'];
    $doctor = $_POST['doctor'];

    // Definir el estado de la cita (por defecto 'pendiente')
    $estado = 'pendiente';

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO citas (nombre, celular, fecha, hora, id_servicio, id_doctor, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Usar bind_param para asociar las variables con los parámetros de la consulta SQL
        $stmt->bind_param("sssssss", $nombre, $telefono, $fecha, $horario, $servicio, $doctor, $estado);
        
        if ($stmt->execute()) {
            $successMessage = "¡Cita reservada exitosamente!";
        } else {
            $errorMessage = "Hubo un error al reservar la cita.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservación de Citas</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Estilos Generales */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom, #cce7ff, #e3f2fd); /* Fondo gradiente en tonos de azul */
            color: #333;
        }

        /* Contenedor Principal */
        .container {
            background-color: #ffffff;
            padding: 2rem;
            max-width: 400px;
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        /* Icono superior */
        .icon-container {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 80px;
            background-color: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #1a73e8;
        }

        /* Formulario */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: 400;
            color: #555;
            margin: 0.5rem 0 0.25rem;
            width: 100%;
            text-align: left;
        }

        input[type="text"], input[type="tel"], input[type="date"], select {
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 100%;
            margin-bottom: 1rem;
            transition: border-color 0.3s;
            text-align: left;
        }

        input[type="text"]:focus, input[type="tel"]:focus, input[type="date"]:focus, select:focus {
            border-color: #1a73e8;
            outline: none;
        }

        /* Botón */
        .btn-primary {
            background-color: #1a73e8;
            color: #fff;
            border: none;
            padding: 0.75rem;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 1rem;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #155bb5;
        }

        .btn-secondary {
            display: inline-block;
            color: #555;
            text-decoration: none;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .btn-secondary:hover {
            color: #1a73e8;
        }

        /* Mensaje de éxito */
        .success {
            background-color: #e6f4ea;
            border-left: 4px solid #34a853;
            padding: 1rem;
            border-radius: 10px;
            color: #2d6a4f;
            margin-bottom: 1rem;
            text-align: left;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        h1 {
            margin: 0;
        }

        /* Estilo para el menú de navegación */
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-size: 1.5em;
            font-weight: bold;
        }

        /* Alineación del menú de navegación a la derecha */
        nav {
            position: absolute;
            right: 10px;
            top: 10px;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-size: 1.5em;
            font-weight: bold;
        }

        /* Alineación del menú de navegación a la derecha */
        nav {
            position: absolute;
            right: 10px;
            top: 10px;
        }
        .btn-innovador {
            display: inline-block;
            padding: 0.75em 1.5em;
            background: #007bff; /* Azul para el botón */
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 25px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            margin-top: 1.5em;
        }

        .btn-innovador:hover {
            background: #0056b3; /* Azul más oscuro en hover */
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.35);
        }
        .button {
            background-color: #87CEEB; /* Azul bajo */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }

        .button:hover {
            background-color: #4682B4; 
        }
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        #chat-messages {
            height: 200px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f9f9f9;
        }

        #user-input {
            width: calc(100% - 20px);
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #send-btn {
            margin-top: 5px;
            width: 100%;
            padding: 5px;
            background-color: #1E90FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #send-btn:hover {
            background-color: #4682B4;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        h1 {
            margin: 0;
        }

    </style>
</head>
<header>
        <nav>
            <ul>
            <li><a href="#" class="button" id="btn-login" onclick="redirectTo('login.php')">Iniciar Sesión</a></li>
            <li><a href="#" class="button" id="btn-nosotros" onclick="redirectTo('nosotros.html')">Nosotros</a></li>
            <li><a href="#" class="button" id="btn-reservacion" onclick="redirectTo('reserva.php')">Reservación</a></li>
            <li><a href="#" class="button" id="btn-contacto" onclick="redirectTo('contacto.html')">Contacto</a></li>
                
            </ul>
        </nav>
    </header>
<body>

<div class="container">
    <div class="icon-container">📅</div>
    <h2>Reserva tu Cita</h2>
    <h2>Book your appointment</h2>

    <?php if (isset($successMessage)): ?>
        <div class="success">
            <p>¡Cita reservada exitosamente para <?php echo htmlspecialchars($nombre); ?>!</p>
            <p>Fecha: <?php echo htmlspecialchars($fecha); ?></p>
            <p>Horario: <?php echo htmlspecialchars($horario); ?></p>
            <a href="inicio.php" class="button">Regresar a la Página Principal</a>
        </div>
    <?php else: ?>

    <form method="POST" action="">
        <label for="nombre">Nombre Completo/Full name :</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="telefono">Número Telefónico/ Phone Number:</label>
        <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{10}" placeholder="1234567890">

        <label for="fecha">Fecha de la Cita/Date of Appointment:</label>
        <input type="date" name="fecha" id="fecha" required min="<?php echo date('Y-m-d'); ?>">

        <label for="horario">Horario de la Cita/Appointment Schedule:</label>
        <select name="horario" id="horario" required>
            <option value="09:00 AM">09:00 AM</option>
            <option value="10:00 AM">10:00 AM</option>
            <option value="11:00 AM">11:00 AM</option>
            <option value="12:00 PM">12:00 PM</option>
            <option value="01:00 PM">01:00 PM</option>
            <option value="02:00 PM">02:00 PM</option>
            <option value="03:00 PM">03:00 PM</option>
            <option value="04:00 PM">04:00 PM</option>
        </select>

        <label for="servicio">Tipo de Servicio/Type of service:</label>
        <select name="servicio" id="servicio" required>
            <option value="Odontología General">Odontología General/Dentistry Genera</option>
            <option value="Odontología Preventiva">Odontología Preventiva/Preventive Dentistry</option>
            <option value="Odontología Estética">Odontología Estética/Aesthetic Dentistry</option>
            <option value="Ortodoncia">Ortodoncia/Orthodontics</option>
        </select>

        <label for="doctor">Selecciona el Doctor/Select the doctor:</label>
        <select name="doctor" id="doctor" required>
            <option value="Efrain Reyna Avila">Efrain Reyna Avila</option>
            <option value="Kimberly Cervantes">Kimberly Cervantes</option>
            <option value="Carlos Benitez">Carlos Benitez</option>
            <option value="Shijin">Shijin</option>
        </select>

        <button type="submit" name="submit" class="btn-primary">Reservar Cita</button>
        
    </form>

    <?php endif; ?>
</div>
<script>

function redirectTo(url) {
        // Cambiar la ubicación de la página actual a la URL especificada
        window.location.href = url;
    }
</script>
</body>
</html>
