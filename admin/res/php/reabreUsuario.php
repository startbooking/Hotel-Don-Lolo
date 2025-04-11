<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

	$id     = $_POST['id'];

	$reabre = $user->reabreUsuario($id) ;

	echo $reabre ;

 ?>
