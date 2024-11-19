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
