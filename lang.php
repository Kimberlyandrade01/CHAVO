<?php
// Definir las traducciones en español e inglés
$translations = [
    'es' => [
        'title' => 'Consultorio Dental',
        'welcome' => 'Bienvenidos',
        'about' => 'La Clínica Dental está conformada por un grupo de odontólogos especializados en tratamientos correctivos y estéticos, preocupados por el bienestar y la salud de la sociedad mexicana, ofrecemos alternativas con tecnología de punta para garantizar la calidad de nuestro servicio.',
        'address' => 'Blvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.',
        'social' => 'Redes sociales',
        'contact' => 'Contacto',
        'services' => 'Servicios',
        'make_appointment' => 'Reservar Ahora'
    ],
    'en' => [
        'title' => 'Dental Clinic',
        'welcome' => 'Welcome',
        'about' => 'The Dental Clinic is composed of a group of specialized dentists in corrective and aesthetic treatments, concerned about the health and well-being of Mexican society. We offer alternatives with cutting-edge technology to guarantee the quality of our service.',
        'address' => 'Blvd. Cucapah 20100-Sur, El Lago, 22210 Tijuana, B.C.',
        'social' => 'Social Networks',
        'contact' => 'Contact',
        'services' => 'Services',
        'make_appointment' => 'Make Appointment'
    ]
];

// Obtener el idioma seleccionado (por defecto español)
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'es';
$lang = array_key_exists($lang, $translations) ? $lang : 'es'; // Validar que el idioma existe

// Cargar las traducciones para el idioma seleccionado
$lang_translations = $translations[$lang];
?>
