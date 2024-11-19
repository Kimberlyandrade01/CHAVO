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
    <title>Lista de Citas</title>
    <style>
        /* Estilos CSS para la tabla */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }
        .sidebar {
            background-color: #1E90FF;
            color: white;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #1E90FF;
            color: white;
        }
        .edit-btn {
            background-color: #ffa000;
            color: white;
        }
        .delete-btn {
            background-color: #e53935;
            color: white;
        }
        .btn-innovador {
            display: inline-block;
            padding: 0.75em 1.5em;
            background: #007bff; /* Azul para el botón */
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 25px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            margin-top: 1.5em;
        }

        .btn-innovador:hover {
            background: #0056b3; /* Azul más oscuro en hover */
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.35);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Clinica Dental</h2>
        <ul>
        <a href="inicio.php" target="_blank" class="btn-innovador">Cerrar Sesion</a>
        </ul>
    </div>
    <div class="main-content">
        <h2>Lista de Citas</h2>
        <table id="dataTable">
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
                        echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['celular']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tipo_cita']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['doctor']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['hora_cita']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['dia_cita']) . "</td>";
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
