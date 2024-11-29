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
            background-color: #4682B4; 
        }

        /* Botón de traducción */
        .translate-btn {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #32CD32; /* Verde */
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .translate-btn:hover {
            background-color: #228B22; /* Verde oscuro */
        }

        /* Botón de regreso al español */
        .back-to-spanish-btn {
            position: absolute;
            top: 10px;
            left: 150px;
            background-color: #FF6347; /* Rojo */
            color: white;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-to-spanish-btn:hover {
            background-color: #FF4500; /* Rojo oscuro */
        }
        #chat-messages {
            height: 200px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f9f9f9;
        }

        #user-input {
            width: calc(100% - 20px);
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #send-btn {
            margin-top: 5px;
            width: 100%;
            padding: 5px;
            background-color: #1E90FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #send-btn:hover {
            background-color: #4682B4;
        }
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }
        #chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 300px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        #chat-messages {
            height: 200px;
            overflow-y: auto;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f9f9f9;
        }

        #user-input {
            width: calc(100% - 20px);
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #send-btn {
            margin-top: 5px;
            width: 100%;
            padding: 5px;
            background-color: #1E90FF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #send-btn:hover {
            background-color: #4682B4;
        }
    </style>
</head>
<body>

    <button class="translate-btn" onclick="translatePage()">Traducir al inglés</button>
    <button class="back-to-spanish-btn" onclick="backToSpanish()">Volver al español</button>

    <header>
        <h1 id="header-title">Consultorio Dental</h1>
        <nav>
            <ul>
                <li><a href="#" class="button" id="btn-login" onclick="openNewTab('login.php')">Iniciar Sesión</a></li>
                <li><a href="#" class="button" id="btn-nosotros" onclick="openNewTab('nosotros.html')">Nosotros</a></li>
                <li><a href="#" class="button" id="btn-reservacion" onclick="openNewTab('reserva.php')">Reservación</a></li>
                <li><a href="#" class="button" id="btn-contacto" onclick="openNewTab('contacto.html')">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div class="reservar-ahora">
        <p id="welcome-msg">Bienvenidos</p>
    </div>
    <div id="chatbot-container">
        <div id="chat-messages"></div>
        <input type="text" id="user-input" placeholder="Escribe tu mensaje..." />
        <button id="send-btn">Enviar</button>
    </div>

    <script>
        function openNewTab(url) {
            window.open(url, '_blank'); // Abre la nueva pestaña
        }

        const chatMessages = document.getElementById('chat-messages');
        const userInput = document.getElementById('user-input');
        const sendBtn = document.getElementById('send-btn');

        // Función para agregar mensajes al chat
        function addMessage(sender, text) {
            const message = document.createElement('div');
            message.style.marginBottom = '10px';
            message.innerHTML = `<strong>${sender}:</strong> ${text}`;
            chatMessages.appendChild(message);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Función para manejar el mensaje del usuario
        function handleUserMessage() {
            const text = userInput.value.trim().toLowerCase(); // Convertir a minúsculas para facilitar comparación
            if (text) {
                addMessage('Usuario', text);
                userInput.value = '';

                // Respuesta automática basada en palabras clave
                if (text === 'hola') {
                    setTimeout(() => {
                        addMessage('Asisntete', 'Hola, buenas tardes. ¿En qué podemos ayudarte?');
                    }, 500);
                } else if (text.includes('servicios')) {
                    setTimeout(() => {
                        addMessage('Asistente', 'Gracias por tu interés. Estos son algunos de los servicios que ofrecemos:\n\n- Limpieza dental\n- Blanqueamiento dental\n- Ortodoncia\n- Tratamientos de caries\n\n¿Te gustaría más información sobre alguno de ellos?');
                    }, 500);
                } else if (text.includes('horario')) {
                    setTimeout(() => {
                        addMessage('Asistente', 'Nuestros horarios son:\n\n- Lunes a viernes: 8:00 AM a 5:00 PM\n- Sábados y domingos: Cerrado.');
                    }, 500);
                } else if (text.includes('ubicación') || text.includes('ubicacion')) {
                    setTimeout(() => {
                        addMessage('Asistente', 'Esta es nuestra ubicación:\n\nBlvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.');
                    }, 500);
                } else if (text.includes('doctores') || text.includes('doctor')) {
                    setTimeout(() => {
                        addMessage('Asistente', 'Estos son algunos de nuestros doctores que tenemos en nuestra clínica dental:\n\n- Efraín Reyna Ávila\n- Carlos Benítez\n- Kimberly Cervantes\n- Shijin');
                    }, 500);
                } else if (text.includes('cita') || text.includes('reservación') || text.includes('consulta')) {
                    setTimeout(() => {
                        addMessage('Asistente', '¡Claro! Te redirigiremos a nuestra página de reservas para que puedas agendar tu cita. Un momento por favor...');
                        setTimeout(() => {
                            // Redirigir al usuario a la página de reservas
                            window.location.href = 'reserva.php';
                        }, 2000);
                    }, 500);
                } else {
                    setTimeout(() => {
                        addMessage('Asistente', '¿Cómo puedo ayudarte?');
                    }, 500);
                }
            }
        }

        sendBtn.addEventListener('click', handleUserMessage);
        userInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                handleUserMessage();
            }
        });
    </script>
    <footer>
        <div class="footer-info">
            <p id="footer-info">La Clínica Dental está conformada por un grupo de odontólogos especializados en tratamientos correctivos y estéticos, preocupados por el bienestar y la salud de la sociedad mexicana, ofrecemos alternativas con tecnología de punta para garantizar la calidad de nuestro servicio.</p>
            <p id="footer-address">Blvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.</p>
        </div>
        <div class="footer-social">
            <p id="footer-social">Redes sociales</p>
        </div>
    </footer>

    <script>
        function openNewTab(url) {
            window.open(url, '_blank');
        }

        // Función para traducir al inglés
        function translatePage() {
            // Títulos y texto a traducir
            const headerTitle = document.getElementById('header-title');
            const welcomeMsg = document.getElementById('welcome-msg');
            const footerInfo = document.getElementById('footer-info');
            const footerAddress = document.getElementById('footer-address');
            const footerSocial = document.getElementById('footer-social');

            // Botones de navegación
            const btnLogin = document.getElementById('btn-login');
            const btnNosotros = document.getElementById('btn-nosotros');
            const btnReservacion = document.getElementById('btn-reservacion');
            const btnContacto = document.getElementById('btn-contacto');

            // Traducción al inglés
            headerTitle.innerText = 'Dental Clinic';
            welcomeMsg.innerText = 'Welcome';
            footerInfo.innerText = 'The Dental Clinic is made up of a group of dentists specialized in corrective and aesthetic treatments, concerned with the well-being and health of Mexican society. We offer cutting-edge technology alternatives to ensure the quality of our service.';
            footerAddress.innerText = 'Blvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.';
            footerSocial.innerText = 'Social Media';

            // Traducción de los botones
            btnLogin.innerText = 'Login';
            btnNosotros.innerText = 'About Us';
            btnReservacion.innerText = 'Reservation';
            btnContacto.innerText = 'Contact';
        }

        // Función para volver al español
        function backToSpanish() {
            // Títulos y texto a volver a español
            const headerTitle = document.getElementById('header-title');
            const welcomeMsg = document.getElementById('welcome-msg');
            const footerInfo = document.getElementById('footer-info');
            const footerAddress = document.getElementById('footer-address');
            const footerSocial = document.getElementById('footer-social');

            // Botones de navegación
            const btnLogin = document.getElementById('btn-login');
            const btnNosotros = document.getElementById('btn-nosotros');
            const btnReservacion = document.getElementById('btn-reservacion');
            const btnContacto = document.getElementById('btn-contacto');

            // Volver al español
            headerTitle.innerText = 'Consultorio Dental';
            welcomeMsg.innerText = 'Bienvenidos';
            footerInfo.innerText = 'La Clínica Dental está conformada por un grupo de odontólogos especializados en tratamientos correctivos y estéticos, preocupados por el bienestar y la salud de la sociedad mexicana, ofrecemos alternativas con tecnología de punta para garantizar la calidad de nuestro servicio.';
            footerAddress.innerText = 'Blvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.';
            footerSocial.innerText = 'Redes sociales';

            // Volver a los botones en español
            btnLogin.innerText = 'Iniciar Sesión';
            btnNosotros.innerText = 'Nosotros';
            btnReservacion.innerText = 'Reservación';
            btnContacto.innerText = 'Contacto';
        }
    </script>

</body>
</html>
