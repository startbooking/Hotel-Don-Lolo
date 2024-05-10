<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id         = $_POST['idConvMod'];
	$unidad     = $_POST['unidadUnidMod'];
	$conversion = $_POST['unidadConvMod'];
	$valor      = $_POST['valorConvMod'];

	$updateConversion = $admin->updateConversion($id, $unidad, $conversion, $valor) ;

	echo $updateConversion ;

 ?>
