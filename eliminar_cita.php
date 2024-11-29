<?php
if (isset($_GET['id'])) {
    $conexion = new mysqli("localhost", "root", "", "consultorio_dental");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $id = $_GET['id'];
    $sql = "DELETE FROM citas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conexion->close();
}
?>
