<?php

require '../../../res/php/app_topHotel.php';

$user = $_POST['usuario'];
$users = $hotel->getActiveUser($user);

define('usuario_id', $users[0]['usuario_id']);
define('usuario', $users[0]['usuario']);
define('apellidos', $users[0]['apellidos']);
define('nombres', $users[0]['nombres']);
define('nivel', $users[0]['tipo']);
define('cajeropos', $users[0]['estado_usuario_pos']);
define('cajeropms', $users[0]['estado_usuario_pms']);
define('activo', $users[0]['estado']);
define('empresa_id', $users[0]['empresa_id']);
define('entro', 'SI');

$_SESSION['usuario_id'] = $users[0]['usuario_id'];
$_SESSION['usuario'] = $users[0]['usuario'];
$_SESSION['nombres'] = $users[0]['nombres'];
$_SESSION['apellidos'] = $users[0]['apellidos'];
$_SESSION['nivel'] = $users[0]['tipo'];
$_SESSION['cajeropos'] = $users[0]['estado_usuario_pos'];
$_SESSION['cajeropms'] = $users[0]['estado_usuario_pms'];
$_SESSION['activo'] = $users[0]['estado'];
$_SESSION['empresa_id'] = $users[0]['empresa_id'];
$_SESSION['entro'] = 'SI';

$cajero = cajeropms;
$user = usuario;

if ($cajero == 0) {
    $abre = $hotel->abreCajero($user);
    $valor = $user;
    $nuevo = $_SESSION['usuario_id'];

    $log = $hotel->ingresoLog($_SESSION['usuario_id'], $_SESSION['usuario'], $pc, $ip, 'ABRIO CAJERO', $valor, $nuevo, 'US');
}

echo json_encode($users);
