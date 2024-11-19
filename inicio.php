<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultorio Dental</title>
    <style>
        /* Estilo para la imagen de fondo */
        body {
            margin: 0;
            padding: 0;
            background-image: url('https://static.vecteezy.com/system/resources/previews/000/561/579/original/logo-for-a-dental-clinic-vector-illustration.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Estilo para el header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        h1 {
            margin: 0;
        }

        /* Estilo para el menú de navegación */
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-left: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #000;
            font-size: 1.5em;
            font-weight: bold;
        }

        /* Alineación del menú de navegación a la derecha */
        nav {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        /* Estilo para el botón "Reservar Ahora" centrado */
        .reservar-ahora {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
            font-size: 2em;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        /* Estilo para el pie de página */
        footer {
            background-color: #1E90FF; /* Fondo azul */
            color: white; /* Texto blanco */
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .footer-info {
            max-width: 70%;
            font-size: 1em;
        }

        .footer-social {
            text-align: right;
            font-size: 1em;
        }

        /* Estilo para los botones */
        .button {
            background-color: #87CEEB; /* Azul bajo */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 1em;
            margin: 10px 5px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
        }

        .button:hover {
            background-color: #4682B4; /* Azul un poco más oscuro al pasar el ratón */
        }
    </style>
</head>
<body>

    <header>
        <h1>Consultorio Dental</h1>
        <nav>
            <ul>
                <li><a href="#" class="button" onclick="openNewTab('login.php')">iniciar Sesion</a></li>
                <li><a href="#" class="button" onclick="openNewTab('nosotros.html')">Nosotros</a></li>
                <li><a href="#" class="button" onclick="openNewTab('reserva.php')">Reservacion</a></li>
                <li><a href="#" class="button" onclick="openNewTab('contacto.html')">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div class="reservar-ahora">
        <p>Bienvenidos</p>
    </div>

    <footer>
        <div class="footer-info">
            <p>La Clínica Dental está conformada por un grupo de odontólogos especializados en tratamientos correctivos y estéticos, preocupados por el bienestar y la salud de la sociedad mexicana, ofrecemos alternativas con tecnología de punta para garantizar la calidad de nuestro servicio.</p>
            <p>Blvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.</p>
        </div>
        <div class="footer-social">
            <p>Redes sociales</p>
        </div>
    </footer>

    <script>
        function openNewTab(url) {
            window.open(url, '_blank'); // Abre la nueva pestaña
        }
    </script>

</body>
</html>

        