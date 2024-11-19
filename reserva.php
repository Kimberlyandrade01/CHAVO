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

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO citas (nombre, celular, dia_cita, hora_cita, tipo_cita, doctor) 
            VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $nombre, $telefono, $fecha, $horario, $servicio, $doctor);
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
    </style>
</head>
<body>

<div class="container">
    <div class="icon-container">📅</div>
    <h2>Reserva tu Cita</h2>

    <?php if (isset($_POST['submit'])): ?>
        <div class="success">
            <p>¡Cita reservada exitosamente para <?php echo htmlspecialchars($_POST['nombre']); ?>!</p>
            <p>Fecha: <?php echo htmlspecialchars($_POST['fecha']); ?></p>
            <p>Horario: <?php echo htmlspecialchars($_POST['horario']); ?></p>
            <a href="inicio.php" class="button">Regresar a la Página Principal</a>
        </div>
    <?php else: ?>

    <form method="POST" action="">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="telefono">Número Telefónico:</label>
        <input type="tel" name="telefono" id="telefono" required pattern="[0-9]{10}" placeholder="1234567890">

        <label for="fecha">Fecha de la Cita:</label>
        <input type="date" name="fecha" id="fecha" required min="<?php echo date('Y-m-d'); ?>">

        <label for="horario">Horario de la Cita:</label>
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

        <label for="servicio">Tipo de Servicio:</label>
        <select name="servicio" id="servicio" required>
            <option value="Odontología General">Odontología General</option>
            <option value="Odontología Preventiva">Odontología Preventiva</option>
            <option value="Odontología Estética">Odontología Estética</option>
            <option value="Ortodoncia">Ortodoncia</option>
        </select>

        <label for="doctor">Selecciona el Doctor:</label>
        <select name="doctor" id="doctor" required>
            <option value="Efrain Reyna Avila">Efrain Reyna Avila</option>
            <option value="Kimberly Cervantes">Kimberly Cervantes</option>
            <option value="Carlos Benitez">Carlos Benitez</option>
            <option value="Shijin">Shijin</option>
        </select>

        <button type="submit" name="submit" class="btn-primary">Reservar Cita</button>
        <a href="inicio.php" class="btn-secondary">Regresar a la Página Principal</a>
    </form>

    <?php endif; ?>
</div>

</body>
</html>

