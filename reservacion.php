<?php
// Conexión a la base de datos
include 'includes/db.php';

if (isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];  
    $horario = $_POST['horario'];  
    $servicio = $_POST['servicio'];  // ID del servicio
    $doctor = $_POST['doctor'];  // ID del doctor

 

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO citas (nombre, celular, fecha, hora, id_servicio, id_doctor, id_paciente, estado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $id_paciente = 1; // Cambia esto por el ID del paciente real
    $estado = 'pendiente'; 

    if ($stmt = $conn->prepare($sql)) {
    
        $stmt->bind_param("ssssiiis", $nombre, $telefono, $fecha, $horario, $servicio, $doctor, $id_paciente, $estado);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $successMessage = "¡Cita reservada exitosamente!";
        } else {
            $errorMessage = "Hubo un error al reservar la cita.";
        }
    } else {
        $errorMessage = "Error al preparar la consulta SQL.";
    }
}
?>
