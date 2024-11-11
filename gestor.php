<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilo global */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
        }

        h2 {
            font-size: 24px;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        button {
            cursor: pointer;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Estilos del sidebar */
        .sidebar {
            background-color: #1E90FF; /* Color azul brillante */
            color: white;
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: white; /* Texto blanco */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            font-size: 18px;
            display: block;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            color: white;
        }

        .sidebar ul li a:hover {
            background-color: #1C86EE; /* Azul un poco más oscuro en hover */
        }

        /* Estilos de la sección principal */
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }

        .search-bar {
            display: flex;
            margin-bottom: 20px;
        }

        .search-bar input {
            padding: 8px;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
            width: 250px;
        }

        .search-bar button {
            background-color: #1E90FF;
            color: white;
            border-radius: 4px;
            padding: 8px 15px;
            font-size: 16px;
        }

        .search-bar button:hover {
            background-color: #1C86EE;
        }

        /* Estilo de la tabla */
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

        tr:hover {
            background-color: #f5f5f5;
        }

        .edit-btn {
            background-color: #ffa000;
            color: white;
        }

        .edit-btn:hover {
            background-color: #ff6f00;
        }

        .delete-btn {
            background-color: #e53935;
            color: white;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menú</h2>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Citas</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Contenido Principal</h2>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Buscar...">
            <button onclick="buscar()">Buscar</button>
            <a href="inicio.php" class="button">Regresar a la Página Principal</a>

        </div>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Juan Manuel Hernandez Gomez</td>
                    <td>
                        <button class="edit-btn" onclick="editar(this)">Editar</button>
                        <button class="delete-btn" onclick="eliminar(this)">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Gloria Andrade Gomez</td>
                    <td>
                        <button class="edit-btn" onclick="editar(this)">Editar</button>
                        <button class="delete-btn" onclick="eliminar(this)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // Función de búsqueda
        function buscar() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("#dataTable tbody tr");

            rows.forEach(row => {
                const name = row.querySelector("td").textContent.toLowerCase();
                row.style.display = name.includes(input) ? "" : "none";
            });
        }

        // Función para editar
        function editar(button) {
            const row = button.closest("tr");
            const nameCell = row.querySelector("td");
            const currentName = nameCell.textContent;

            const newName = prompt("Edita el nombre:", currentName);
            if (newName) {
                nameCell.textContent = newName;
            }
        }

        // Función para eliminar
        function eliminar(button) {
            const row = button.closest("tr");
            const name = row.querySelector("td").textContent;

            if (confirm(`¿Estás seguro de que deseas eliminar a ${name}?`)) {
                row.remove();
            }
        }
    </script>
</body>

</html>
