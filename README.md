# CHAVO
Sistema de Reservas Online para Consultorio Dental


<?php
session_start();

// Arreglo de correos y contraseñas permitidos
$usuarios_validos = [
    "kimberly.andradecervantes@cesunbc.edu.mx" => "123",
    "usuario2@correo.com" => "password456",
    "admin@correo.com" => "adminpass"
];

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Validar si el correo y la contraseña coinciden con los definidos
    if (isset($usuarios_validos[$email]) && $usuarios_validos[$email] == $password) {
        // Iniciar sesión y redirigir al gestor de tareas
        $_SESSION['user'] = $email;
        header("Location: task_manager.php");
        exit();
    } else {
        // Si las credenciales no son válidas, mostrar mensaje de error
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Aquí puedes simular un arreglo de tareas almacenadas, ya que no estamos usando base de datos.
$tareas = isset($_SESSION['tareas']) ? $_SESSION['tareas'] : [];

// Si se ha enviado el formulario para agregar una tarea
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];

    // Añadir la tarea a la sesión
    $tareas[] = ['title' => $titulo, 'description' => $descripcion];
    $_SESSION['tareas'] = $tareas;  // Guardar las tareas en la sesión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Bienvenido, <?php echo $_SESSION['user']; ?>!</h1>
        <p>¡Aquí puedes gestionar tus tareas!</p>

        <!-- Formulario para agregar una tarea -->
        <form action="task_manager.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="title">Título de la Tarea</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Título de la tarea" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción de la Tarea</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Descripción de la tarea"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
        </form>

        <!-- Mostrar las tareas existentes -->
        <h2>Tareas</h2>
        <ul class="list-group">
            <?php if (!empty($tareas)): ?>
                <?php foreach ($tareas as $tarea): ?>
                    <li class="list-group-item">
                        <strong><?php echo $tarea['title']; ?></strong>
                        <p><?php echo $tarea['description']; ?></p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No hay tareas agregadas aún.</li>
            <?php endif; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reservación de Citas Dentista</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h2>Iniciar Sesión</h2>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese su correo" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su contraseña" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Recuérdame</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                        <br>
                        <a href="registro.html">¿No tienes cuenta? Regístrate aquí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


body {
    background-color: #f8f9fa;
}

.card {
    margin-top: 100px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #007bff;
    color: white;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}



<?php
session_start();

// Arreglo de correos y contraseñas permitidos
$usuarios_validos = [
    "kimberly.andradecervantes@cesunbc.edu.mx" => "123",
    "usuario2@correo.com" => "password456",
    "admin@correo.com" => "adminpass"
];

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Validar si el correo y la contraseña coinciden con los definidos
    if (isset($usuarios_validos[$email]) && $usuarios_validos[$email] == $password) {
        // Iniciar sesión y redirigir al gestor de tareas
        $_SESSION['user'] = $email;
        header("Location: task_manager.php");
        exit();
    } else {
        // Si las credenciales no son válidas, mostrar mensaje de error
        $error = "Correo o contraseña incorrectos.";
    }
}
?>
<?php

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Aquí puedes simular un arreglo de tareas almacenadas, ya que no estamos usando base de datos.
$tareas = isset($_SESSION['tareas']) ? $_SESSION['tareas'] : [];

// Si se ha enviado el formulario para agregar una tarea
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['title'];
    $descripcion = $_POST['description'];

    // Añadir la tarea a la sesión
    $tareas[] = ['title' => $titulo, 'description' => $descripcion];
    $_SESSION['tareas'] = $tareas;  // Guardar las tareas en la sesión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Bienvenido, <?php echo $_SESSION['user']; ?>!</h1>
        <p>¡Aquí puedes gestionar tus tareas!</p>

        <!-- Formulario para agregar una tarea -->
        <form action="task_manager.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="title">Título de la Tarea</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Título de la tarea" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción de la Tarea</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Descripción de la tarea"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
        </form>

        <!-- Mostrar las tareas existentes -->
        <h2>Tareas</h2>
        <ul class="list-group">
            <?php if (!empty($tareas)): ?>
                <?php foreach ($tareas as $tarea): ?>
                    <li class="list-group-item">
                        <strong><?php echo $tarea['title']; ?></strong>
                        <p><?php echo $tarea['description']; ?></p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No hay tareas agregadas aún.</li>
            <?php endif; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>



