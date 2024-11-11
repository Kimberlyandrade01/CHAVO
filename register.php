<?php
// Incluye el archivo de configuración de la base de datos
require 'config.php'; // Este archivo contiene la conexión PDO a la base de datos

// Configuración de encabezados para manejar JSON
header("Content-Type: application/json");

// Obtén los datos enviados desde el front-end (JSON)
$data = json_decode(file_get_contents("php://input"), true);
print_r($data); // Agrega esta línea para verificar los datos recibidos


// Validar que todos los campos estén completos
if (isset($data['name'], $data['email'], $data['phone'], $data['password'])) {
    $name = $data['name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $password = password_hash($data['password'], PASSWORD_BCRYPT); // Cifrado de la contraseña

    // Verificar si el correo ya existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        // Respuesta si el correo ya está registrado
        echo json_encode(["message" => "El correo ya está registrado"]);
        exit;
    }

    // Insertar el nuevo usuario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $phone, $password])) {
        // Respuesta de éxito en el registro
        echo json_encode(["message" => "Registro exitoso"]);
    } else {
        // Respuesta en caso de error al registrar
        echo json_encode(["message" => "Error al registrar"]);
    }
} else {
    // Respuesta en caso de datos incompletos
    echo json_encode(["message" => "Datos incompletos"]);
}
?>
