<?php
// res/php/utilities.php

/**
 * Devuelve la clase CSS correspondiente al estado de la habitación.
 *
 * @param string $estado_hk El estado de la habitación (e.g., 'LV', 'SO').
 * @return string La clase CSS.
 */
function getRoomColorClass(string $estado_hk): string
{
    switch ($estado_hk) {
        case 'LO':
            return 'bg-limpiaOcu';
        case 'LV':
            return 'bg-limpiaVac';
        case 'SO':
            return 'bg-suciaOcu';
        case 'SV':
            return 'bg-suciaVac';
        case 'FO':
            return 'bg-maroon';
        case 'FS':
            return 'bg-red';
        default:
            return 'bg-aliceblue';
    }
}