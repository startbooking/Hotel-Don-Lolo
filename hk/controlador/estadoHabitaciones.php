<?php
// Inicia la sesión si es necesario
session_start();
require_once 'res/php/utilities.php';

// Obtiene los datos de las habitaciones a través del modelo
$rooms = $hotel->getHabitaciones(4);

// Carga la vista, pasándole los datos
include_once 'vistas/estadoHabitaciones.php';