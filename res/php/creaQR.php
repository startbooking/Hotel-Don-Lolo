<?php
$data = json_decode(file_get_contents('php://input'), true);
extract($data);
// require_once '../vendor/autoload.php';
require_once '../../vendor/autoload.php';

// echo __DIR__;

use chillerlan\QRCode\{QRCode, QROptions};

$options = new QROptions([
    'version'    => 10, // Versión del QR (afecta el tamaño y capacidad de datos)
    'outputType' => QRCode::OUTPUT_IMAGE_PNG, // Tipo de salida: PNG, JPG, SVG, etc.
    'eccLevel'   => QRCode::ECC_L, // Nivel de corrección de error (L, M, Q, H)
    'scale'      => 10, // Escala de los módulos (tamaño de la imagen generada)
    'imageTransparent' => false, // Fondo transparente
    'bgColor'    => [255, 255, 255], // Color de fondo (RGB)
    'fgColor'    => [0, 0, 0], // Color de los módulos (RGB)
    'margin'     => 4, // Margen alrededor del QR
]);


try {
    $qrcode = new QRCode($options);
    // Renderiza el código QR y lo guarda en el archivo especificado
    $qrcode->render($QRStr, $filename);
} catch (Throwable $e) {
    echo 'Error al generar el código QR: ' . $e->getMessage();
}