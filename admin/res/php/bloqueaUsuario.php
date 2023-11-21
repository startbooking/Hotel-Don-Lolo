<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

	$id     = $_POST['id'];
	$estado =  $_POST['estado'];

	if($estado==='1'){
		$estadoen = '0';
	}else if($estado==='C'){
		$estadoen = '1';
	}

	$bloquea = $user->bloqueaUsuario($estadoen, $id) ;

	echo $bloquea ;

 ?>
