# CHAVO
Sistema de Reservas Online para Consultorio Dental


\\\\LOGIN
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


<?php
// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proyecto';

$conn = new mysqli($host, $user, $password, $dbname, 3307);  // Puerto 3306 por defecto


if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Si se envía el formulario para agregar una tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tasks (title, description) VALUES ('$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Tarea agregada correctamente.";
    } else {
        echo "Error al agregar tarea: " . $conn->error;
    }
}

// Eliminar tarea
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM tasks WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Tarea eliminada correctamente.";
    } else {
        echo "Error al eliminar tarea: " . $conn->error;
    }
}

// Obtener todas las tareas
$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Citas Dentista</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Gestión de Tareas</h1>
        
        <!-- Formulario para agregar una tarea -->
        <form action="task_manager.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Título de la tarea" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Descripción de la tarea"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
        </form>

        <!-- Lista de tareas -->
        <h2>Tareas pendientes</h2>
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <strong><?php echo $row['title']; ?></strong>
                    <p><?php echo $row['description']; ?></p>
                    <a href="task_manager.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>



<?php
// Inicia la sesión
session_start();

// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proyecto';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Si se envía el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe y las credenciales son correctas
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario autenticado correctamente
        $_SESSION['usuario_autenticado'] = true; // Establecer una sesión para el usuario

        // Redirigir al task manager
        header('Location: task_manager.php');
        exit;
    } else {
        // Si las credenciales son incorrectas
        echo "Correo o contraseña incorrectos.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reservación de Citas Dentista</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</body>
</html>







<?php
// Iniciar sesión
session_start();

// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nombre_de_tu_base_de_datos';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Si se envía el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar si el usuario existe
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener la fila del usuario
        $user = $result->fetch_assoc();

        // Verificar que la contraseña ingresada coincida con la contraseña almacenada
        if (password_verify($password, $user['password'])) {
            // Usuario autenticado correctamente
            $_SESSION['usuario_autenticado'] = true;
            $_SESSION['user_id'] = $user['id']; // Guardar el ID del usuario en la sesión

            // Redirigir al task manager o dashboard
            header('Location: task_manager.php');
            exit;
        } else {
            // Si la contraseña no coincide
            echo "Contraseña incorrecta.";
        }
    } else {
        // Si el correo no está registrado
        echo "El correo no está registrado.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reservación de Citas Dentista</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
</body>
</html>









\\\\\STYLE
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








\\\\\\\\TAKSK
<?php
// Conectar a la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'proyecto';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Si se envía el formulario para agregar una tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tasks (title, description) VALUES ('$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Tarea agregada correctamente.";
    } else {
        echo "Error al agregar tarea: " . $conn->error;
    }
}

// Eliminar tarea
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM tasks WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Tarea eliminada correctamente.";
    } else {
        echo "Error al eliminar tarea: " . $conn->error;
    }
}

// Obtener todas las tareas
$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Citas Dentista</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Gestión de Tareas</h1>
        
        <!-- Formulario para agregar una tarea -->
        <form action="task_manager.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Título de la tarea" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Descripción de la tarea"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Tarea</button>
        </form>

        <!-- Lista de tareas -->
        <h2>Tareas pendientes</h2>
        <ul class="list-group">
            <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <strong><?php echo $row['title']; ?></strong>
                    <p><?php echo $row['description']; ?></p>
                    <a href="task_manager.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>



