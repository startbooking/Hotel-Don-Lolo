<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

	$id     = $_POST['id'];
	$estado =  $_POST['estado'];

	if($estado==='A'){
		$estadoen = 'C';
	}else if($estado==='C'){
		$estadoen = 'A';
	}

	$bloquea = $user->bloqueaUsuario($estadoen, $id) ;

	echo $bloquea ;

 ?>
