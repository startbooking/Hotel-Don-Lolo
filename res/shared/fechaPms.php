<?php
	$id      = $_POST['id'];
	$usuario = $_POST['usuario'];

	require '../php/app_top.php'; 

  $fechapms = $user->getDatePms();

  echo $fechapms;

?>