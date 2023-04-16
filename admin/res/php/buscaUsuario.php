<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

	$usuario        = $_POST['user'];

	$buscaust = $user->buscaUser($usuario);
	echo $buscaust;

 ?>
