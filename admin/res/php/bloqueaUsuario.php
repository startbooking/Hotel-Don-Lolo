<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_top.php'; 

	$id     = $_POST['id'];
	$estado =  $_POST['estado'];
	
	$estadoen = 0;

	if($estado==='1'){
		$estadoen = '3';
	}else if($estado==='0'){
		$estadoen = '1';
	}

	$bloquea = $user->bloqueaUsuario($estadoen, $id) ;

	echo $bloquea ;

 ?>
