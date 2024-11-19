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
    <title>Bienvenido - Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #cce7ff; /* Fondo azul bajo */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            font-weight: bold;
            color: #003366; /* Color de texto azul oscuro */
        }
        .btn-login {
            background-color: #007bff; /* Azul suave */
            border: none;
            color: #fff;
            padding: 0.5rem;
            font-size: 1rem;
            border-radius: 4px;
            width: 100%;
            margin-top: 1rem;
        }
        .btn-login:hover {
            background-color: #0056b3; /* Azul más oscuro para el hover */
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #007bff;
        }
        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Bienvenido</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3"><?= $error ?></div>
        <?php endif; ?>

        <a href="register1.php" class="register-link">¿No tienes una cuenta? Regístrate aquí</a>
        <a href="#" class="register-link">¿Olvidaste tu usuario o contraseña?</a>
    </div>
</body>
</html>
