<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$unidad     = $_POST['unidadUnid'];
	$conversion = $_POST['unidadConv'];
	$valor      = $_POST['valorConv'];

	$guardaConversion = $admin->insertConversion($unidad, $conversion, $valor) ;

	echo $guardaConversion ;

 ?>
