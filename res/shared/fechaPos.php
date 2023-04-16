<?php
	$id      = $_POST['id'];
	$usuario = $_POST['usuario'];

	require '../php/app_top.php'; 

	$fechaPos = $user->getDatePos() ;

  echo $fechaPos;

?>