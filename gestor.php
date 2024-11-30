<?php
// Conexión a la base de datos
include 'includes/db.php';

// Obtener el valor de búsqueda (si existe)
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';

// Consulta para filtrar por doctor si se ingresa un valor en el buscador
$sql = $buscar 
    ? "SELECT * FROM citas WHERE id_doctor LIKE ?"
    : "SELECT * FROM citas";

$stmt = $conn->prepare($sql);

if ($buscar) {
    $likeBuscar = "%$buscar%";
    $stmt->bind_param("s", $likeBuscar);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Citas - Clínica Dental</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Barra lateral */
        .sidebar {
            background: #4682B4;
            color: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            width: 250px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            border-bottom: 2px solid #1abc9c;
            padding-bottom: 10px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 0;
            text-align: center;
            border: 1px solid transparent;
            margin: 10px 0;
            border-radius: 5px;
            background: #34495e;
            transition: background 0.3s, border 0.3s;
        }

        .sidebar a:hover {
            background: #1abc9c;
            border: 1px solid #fff;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Formulario de búsqueda */
        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        form input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 300px;
        }

        form button {
            padding: 10px 20px;
            background: #4682B4;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        form button:hover {
            background: #16a085;
        }

        form a {
            color: #1abc9c;
            text-decoration: none;
        }

        /* Tabla de citas */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #4682B4;
            color: #fff;
        }

        table tr:nth-child(even) {
            background: #f4f4f4;
        }

        table tr:hover {
            background: #e6f7f5;
        }

        .actions button {
            padding: 8px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .edit-btn {
            background: #f39c12;
            color: #fff;
        }

        .edit-btn:hover {
            background: #e67e22;
        }

        .delete-btn {
            background: #e74c3c;
            color: #fff;
        }

        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <!-- Barra lateral -->
    <div class="sidebar">
        <h2>Clínica Dental</h2>
        <ul>
            <li><a href="inicio.php">Inicio</a></li>
            <li><a href="contacto.html">Contacto</a></li>
            <li><a href="nosotros.html">Nosotros</a></li>
           
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <h1>Lista  de Citas</h1>

        <!-- Formulario de búsqueda -->
        <form action="gestor.php" method="GET">
            <input type="text" name="buscar" placeholder="Buscar por Doctor" value="<?php echo htmlspecialchars($buscar); ?>">
            <button type="submit">Buscar</button>
            <a href="gestor.php">Restablecer</a>
        </form>

        <!-- Tabla de citas -->
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Tipo de Servicio</th>
                    <th>Doctor</th>
                    <th>Hora</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($row['celular']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_servicio']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_doctor']); ?></td>
                            <td><?php echo htmlspecialchars($row['hora']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td class="actions">
                               
                                <button class="delete-btn" onclick="eliminarCita(<?php echo $row['id']; ?>)">Eliminar</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">No se encontraron citas</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editarCita(id) {
            window.location.href = `editar_cita.php?id=${id}`;
        }

        function eliminarCita(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {
                fetch(`eliminar_cita.php?id=${id}`)
                    .then(response => response.text())
                    .then(data => {
                        if (data === "success") {
                            location.reload();
                        } else {
                            alert("Error al eliminar la cita");
                        }
                    });
            }
        }
    </script>
</body>
</html>
