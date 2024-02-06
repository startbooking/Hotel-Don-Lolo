<?php

  require '../../../res/php/app_top.php';

  $fecha = date('Y-m-d');
  $usu = strtoupper(addslashes($_POST['login']));
  $pass = strtoupper(addslashes($_POST['password']));
  $pass3 = sha1(md5($usu.$pass));
  $users = $user->getLogin($usu, $pass3);
  $entrada = [];
 
  if (!empty($users)) {
      $cia = $user->getInfoCia();
      $pms = $user->getDatePms();

      $entrada['user'] = $users[0];
      $entrada['cia'] = $cia[0];
      $entrada['moduloPms'] = $pms[0];

      $inicial = 'INGRESO AL SISTEMA '.$users[0]['usuario'];
      $final = $inicial;
      $accion = 'INGRESO AL SISTEMA';
      $id = $users[0]['usuario_id'];

      $log = $user->ingresoLog($id, $users[0]['usuario'], $pc, $ip, $accion, $inicial, $final, 'US');
      $activo = $user->usuarioActivo($id, 1);
  } else {
      $entrada = ['entro' => '0'];
  }
  echo json_encode($entrada); 
