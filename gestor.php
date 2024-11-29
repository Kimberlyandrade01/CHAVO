<?php
// Conexión a la base de datos
include 'includes/db.php';

// Verificar si hay citas en la base de datos
$sql = "SELECT * FROM citas";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Dental</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Barra lateral */
        .sidebar {
            background: #2c3e50;
            color: #fff;
            padding: 20px;
            height: 100vh;
            position: fixed;
            width: 250px;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
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
            border: 1px solid #fff;
            margin: 10px 0;
            border-radius: 5px;
            background: #34495e;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #1abc9c;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #2c3e50;
            color: #fff;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        form input[type="text"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            padding: 8px 12px;
            background: #1abc9c;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        form button:hover {
            background: #16a085;
        }

        form a {
            color: #2c3e50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Barra lateral -->
    <div class="sidebar">
        <h2>Clínica Dental</h2>
        <ul>

        <a href="inicio.php" target="_blank" class="btn-innovador">Cerrar Sesion</a>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <h1>Lista de Citas</h1>
        
        <!-- Formulario de búsqueda -->
        <form action="#" method="GET">
            <label for="buscar">Buscar por Doctor:</label>
            <input type="text" id="buscar" name="buscar" placeholder="Ejemplo: Carlos Benítez">
            <button type="submit">Buscar</button>
            <a href="#">Reset</a>
        </form>
        
        <!-- Tabla de citas -->
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Tipo de Cita</th>
                    <th>Doctor</th>
                    <th>Hora de la Cita</th>
                    <th>Día de la Cita</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nombre'] ?? 'Sin nombre') . "</td>";
        echo "<td>" . htmlspecialchars($row['celular'] ?? 'Sin celular') . "</td>";
        echo "<td>" . htmlspecialchars($row['id_servicio'] ?? 'No especificado') . "</td>";
        echo "<td>" . htmlspecialchars($row['id_doctor'] ?? 'No asignado') . "</td>";
        echo "<td>" . htmlspecialchars($row['hora'] ?? 'Hora no definida') . "</td>";
        echo "<td>" . htmlspecialchars($row['fecha'] ?? 'Día no definido') . "</td>";
        
        echo "<td>
                <button class='edit-btn' onclick='editarCita(" . $row['id'] . ")'>Editar</button>
                <button class='delete-btn' onclick='eliminarCita(" . $row['id'] . ")'>Eliminar</button>
             </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay citas registradas</td></tr>";
}
?>

            </tbody>
        </table>
    </div>

    <script>
        function editarCita(id) {
            window.location.href = editar_cita.php?id=${id};
        }

        function eliminarCita(id) {
            if (confirm("¿Estás seguro de que deseas eliminar esta cita?")) {
                fetch(eliminar_cita.php?id=${id})
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