<?php
session_start(); // Iniciar la sesión
include 'includes/db.php'; // Incluir la conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para buscar al usuario en la base de datos
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si se encontró el usuario
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Crear la sesión y redirigir al task_manager.php
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: gestor.php");
            exit();
        } else {
            // Contraseña incorrecta
            $error = "Credenciales incorrectas.";
        }
    } else {
        // Usuario no encontrado
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4">
            <h2 class="text-center">Login</h2>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3"><?= $error ?></div>
            <?php endif; ?>

            <!-- Enlace al registro de usuarios -->
            <div class="mt-3 text-center">
                <a href="register1.php">¿No tienes una cuenta? Regístrate aquí</a>
            </div>
        </div>
    </div>
</body>
</html>
