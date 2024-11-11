<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/styles.css">
    <title>Consultorio Dental</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-login {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .login-form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
        }

        .login-form label {
            display: block;
            margin-bottom: 5px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido a Nuestro Consultorio Dental</h1>
        <a href="#login" class="btn-login">Iniciar Sesión</a>
    </header>

    <!-- Formulario de Login -->
    <div id="login" class="login-form">
        <h2>Iniciar Sesión</h2>
        <form action="path/to/your/login/script.php" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>

    <script src="public/js/scripts.js"></script>
</body>
</html>
