<?php
	$id      = $_POST['id'];
	$usuario = $_POST['usuario'];

	require '../php/app_top.php'; 

  $inicial = 'SALIO DEL SISTEMA '.$usuario;
  $inicial = 'SALIO DEL SISTEMA '.$usuario;
  $final   = $inicial;
  $accion  = 'SALIO DEL SISTEMA';

  $log = $user->ingresoLog($id,$usuario,$pc, $ip, $accion, $inicial, $final, 'US');

  $sale = $user->usuarioActivo($id,0);

  echo $sale;
?>