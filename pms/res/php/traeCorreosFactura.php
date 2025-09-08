<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$perfil = $hotel->traePerfilFactura($factura);
$correo = '';

if ($perfil[0]['tipo_factura'] == 2) {
  $correo = $hotel->traeCorreoCia($perfil[0]['id_perfil_factura']);
} else {
  $correo = $hotel->traeCorreoHuesped($perfil[0]['id_perfil_factura']);
}

if (!empty($perfil[0]['email'])) {
  $infoCorreos = [
    'correoFac' => $perfil[0]['email'],
    'correo'    => $correo,
  ];
} else {
  $infoCorreos = [
    'correo' => $correo,
  ];
}
echo json_encode($infoCorreos);
