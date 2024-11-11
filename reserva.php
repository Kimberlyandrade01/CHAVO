<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservación de Citas</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<div class="container">
    <h2>Reserva tu Cita</h2>

    <!-- Mostrar mensaje de confirmación si la cita se realizó correctamente -->
    <?php if (isset($_POST['submit'])): ?>
        <div class="success">
            <p>¡Cita reservada exitosamente para <?php echo htmlspecialchars($_POST['nombre']); ?>!</p>
            <p>Fecha: <?php echo htmlspecialchars($_POST['fecha']); ?></p>
            <p>Horario: <?php echo htmlspecialchars($_POST['horario']); ?></p>
        </div>
    <?php else: ?>

    <!-- Formulario de Reservación de Cita -->
    <form method="POST" action="">
        <label for="nombre">Nombre Completo:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="fecha">Fecha de la Cita:</label>
        <input type="date" name="fecha" id="fecha" required>

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

        <button type="submit" name="submit">Reservar Cita</button>
        <a href="inicio.php" class="button">Regresar a la Página Principal</a>
    </form>

    <?php endif; ?>
</div>

</body>
</html>