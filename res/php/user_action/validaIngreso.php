<?php

require '../../../res/php/app_top.php';

$fecha = date('Y-m-d');
$usu = strtoupper(addslashes($_POST['login']));
$pass = strtoupper(addslashes($_POST['password']));
$pass3 = sha1(md5($usu . $pass));
$users = $user->getLogin($usu, $pass3);
$entrada = [];

if (!empty($users)) {
    $cia = $user->getInfoCia();
    $pms = $user->getDatePms();

    $entrada['user'] = $users;
    $entrada['cia'] = $cia;
    $entrada['moduloPms'] = $pms;

    $inicial = 'INGRESO AL SISTEMA ' . $users['usuario'];
    $final = $inicial;
    $accion = 'INGRESO AL SISTEMA';
    $id = $users['usuario_id'];

    $log = $user->ingresoLog($id, $users['usuario'], $pc, $ip, $accion, $inicial, $final, 'US');
    $activo = $user->usuarioActivo($id, 1);
} else {
    $entrada = ['entro' => '0'];
}
echo json_encode($entrada);
 