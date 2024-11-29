<?php
$conexion = new mysqli("localhost", "root", "", "consultorio_dental");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['id'])) {
    // Actualizar la cita
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $celular = $_POST['celular'];
    $tipo_cita = $_POST['id_servicio'];
    $doctor = $_POST['id_doctor'];
    $hora_cita = $_POST['hora'];
    $dia_cita = $_POST['dia_cita'];

    $sql = "UPDATE citas SET nombre = ?, celular = ?, tipo_cita = ?, doctor = ?, hora_cita = ?, dia_cita = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $celular, $tipo_cita, $doctor, $hora_cita, $dia_cita, $id);

    if ($stmt->execute()) {
        header("Location: gestor.php");
        exit;
    } else {
        echo "Error al actualizar la cita";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM citas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $cita = $resultado->fetch_assoc();
} else {
    echo "ID de cita no proporcionado.";
    exit;
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
</head>
<body>
    <h2>Editar Cita</h2>
    <form action="editar_cita.php" method="post">
        <input type="hidden" name="id" value="<?php echo $cita['id']; ?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($cita['nombre']); ?>" required><br>
        <label>Celular:</label>
        <input type="text" name="celular" value="<?php echo htmlspecialchars($cita['celular']); ?>" required><br>
        <label>Tipo de Cita:</label>
        <input type="text" name="tipo_cita" value="<?php echo htmlspecialchars($cita['id_servicio']); ?>" required><br>
        <label>Doctor:</label>
        <input type="text" name="doctor" value="<?php echo htmlspecialchars($cita['id_doctor']); ?>" required><br>
        <label>Hora de la Cita:</label>
        <input type="time" name="hora_cita" value="<?php echo htmlspecialchars($cita['hora']); ?>" required><br>
        <label>Día de la Cita:</label>
        <input type="date" name="dia_cita" value="<?php echo htmlspecialchars($cita['fecha']); ?>" required><br>
        <button type="submit">Guardar Cambios</button>
    </form>
    <button onclick="window.location.href='index.php'">Cancelar</button>
</body>
</html>
